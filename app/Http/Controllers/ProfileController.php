<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseOrder;
use App\Models\CourseSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseLiveSession;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordOtpMail;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $enrolledCourses = CourseOrder::where(
            'user_id',
            $user->id
        )
            ->where('status', "paid")
            ->count();

        $completedCourses = CourseOrder::where(
            'user_id',
            $user->id
        )
            ->where('status', "completed")
            ->count();

        $Courses = CourseOrder::with("course")
            ->where(
                'user_id',
                $user->id
            )
            ->where('status', "paid")
            ->get();

        // $certificates = Certificate::where(
        //     'user_id',
        //     $user->id
        // )->count();

        $continueCourse = CourseOrder::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->first();



        $streak = $user->current_streak ?? 0;

        $courseIds = CourseOrder::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->pluck('course_id');


        $scheduleCount = CourseSchedule::with('course')
            ->whereIn('course_id', $courseIds)
            ->orderBy('day')
            ->orderBy('start_time')
            ->count();
        return view(
            'profile.index',
            compact(
                'user',
                'enrolledCourses',
                'completedCourses',
                // 'certificates',
                'Courses',
                'scheduleCount',
                'streak',
            )
        );
    }

    public function request(Request $request)
    {
        $orders = CourseOrder::where('user_id', auth()->id())
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);
        $pending = CourseOrder::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();
        $pendingCount = $pending->count();
        $delivered = CourseOrder::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->get();
        $deliveredCount = $delivered->count();
        $totalOrder = CourseOrder::where('user_id', auth()->id())
            ->get();
        $totalOrderCount = $totalOrder->count();
        $totalSpent = $delivered = CourseOrder::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->sum('amount');
        return view('profile.request', compact('orders', 'pendingCount', 'deliveredCount', 'totalOrderCount', 'totalSpent'));
    }
    public function schedule()
    {
        $userId = auth()->id();

        $courseIds = CourseOrder::where('user_id', $userId)
            ->where('status', 'paid')
            ->pluck('course_id');


        $weekSchedules = CourseSchedule::with('course')
            ->whereIn('course_id', $courseIds)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        $weeklyGrouped = $weekSchedules->groupBy('day');
        $todayClasses = CourseSchedule::with('course')
            ->whereIn('course_id', $courseIds)
            ->where(
                'day',
                Carbon::today()->dayName
            )
            ->orderBy('start_time')
            ->get();

        $upcomingClasses = CourseSchedule::with('course')
            ->whereIn('course_id', $courseIds)
            ->where(
                'day',
                '>=',
                Carbon::today()->dayName
            )
            ->where('start_time', '>', Carbon::now()->timezone('Asia/Yangon')->format('H:i:s'))
            ->orderBy('day')
            ->orderBy('start_time')
            ->take(10)
            ->get();


        $nextClass = CourseSchedule::with('course')
            ->whereIn('course_id', $courseIds)
            ->whereDate(
                'day',
                '>=',
                Carbon::today()
            )
            ->orderBy('day')
            ->orderBy('start_time')
            ->first();

        $courseCount = $courseIds->count();

        $todayClassCount = $todayClasses->count();

        $upcomingClassCount = $upcomingClasses->count();

        return view(
            'profile.schedule',
            compact(
                'weekSchedules',
                'weeklyGrouped',
                'todayClasses',
                'upcomingClasses',
                'nextClass',
                'courseCount',
                'todayClassCount',
                'upcomingClassCount'
            )
        );
    }
    public function learner_live_show(Course $course, CourseLiveSession $session)
    {

        $isEnrolled = CourseOrder::where('course_id', $course->id)
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->exists();

        // if (!$isEnrolled) {

        //     abort(403, 'You are not enrolled in this course.');
        // }

        if ($session->course_id != $course->id) {

            abort(404);
        }

        return view('profile.learner_live', compact(
            'course',
            'session'
        ));
    }

    public function toggleNotification(Request $request)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        User::where('id', auth()->id())->update([

            'email_schedule_notification'
            => $request->status

        ]);

        return response()->json([

            'success' => true,

            'status' => auth()->user()->email_schedule_notification

        ]);
    }
    public function update(Request $request)
    {

        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255'
            ],

            'password' => [
                'required'
            ]

        ]);


        $user = Auth::user();


        // Check current password

        if (!Hash::check($request->password, $user->password)) {

            return back()
                ->with('error', 'Current password is incorrect');
        }



        // Update profile

        User::where('id', $user->id)->update([

            'name' => $request->name,

            'email' => $request->email,

        ]);



        return back()
            ->with('success', 'Profile updated successfully');
    }




    public function password_update(Request $request)
    {


        $request->validate([


            'current_password' => [
                'required'
            ],


            'new_password' => [
                'required',
                'min:8',
                'confirmed'
            ]


        ]);





        $user = Auth::user();





        // Check Current Password

        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {


            return back()->with(
                'error',
                'Current password is incorrect.'
            );
        }







        // Prevent same password

        if (Hash::check(
            $request->new_password,
            $user->password
        )) {


            return back()->with(
                'error',
                'New password cannot be same as old password.'
            );
        }








        // Update Password


        User::where('id', $user->id)->update([

            'password' => Hash::make(
                $request->new_password
            )

        ]);







        return back()->with(
            'success',
            'Password changed successfully.'
        );
    }
}
