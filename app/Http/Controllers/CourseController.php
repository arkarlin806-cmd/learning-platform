<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\InstructorWallet;
use App\Models\OrderStatusLog;
use App\Models\CourseOrder;
use App\Models\GroupChat;
use App\Models\GroupMember;
use App\Models\CourseRating;
use App\Models\InstructorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\B2StorageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    public function create()
    {
        return view('instructor.course_create');
    }
    public function course_store(Request $request, B2StorageService $b2)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:100',
            'category' => 'required',
            'level' => 'required',
            'price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'thumbnail' => 'required|image|max:500',
        ]);

        $duplicates = [];

        if ($request->days) {

            foreach ($request->days as $index => $day) {

                $start = $request->start_times[$index];
                $end   = $request->end_times[$index];

                $oldSchedules = CourseSchedule::with('course')
                    ->whereHas('course', function ($q) {
                        $q->where('instructor_id', auth()->id());
                    })
                    ->where('day', $day)
                    ->get();

                foreach ($oldSchedules as $old) {

                    $overlap =
                        strtotime($start) < strtotime($old->end_time) &&
                        strtotime($end) > strtotime($old->start_time);

                    if ($overlap) {

                        $duplicates[] =
                            "{$day} ({$start}-{$end}) overlaps with Course : {$old->course->title} ({$old->start_time}-{$old->end_time})";
                    }
                }
            }
        }

        if (count($duplicates) > 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'duplicate_schedule' => $duplicates
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload thumbnail to Backblaze B2
        |--------------------------------------------------------------------------
        */

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $upload = $b2->upload(
                $request->file('thumbnail'),
                'courses/thumbnails'
            );

            $thumbnail = $upload['file_name'];
        }

        /*
        |--------------------------------------------------------------------------
        | Create Course
        |--------------------------------------------------------------------------
        */

        $course = Course::create([
            'instructor_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'level' => $request->level,
            'price' => $request->price,
            'thumbnail' => $thumbnail,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'draft',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Course Schedules
        |--------------------------------------------------------------------------
        */

        if ($request->days) {

            foreach ($request->days as $index => $day) {

                CourseSchedule::create([
                    'course_id' => $course->id,
                    'day' => $day,
                    'start_time' => $request->start_times[$index],
                    'end_time' => $request->end_times[$index],
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Create Group Chat
        |--------------------------------------------------------------------------
        */

        $group = GroupChat::create([
            'name' => $course->title,
            'course_id' => $course->id,
            'created_by' => auth()->id(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Add Instructor to Group
        |--------------------------------------------------------------------------
        */

        GroupMember::create([
            'group_chat_id' => $group->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Course Created Successfully');
    }
    public function show($id) //single course show
    {
        $course = Course::with([
            'schedules',
            'ratings',
            'instructor'
        ])
            ->withAvg(
                'ratings',
                'rating'
            )
            ->withCount(
                'ratings'
            )
            ->findOrFail($id);
        // Check Purchased
        $isPurchased = CourseOrder::where(
            'user_id',
            auth()->id()
        )
            ->where(
                'course_id',
                $course->id
            )
            ->exists();
        $courseCount = Course::where('instructor_id', $course->instructor_id)->count();
        $instructor = InstructorRequest::where('user_id', $course->instructor_id)->first();
        return view(
            'courses.show',
            compact(
                'course',
                'instructor',
                'courseCount',
                'isPurchased'
            )
        );
    }
    public function categoryCourses($category)
    {
        return redirect()->route('courses.index', [
            'category' => $category
        ]);
    }

    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Course::with([
            'ratings' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        ])
            ->withAvg('ratings', 'rating')
            ->withCount('ratings');
        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $courses = $query->latest()->paginate(6);

        $purchasedCourseIds = CourseOrder::where('user_id', $userId)
            ->pluck('course_id');

        // if ($request->has('category')) {
        //     return view('courses.course_list', compact(
        //         'courses',
        //         'purchasedCourseIds'
        //     ));
        // }
        if ($request->ajax()) {
            return view('courses.course_list', compact(
                'courses',
                'purchasedCourseIds'
            ));
        }

        return view('courses.index', compact(
            'courses',
            'purchasedCourseIds'
        ));
    }
    public function checkout(Course $course)    //check out  page
    {
        $alreadyPurchased = CourseOrder::where(
            'user_id',
            auth()->id()
        )
            ->where('course_id', $course->id)
            ->where('status', 'paid')
            ->exists();

        if ($alreadyPurchased) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'You already purchased this course.'
                );
        }

        return view(
            'home.checkout',
            compact('course')
        );
    }

    public function store(Request $request) //order store
    {
        $request->validate([

            'course_id' =>
            'required|exists:courses,id',

            'payment_method' =>
            'required',

            'payment_screenshot' =>
            'required|image|mimes:jpg,jpeg,png|max:4096'

        ]);

        $course = Course::findOrFail(
            $request->course_id
        );

        $paidOrderExists = CourseOrder::where(
            'user_id',
            auth()->id()
        )
            ->where('course_id', $course->id)
            ->whereIn('status', ['paid', 'pending'])
            ->exists();

        if ($paidOrderExists) {
            return back()
                ->with(
                    'error',
                    'Order already exists.'
                );
        }

        $image = $request
            ->file('payment_screenshot')
            ->store(
                'payment-screenshots',
                'public'
            );

        $adminAmount =
            $course->price * 0.20;

        $instructorAmount =
            $course->price * 0.80;

        CourseOrder::create([

            'user_id' =>
            auth()->id(),

            'course_id' =>
            $course->id,

            'instructor_id' =>
            $course->instructor_id,

            'order_no' =>
            'ORD' . now()->timestamp . rand(100, 999),

            'amount' =>
            $course->price,

            'admin_amount' =>
            $adminAmount,

            'instructor_amount' =>
            $instructorAmount,

            'payment_method' =>
            $request->payment_method,

            'payment_screenshot' =>
            $image,

            'status' =>
            'pending'
        ]);

        return redirect()
            ->route('courses.index')
            ->with(
                'success',
                'Order Submitted Successfully'
            );
    }

    public function order(Request $request) //order show
    {
        $orders = CourseOrder::with([
            'user',
            'course',
            'instructor'
        ])

            ->when(
                $request->search,
                function ($query) use ($request) {

                    $query->where(
                        'order_no',
                        'like',
                        '%' . $request->search . '%'
                    );
                }
            )

            ->latest()
            ->paginate(10);

        return view(
            'admin.order',
            compact('orders')
        );
    }

    public function show_order($id) //single order show
    {
        $order = CourseOrder::with([
            'user',
            'course',
            'instructor'
        ])->findOrFail($id);

        return view(
            'admin.order_show',
            compact('order')
        );
    }

    public function updateStatus(   //course order update (instructor) checkout recieve
        Request $request,
        $id
    ) {
        $request->validate([
            'status' => 'required'
        ]);

        DB::transaction(function () use (
            $request,
            $id
        ) {

            $order =
                CourseOrder::findOrFail($id);

            $oldStatus =
                $order->status;

            $order->status =
                $request->status;

            if (
                $request->status == 'paid'
                &&
                $oldStatus != 'paid'
            ) {
                $wallet =
                    InstructorWallet::firstOrCreate(
                        [
                            'user_id' =>
                            $order->instructor_id
                        ]
                    );

                $wallet->increment(
                    'balance',
                    $order->instructor_amount
                );

                $wallet->increment(
                    'total_earned',
                    $order->instructor_amount
                );

                $order->paid_at = now();
            }

            $order->save();
            $group = GroupChat::where('course_id', $order->course_id)->first();

            if ($group) {

                GroupMember::firstOrCreate([
                    'group_chat_id' => $group->id,
                    'user_id' => $order->user_id,
                ]);
            }
            OrderStatusLog::create([

                'course_order_id' =>
                $order->id,

                'old_status' =>
                $oldStatus,

                'new_status' =>
                $request->status,

                'changed_by' =>
                auth()->id()

            ]);
        });




        return back()->with(
            'success',
            'Status Updated'
        );
    }

    public function rating_store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::beginTransaction();

        try {

            $rating = CourseRating::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'user_id'   => auth()->id(),
                ],
                [
                    'rating' => $request->rating,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rating saved successfully.',
                'average' => round(
                    CourseRating::where('course_id', $course->id)->avg('rating'),
                    1
                ),
                'count' => CourseRating::where('course_id', $course->id)->count(),
                'my_rating' => $rating->rating,
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function rating_destroy(Course $course)
    {
        DB::beginTransaction();

        try {

            CourseRating::where('course_id', $course->id)
                ->where('user_id', auth()->id())
                ->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rating removed.',
                'average' => round(
                    CourseRating::where('course_id', $course->id)->avg('rating'),
                    1
                ),
                'count' => CourseRating::where('course_id', $course->id)->count(),
                'my_rating' => 0,
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function rating_show(Course $course)
    {
        $myRating = CourseRating::where('course_id', $course->id)
            ->where('user_id', auth()->id())
            ->value('rating');

        return response()->json([
            'success' => true,
            'average' => round(
                CourseRating::where('course_id', $course->id)->avg('rating'),
                1
            ),
            'count' => CourseRating::where('course_id', $course->id)->count(),
            'my_rating' => $myRating ?? 0,
        ]);
    }
    public function rating_summary(Course $course)
    {
        $ratings = CourseRating::where('course_id', $course->id);

        return response()->json([
            'average' => round($ratings->avg('rating'), 1),
            'count'   => $ratings->count(),
            'five'    => CourseRating::where('course_id', $course->id)->where('rating', 5)->count(),
            'four'    => CourseRating::where('course_id', $course->id)->where('rating', 4)->count(),
            'three'   => CourseRating::where('course_id', $course->id)->where('rating', 3)->count(),
            'two'     => CourseRating::where('course_id', $course->id)->where('rating', 2)->count(),
            'one'     => CourseRating::where('course_id', $course->id)->where('rating', 1)->count(),
        ]);
    }

    public function edit(Course $course)
    {
        abort_if($course->instructor_id != Auth::id(), 403);

        $course->load('schedules');

        return view('courses.edit', compact('course'));
    }




    public function update(Request $request, Course $course)
    {
        abort_if($course->instructor_id != Auth::id(), 403);

        $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:255',

            'description' => 'required|max:1500',

            'category' => 'required',

            'level' => 'required',

            'price' => 'required|numeric|min:0',

            'start_date' => 'required|date',

            'end_date' => 'required|date|after_or_equal:start_date',

            // 5MB
            'thumbnail' => 'nullable|image|max:5120',

            'schedules' => 'required|array|min:1',

            'schedules.*.day' => 'required',

            'schedules.*.start_time' => 'required',

            'schedules.*.end_time' =>
            'required|after:schedules.*.start_time',

            // Optional preview video
            'preview_video' =>
            'nullable|file|mimes:mp4,mov,avi,mkv|max:51200',

        ]);

        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        /*
        |--------------------------------------------------------------------------
        | Duplicate Schedule Check
        |--------------------------------------------------------------------------
        */

        foreach ($request->schedules as $i => $current) {

            foreach ($request->schedules as $j => $compare) {

                if ($i == $j) {
                    continue;
                }

                if (
                    $current['day'] == $compare['day'] &&
                    $current['start_time'] < $compare['end_time'] &&
                    $current['end_time'] > $compare['start_time']
                ) {

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            "Duplicate/Overlapping schedule found on {$current['day']}."
                        );
                }
            }
        }

        DB::beginTransaction();

        try {

            $data = [

                'title' => $request->title,

                'short_description' =>
                $request->short_description,

                'description' =>
                $request->description,

                'category' =>
                $request->category,

                'level' =>
                $request->level,

                'price' =>
                $request->price,

                'start_date' =>
                $request->start_date,

                'end_date' =>
                $request->end_date,

                'status' =>
                $request->status,
            ];

            /*
            |--------------------------------------------------------------------------
            | COURSE THUMBNAIL → B2
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('thumbnail')) {

                // Delete old thumbnail from B2
                if ($course->thumbnail) {

                    try {

                        if (
                            Storage::disk('b2')
                            ->exists($course->thumbnail)
                        ) {

                            Storage::disk('b2')
                                ->delete($course->thumbnail);
                        }
                    } catch (\Throwable $e) {

                        Log::warning(
                            'Old course thumbnail delete failed',
                            [
                                'course_id' => $course->id,
                                'error' => $e->getMessage(),
                            ]
                        );
                    }
                }

                // Upload new thumbnail to B2
                $data['thumbnail'] =
                    $request->file('thumbnail')
                    ->store(
                        'course/thumbnails',
                        'b2'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | PREVIEW VIDEO → B2
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('preview_video')) {

                // Delete old preview video
                if ($course->preview_video) {

                    try {

                        if (
                            Storage::disk('b2')
                            ->exists($course->preview_video)
                        ) {

                            Storage::disk('b2')
                                ->delete($course->preview_video);
                        }
                    } catch (\Throwable $e) {

                        Log::warning(
                            'Old preview video delete failed',
                            [
                                'course_id' => $course->id,
                                'error' => $e->getMessage(),
                            ]
                        );
                    }
                }

                // Upload new preview video
                $data['preview_video'] =
                    $request->file('preview_video')
                    ->store(
                        'course/previews',
                        'b2'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE COURSE
            |--------------------------------------------------------------------------
            */

            $course->update($data);

            /*
            |--------------------------------------------------------------------------
            | DELETE OLD SCHEDULES
            |--------------------------------------------------------------------------
            */

            $course->schedules()->delete();

            /*
            |--------------------------------------------------------------------------
            | INSERT NEW SCHEDULES
            |--------------------------------------------------------------------------
            */

            foreach ($request->schedules as $schedule) {

                CourseSchedule::create([

                    'course_id' =>
                    $course->id,

                    'day' =>
                    $schedule['day'],

                    'start_time' =>
                    $schedule['start_time'],

                    'end_time' =>
                    $schedule['end_time'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route(
                    'instructor.course.edit',
                    $course
                )
                ->with(
                    'success',
                    'Course updated successfully.'
                );
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error(
                'Course update failed',
                [
                    'course_id' => $course->id,
                    'error' => $e->getMessage(),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
    public function deleteCourse($id)
    {
        DB::table('courses')->where('id', $id)->delete();
        return redirect()->route('instructor.dashboard')->with('success', 'သင်တန်းကို ဖျက်ပစ်လိုက်ပါပြီ။');
    }
}
