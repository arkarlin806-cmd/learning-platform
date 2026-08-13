<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Jobs\lessonvd;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class LessonController extends Controller
{
    public function create($id)
    {
        $course = Course::findOrFail($id);
        $isPurchased = LessonController::isPurchased($course->id);
        $isInstructor = LessonController::isInstructor();
        if ($isInstructor || $isPurchased) {

            return view(
                'lesson.create',
                compact('course', 'isInstructor', 'isPurchased')
            );
        } else {
            abort(403, 'Please purchase courses!.');
        }
    }
    public function index(Request $request)
    {
        $search = $request->input('search');


        if ($search) {
            $lessons = Lesson::where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $lessons = Lesson::all();
        }


        return view('LS.lessonlist', compact('lessons'));
    }

    public function show(Request $request, $id)
    {
        $course = Course::with('user')
            ->findOrFail($id);

        $query = Lesson::with('summary')
            ->where('course_id', $id);

        if ($request->filled('search')) {
            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('upload_type')) {
            $query->where(
                'lesson_type',
                $request->upload_type
            );
        }

        $lessons = $query
            ->latest()
            ->paginate(10);
        // ->withQueryString();

        $totalLessons = Lesson::where(
            'course_id',
            $course->id
        )->count();


        $isPurchased = LessonController::isPurchased($course->id);
        $isInstructor = LessonController::isInstructor();
        if ($isInstructor || $isPurchased) {

            return view(
                'lesson.show',
                compact(
                    'course',
                    'lessons',
                    'totalLessons',
                    'isInstructor',
                    'isPurchased'
                )
            );
        } else {
            abort(403, 'Please purchase courses!.');
        }
    }

    public function update(
        Request $request,
        Lesson $lesson
    ) {

        try {


            if (
                $lesson->course->instructor_id
                != auth()->id()
            ) {

                return response()->json([

                    'success' => false,
                    'message' => 'Unauthorized'

                ], 403);
            }



            $lesson->update([

                'title' => $request->title,

                'description' => $request->description,

            ]);




            if ($request->hasFile('file')) {


                if (
                    $lesson->file_path &&
                    Storage::disk('public')
                    ->exists($lesson->file_path)
                ) {

                    Storage::disk('public')
                        ->delete($lesson->file_path);
                }



                $lesson->update([

                    'file_path' =>
                    $request->file('file')
                        ->store(
                            'lessons',
                            'public'
                        )

                ]);
            }




            $lesson->summary()->delete();

            $lesson->summary()
                ->create([

                    'key_points' => $request->points

                ]);




            return response()->json([

                'success' => true,

                'message' => 'Lesson updated successfully'

            ]);
        } catch (\Exception $e) {


            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Lesson $lesson)
    {
        try {
            if ($lesson->course->instructor_id != auth()->id()) {
                return response()->json([

                    'success' => false,
                    'message' => 'Unauthorized action'

                ], 403);
            }
            if (
                $lesson->file_path &&
                Storage::disk('public')
                ->exists($lesson->file_path)
            ) {

                Storage::disk('public')
                    ->delete($lesson->file_path);
            }
            $lesson->summary()->delete();
            $lesson->delete();
            return response()->json([

                'success' => true,
                'message' => 'Lesson deleted successfully'

            ]);
        } catch (\Exception $e) {

            return response()->json([

                'success' => false,
                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function isInstructor()
    {
        $isInstructor = false;
        if (auth()->check()) {
            $isInstructor = User::where('id', auth()->id())
                ->where('role', '2')
                ->exists();
        }
        if ($isInstructor) {
            return true;
        } else {
            return false;
        }
    }

    public function isPurchased($courseId)
    {
        $isPurchased = false;
        if (auth()->check()) {
            $isPurchased = CourseOrder::where([
                'user_id' => auth()->id(),
                'course_id' => $courseId,
                'status' => 'paid'
            ])->exists();
        }
        if ($isPurchased) {
            return true;
        } else {
            return false;
        }
    }
    public function store(Request $request)
    {
        Log::info('Lesson upload arrived');

        $request->validate([
            'course_id'   => 'required|integer|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:300',
            'file'        => [
                'required',
                'file',
                'mimes:pdf,mp4,mov,avi,mkv,mp3,wav,m4a',
                'max:51200', // 50 MB
            ],
        ]);

        $course = Course::findOrFail($request->course_id);

        if ($course->instructor_id != auth()->id()) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $file = $request->file('file');

            Log::info('Lesson file received', [
                'name' => $file->getClientOriginalName(),
                'size_mb' => round($file->getSize() / 1024 / 1024, 2),
                'mime' => $file->getMimeType(),
            ]);

            /*
        |--------------------------------------------------------------------------
        | Upload Lesson to Backblaze B2
        |--------------------------------------------------------------------------
        */

            $path = $file->store('lessons', 's3');

            if (!$path) {
                throw new \Exception('Failed to upload lesson file to B2.');
            }

            /*
        |--------------------------------------------------------------------------
        | Detect lesson type
        |--------------------------------------------------------------------------
        */

            $extension = strtolower(
                $file->getClientOriginalExtension()
            );

            $lessonType = 'video';

            if ($extension === 'pdf') {
                $lessonType = 'pdf';
            } elseif (in_array($extension, ['mp3', 'wav', 'm4a'])) {
                $lessonType = 'audio';
            }

            /*
        |--------------------------------------------------------------------------
        | Create Lesson
        |--------------------------------------------------------------------------
        */

            $lesson = Lesson::create([
                'course_id'        => $request->course_id,
                'title'            => $request->title,
                'description'      => $request->description,
                'lesson_type'      => $lessonType,
                'file_path'        => $path,
                'summary_status'   => 'pending',
                'summary_progress' => 0,
                'summary_error'    => null,
            ]);

            DB::commit();

            /*
        |--------------------------------------------------------------------------
        | Start AI processing
        |--------------------------------------------------------------------------
        */

            lessonvd::dispatch($lesson->id);

            return response()->json([
                'success'   => true,
                'lesson_id' => $lesson->id,
                'status'    => 'pending',
                'progress'  => 0,
                'message'   => 'Lesson uploaded successfully. AI processing started.',
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Lesson store failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Lesson upload failed.',
            ], 500);
        }
    }

    // public function store(Request $request) //lesson store
    // {
    //     Log::info('arrive');
    //     $request->validate([
    //         'course_id'   => 'required|integer',
    //         'title'       => 'required|string|max:255',
    //         'description' => 'nullable|string|max:300',
    //         'file'        => 'required|file|mimes:pdf,mp4,mov,avi,mkv,mp3,wav,m4a|max:512000',
    //     ]);
    //     $course = Course::findOrFail($request->course_id);


    //     if ($course->instructor_id != auth()->id()) {
    //         abort(403);
    //     }
    //     DB::beginTransaction();

    //     try {

    //         $path = $request->file('file')->store('lessons', 'public');

    //         $lesson = Lesson::create([
    //             'course_id'        => $request->course_id,
    //             'title'            => $request->title,
    //             'description'      => $request->description,
    //             'lesson_type'      => 'video',
    //             'file_path'        => $path,
    //             'summary_status'   => 'pending',
    //             'summary_progress' => 0,
    //             'summary_error'    => null,
    //         ]);

    //         DB::commit();

    //         lessonvd::dispatch($lesson->id);

    //         return response()->json([
    //             'success'   => true,
    //             'lesson_id' => $lesson->id,
    //             'status'    => 'pending',
    //             'progress'  => 0,
    //             'message'   => 'Lesson created. AI processing started.',
    //         ]);
    //     } catch (\Throwable $e) {

    //         DB::rollBack();

    //         Log::error('Lesson store failed', [
    //             'error' => $e->getMessage()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function status($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return response()->json([
                'status'  => 'failed',
                'message' => 'Lesson not found'
            ], 404);
        }

        return response()->json([
            'status'   => $lesson->summary_status,
            'progress' => $lesson->summary_progress,
            'error'    => $lesson->summary_error,
        ]);
    }
    public function aiPreview($id, $course_id)
    {
        $lesson = Lesson::findOrFail($id);
        $course = Course::findOrFail($course_id);

        $summary = Cache::get("lesson_ai_{$id}");

        if (!$summary) {
            return redirect()
                ->route('lesson.show', $id)
                ->with('error', 'AI summary not ready yet.');
        }
        $isInstructor = LessonController::isInstructor();


        return view('lesson.ls', [
            'lesson'  => $lesson,
            'summary' => $summary,
            'isInstructor' => $isInstructor,
            'course' => $course
        ]);
    }
    public function saveSummary(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'summary'     => 'required|string',
            'key_points'  => 'nullable|array',
        ]);

        $lesson = Lesson::findOrFail($id);

        $lesson->summary()->updateOrCreate(
            ['lesson_id' => $id],
            [
                'title'       => $request->title,
                'summary'     => $request->summary,
                'key_points'  => $request->key_points ?? [],
                'source_type' => 'ai_reviewed'
            ]
        );

        Cache::forget("lesson_ai_{$id}");

        return response()->json([
            'success' => true,
            'message' => 'Summary saved successfully'
        ]);
    }
}
