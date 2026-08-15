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
use App\Models\lesson_summary;
use Illuminate\Support\Facades\Log;
use Illuminate\Filesystem\FilesystemAdapter;

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
        $course = Course::with('user')->findOrFail($id);

        $query = Lesson::with('summary')
            ->where('course_id', $course->id);

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


        /*
        |--------------------------------------------------------------------------
        | B2 Video URL
        |--------------------------------------------------------------------------
        */

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('b2');

        foreach ($lessons as $lesson) {

            $lesson->video_url = null;

            if (
                $lesson->lesson_type === 'video' &&
                !empty($lesson->file_path)
            ) {
                try {

                    if ($disk->exists($lesson->file_path)) {

                        $lesson->video_url = $disk->temporaryUrl(
                            $lesson->file_path,
                            now()->addHours(2)
                        );
                    }
                } catch (\Throwable $e) {

                    Log::error('B2 signed URL error', [
                        'lesson_id' => $lesson->id,
                        'file_path' => $lesson->file_path,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalLessons = Lesson::where(
            'course_id',
            $course->id
        )->count();

        $videoLessons = Lesson::where(
            'course_id',
            $course->id
        )
            ->where(
                'lesson_type',
                'video'
            )
            ->count();

        $pdfLessons = Lesson::where(
            'course_id',
            $course->id
        )
            ->where(
                'lesson_type',
                'pdf'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Access
        |--------------------------------------------------------------------------
        */

        $isPurchased =
            LessonController::isPurchased(
                $course->id
            );

        $isInstructor =
            LessonController::isInstructor();


        if (
            $isInstructor ||
            $isPurchased
        ) {

            return view(
                'lesson.show',
                compact(
                    'course',
                    'lessons',
                    'totalLessons',
                    'videoLessons',
                    'pdfLessons',
                    'isInstructor',
                    'isPurchased'
                )
            );
        }


        abort(
            403,
            'Please purchase courses!'
        );
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
        Log::info('LESSON STORE ARRIVED');

        $request->validate([
            'course_id'   => 'required|integer|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => [
                'required',
                'file',
                'mimes:pdf,mp4,mov,avi,mkv,mp3,wav,m4a',
                'max:51200', // 50 MB
            ],
        ]);

        DB::beginTransaction();

        try {

            $file = $request->file('file');

            /*
        |--------------------------------------------------------------------------
        | Upload to Backblaze B2
        |--------------------------------------------------------------------------
        */

            $path = $file->store('lessons', 'b2');

            Log::info('LESSON B2 UPLOAD SUCCESS', [
                'path' => $path,
                'size' => round($file->getSize() / 1024 / 1024, 2) . ' MB',
            ]);

            /*
        |--------------------------------------------------------------------------
        | Create Lesson
        |--------------------------------------------------------------------------
        */

            $extension = strtolower(
                $file->getClientOriginalExtension()
            );

            if ($extension === 'pdf') {
                $lessonType = 'pdf';
            } elseif (in_array($extension, ['mp3', 'wav', 'm4a'])) {
                $lessonType = 'audio';
            } else {
                $lessonType = 'video';
            }

            $lesson = Lesson::create([
                'course_id'        => $request->course_id,
                'title'            => $request->title,
                'description'      => $request->description,
                'lesson_type'      => $lessonType,
                'upload_type'      => 'device',
                'file_path'        => $path,
                'summary_status'   => 'pending',
                'summary_progress' => 0,
                'summary_error'    => null,
            ]);

            DB::commit();

            /*
        |--------------------------------------------------------------------------
        | Start AI Job
        |--------------------------------------------------------------------------
        */

            lessonvd::dispatch($lesson->id);

            return response()->json([
                'success'   => true,
                'lesson_id' => $lesson->id,
                'status'    => 'pending',
                'progress'  => 0,
                'message'   => 'Lesson created. AI processing started.',
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Lesson store failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


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

        if ((int) $lesson->course_id !== (int) $course->id) {
            abort(404);
        }

        // IMPORTANT: one lesson = one summary
        $summary = lesson_summary::where(
            'lesson_id',
            $lesson->id
        )->first();

        if (!$summary) {
            return redirect()
                ->route('lesson.show', ['id' => $course->id])
                ->with('error', 'Lesson summary not found.');
        }

        $isInstructor = LessonController::isInstructor();

        return view('lesson.ls', [
            'lesson'       => $lesson,
            'summary'      => $summary,
            'isInstructor' => $isInstructor,
            'course'       => $course,
        ]);
    }
    public function saveSummary(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'key_points' => 'nullable|array',
            'key_points.*' => 'nullable|string|max:1000',
        ]);

        $lesson = Lesson::findOrFail($id);

        $summary = $lesson->summary()->updateOrCreate(
            [
                'lesson_id' => $lesson->id,
            ],
            [
                'title' => $request->title,
                'summary' => $request->summary,
                'key_points' => array_values(
                    array_filter(
                        $request->key_points ?? [],
                        fn($point) => trim($point) !== ''
                    )
                ),
                'source_type' => 'ai_reviewed',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Summary saved successfully.',
            'summary_id' => $summary->id,
        ]);
    }
}
