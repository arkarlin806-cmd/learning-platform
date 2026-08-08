<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseLiveSessionRequest;
use App\Http\Requests\UpdateCourseLiveSessionRequest;
use App\Models\Course;
use App\Models\CourseLiveSession;
use App\Models\CourseLiveParticipant;
use App\Models\CourseOrder;
use App\Services\JitsiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseLiveController extends Controller
{
    public function __construct(
        protected JitsiService $jitsiService
    ) {}

    public function index(Course $course)
    {
        $sessions = CourseLiveSession::with(['instructor', 'lesson'])
            ->where('course_id', $course->id)
            ->latest('id')
            ->paginate(5);
        // ->get();

        return view('course_live.index', compact('course', 'sessions'));
    }

    public function create(Course $course)
    {
        return view('course_live.create', compact('course'));
    }

    public function store(StoreCourseLiveSessionRequest $request, Course $course)
    {
        $user = Auth::user();

        $session = CourseLiveSession::create([
            'course_id' => $course->id,
            'instructor_id' => $user->id,
            'uuid' => (string) Str::uuid(),
            'room_name' => $this->jitsiService->generateUniqueRoomName($course->id),
            'title' => $request->title,
            'description' => $request->description,
            'status' => CourseLiveSession::STATUS_SCHEDULED,
            'recording_enabled' => (bool) $request->boolean('recording_enabled'),
            'recording_imported' => false,
            'scheduled_at' => $request->scheduled_at,
            'started_at' => null,
            'ended_at' => null,
            'meta' => [
                'created_by' => $user->id,
                'source' => 'web',
            ],
        ]);

        return redirect()
            ->route('courses.live.show', [$course, $session])
            ->with('success', 'Live session created successfully.');
    }

    public function show(Course $course, CourseLiveSession $live)
    {
        $live->load([
            'course',
            'instructor',
            'participants.user',
        ]);

        return view('course_live.show', [
            'course'  => $course,
            'session' => $live,
        ]);
    }

    public function edit(Course $course, CourseLiveSession $live)
    {
        return view('course_live.edit', [
            'course' => $course,
            'session' => $live,
        ]);
    }

    public function update(UpdateCourseLiveSessionRequest $request, Course $course, CourseLiveSession $live)
    {
        $live->update([
            'title' => $request->title,
            'description' => $request->description,
            'lesson_id' => $request->lesson_id,
            'scheduled_at' => $request->scheduled_at,
            'recording_enabled' => (bool) $request->boolean('recording_enabled'),
            'status' => $request->status ?? $live->status,
        ]);

        return redirect()
            ->route('courses.live.show', [$course, $live])
            ->with('success', 'Live session updated successfully.');
    }

    public function destroy(Course $course, CourseLiveSession $live)
    {
        $live->delete();

        return redirect()
            ->route('courses.live.index', $course)
            ->with('success', 'Live session deleted successfully.');
    }

    public function start(Course $course, CourseLiveSession $live)
    {
        $this->ensureInstructor($live);
        if ($live->status !== CourseLiveSession::STATUS_LIVE) {
            $live->update([
                'status' => CourseLiveSession::STATUS_LIVE,
                'started_at' => now(),
            ]);
        }

        return redirect()->route('courses.live.room', [$course, $live]);
    }

    public function end(Course $course, CourseLiveSession $live)
    {
        $meta = $live->meta ?? [];
        $meta['ended_by'] = Auth::id();

        $live->update([
            'status' => CourseLiveSession::STATUS_ENDED,
            'ended_at' => now(),
            'meta' => $meta,
        ]);
        return redirect()
            ->route('courses.live.show', [$course, $live])
            ->with('success', 'Live session ended.');
    }

    public function room(Course $course, CourseLiveSession $live)
    {
        $user = Auth::user();

        if ($live->status !== CourseLiveSession::STATUS_LIVE) {
            return redirect()
                ->route('courses.live.show', [$course, $live])
                ->with('error', 'This live session is not active.');
        }

        $isModerator = (int) $user->id === (int) $live->instructor_id;

        $meeting = $this->jitsiService->buildMeetingPayload($user, $live, $isModerator);

        return view('course_live.room', [
            'course' => $course,
            'session' => $live,
            'meeting' => $meeting,
            'isModerator' => $isModerator,
        ]);
    }

    // public function join(Course $course, CourseLiveSession $live)
    // {
    //     if ($live->status !== CourseLiveSession::STATUS_LIVE) {
    //         return redirect()
    //             ->route('courses.live.show', [$course, $live])
    //             ->with('error', 'Live session is not running now.');
    //     }
    //     return redirect()->route('courses.live.room', [$course, $live]);
    // }

    public function join(Course $course, CourseLiveSession $live)
    {
        if ($live->status !== CourseLiveSession::STATUS_LIVE) {
            return redirect()
                ->route('courses.live.show', [$course, $live])
                ->with('error', 'Live session is not running now.');
        }

        // Save participant (No duplicate)
        CourseLiveParticipant::firstOrCreate(
            [
                'live_session_id' => $live->id,
                'user_id'         => Auth::id(),
            ],
            [
                'role'       => 'learner',
                'joined_at'  => now(),
            ]
        );

        return redirect()->route('courses.live.room', [$course, $live]);
    }
    public function autoEnd(Course $course, CourseLiveSession $live)
    {
        if ((int) auth()->id() !== (int) $live->instructor_id) {
            return response()->json([
                'ok' => false,
                'message' => 'Only instructor can auto end this session.'
            ], 403);
        }

        if ($live->status !== CourseLiveSession::STATUS_ENDED) {
            $meta = $live->meta ?? [];
            $meta['ended_by'] = auth()->id();
            $meta['ended_reason'] = 'auto_connection_timeout';
            $meta['auto_ended_at'] = now()->toDateTimeString();

            $live->update([
                'status' => CourseLiveSession::STATUS_ENDED,
                'ended_at' => now(),
                'meta' => $meta,
            ]);
        }

        return response()->json([
            'ok' => true,
            'message' => 'Session auto-ended successfully.'
        ]);
    }

    protected function ensureInstructor(CourseLiveSession $live): void
    {
        if ((int) auth()->id() !== (int) $live->instructor_id) {
            abort(403, 'Only instructor can manage this live session.');
        }
    }

    public function leave(Course $course, CourseLiveSession $live) //learner leave
    {
        $participant = CourseLiveParticipant::where('live_session_id', $live->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$participant) {
            return response()->json([
                'success' => false
            ]);
        }

        if (!$participant->left_at) {

            $leftAt = now();

            $duration = $participant->joined_at
                ? $participant->joined_at->diffInSeconds($leftAt)
                : 0;

            $participant->update([
                'left_at' => $leftAt,
                'duration_seconds' => $duration,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
    //learner live show


    public function learner_index(Course $course)
    {

        $isEnrolled = CourseOrder::where('course_id', $course->id)
            ->where('user_id', Auth::id())
            ->exists();

        abort_unless($isEnrolled, 403);

        $sessions = CourseLiveSession::where(
            'course_id',
            $course->id
        )->latest()->get();

        return view(
            'profile.learner_index',
            compact('course', 'sessions')
        );
    }
}
