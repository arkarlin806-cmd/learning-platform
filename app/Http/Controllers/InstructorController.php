<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\User;
use App\Models\Quiz;
use App\Models\StudentAnswer;
use App\Models\CourseSchedule;
use App\Models\CourseLiveSession;
use App\Models\Lesson;
use App\Models\CourseLiveParticipant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InstructorController extends Controller
{

    public function index()
    {
        $instructorId = auth()->id();

        $courseCount = Course::where(
            'instructor_id',
            $instructorId
        )->count();

        $studentCount = CourseOrder::where(
            'instructor_id',
            $instructorId
        )
            ->where('status', 'paid')
            ->distinct('user_id')
            ->count('user_id');

        $totalEarned = CourseOrder::where(
            'instructor_id',
            $instructorId
        )
            ->where('status', 'paid')
            ->sum('instructor_amount');
        $courses = Course::with([
            'ratings' => function ($query) use ($instructorId) {

                $query->where(
                    'user_id',
                    $instructorId
                );
            }
        ])
            ->where('instructor_id', auth()->id())
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->latest()
            ->get();
        $rating_courses = Course::where('instructor_id', $instructorId)
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->get();

        $totalReviews = $rating_courses->sum('ratings_count');

        $averageRating = round(
            $rating_courses->avg('ratings_avg_rating') ?? 0,
            1
        );
        return view(
            'instructor.dashboard',
            compact(
                'courseCount',
                'studentCount',
                'totalEarned',
                'courses',
                'totalReviews',
                'averageRating'
            )
        );
    }
    public function chart($type = 'day')
    {
        $type = $request->type ?? 'day';

        $instructorId = auth()->id();

        $labels = [];
        $data = [];

        if ($type == 'day') {

            for ($i = 6; $i >= 0; $i--) {

                $date = Carbon::now()->subDays($i);
                $labels[] = $date->format('D');

                $amount = CourseOrder::where(
                    'instructor_id',
                    $instructorId
                )
                    ->where('status', 'paid')
                    ->whereDate(
                        'paid_at',
                        $date
                    )
                    ->sum('instructor_amount');

                $data[] = $amount;
            }
        }

        if ($type == 'month') {

            for ($i = 11; $i >= 0; $i--) {

                $month = Carbon::now()
                    ->subMonths($i);

                $labels[] = $month->format('M');

                $amount = CourseOrder::where(
                    'instructor_id',
                    $instructorId
                )
                    ->where('status', 'paid')
                    ->whereYear(
                        'paid_at',
                        $month->year
                    )
                    ->whereMonth(
                        'paid_at',
                        $month->month
                    )
                    ->sum('instructor_amount');

                $data[] = $amount;
            }
        }


        if ($type == 'year') {

            for ($i = 4; $i >= 0; $i--) {

                $year = Carbon::now()
                    ->subYears($i);

                $labels[] = $year->year;

                $amount = CourseOrder::where(
                    'instructor_id',
                    $instructorId
                )
                    ->where('status', 'paid')
                    ->whereYear(
                        'paid_at',
                        $year->year
                    )
                    ->sum('instructor_amount');

                $data[] = $amount;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
    public function single_course(Course $course)
    {

        $course->load('instructor');

        // Learners
        $totalLearners = CourseOrder::where('course_id', $course->id)->count();

        // Lessons
        $totalLessons = Lesson::where('course_id', $course->id)->count();

        $currentMonthLessons = Lesson::where('course_id', $course->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Live Sessions
        $totalLives = CourseLiveSession::where('course_id', $course->id)->count();

        $currentMonthLives = CourseLiveSession::where('course_id', $course->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Quizzes
        $totalQuizzes = Quiz::where('course_id', $course->id)->count();

        $currentMonthQuizzes = Quiz::where('course_id', $course->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $instructor = User::find($course->instructor_id);
        return view(
            'instructor.single_course',
            compact(
                'course',
                'instructor',
                'totalLearners',
                'totalLessons',
                'currentMonthLessons',
                'totalLives',
                'currentMonthLives',
                'totalQuizzes',
                'currentMonthQuizzes'
            )
        );
    }
    public function learners(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $learners = CourseOrder::with('user')
            ->where('course_id', $courseId)
            ->where('status', 'paid')
            ->when($request->search, function ($q) use ($request) {

                $q->whereHas('user', function ($user) use ($request) {

                    $user->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );
                });
            })
            ->paginate(12);

        $isPurchased = InstructorController::isPurchased($courseId);
        $isInstructor = InstructorController::isInstructor();
        if ($isInstructor || $isPurchased) {
            return view(
                'instructor.learners',
                compact(
                    'course',
                    'learners',
                    'isInstructor',
                    'isPurchased'
                )
            );
        } else {
            abort(403, 'Please purchase this course first.');
        }
    }
    public function schedule()
    {
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
        $now = Carbon::now()->timezone('Asia/Yangon')->format('H:i:s');
        $schedules = CourseSchedule::with('course')
            ->whereHas('course', function ($q) {
                $q->where(
                    'instructor_id',
                    auth()->id()
                );
            })
            ->get();
        $events = [];
        foreach ($schedules as $schedule) {

            $events[] = [

                'id' => $schedule->id,

                'title' =>
                $schedule->course->course_name,

                'startTime' =>
                $schedule->start_time,

                'endTime' =>
                $schedule->end_time,


            ];
        }



        $courseIds = Course::where('instructor_id', Auth::id())
            ->pluck('id');

        $todaySchedules = CourseSchedule::whereIn('course_id', $courseIds)
            ->where('day', strtolower(now()->format('l')));

        $upcomingCount = (clone $todaySchedules)
            ->where('start_time', '>', $now)
            ->count();

        $completedCount = (clone $todaySchedules)
            ->where('end_time', '<', $now)
            ->count();

        $ongoingCount = (clone $todaySchedules)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->count();


        $data = [

            'upcoming_classes' => $upcomingCount,
            'completed_classes' => $completedCount,
            'ongoing_classes'  => $ongoingCount,
        ];
        return view(
            'instructor.schedule',
            compact(
                'days',
                'schedules',
                'events',
                'data'
            )
        );
    }
    public function earnings()
    {
        $instructorId = auth()->id();

        $courseIds = Course::where(
            'instructor_id',
            $instructorId
        )->pluck('id');

        $totalEarnings = CourseOrder::whereIn(
            'course_id',
            $courseIds
        )
            ->where('status', 'paid')
            ->sum('instructor_amount');

        $monthlyEarnings = CourseOrder::whereIn(
            'course_id',
            $courseIds
        )
            ->whereMonth('created_at', now()->month)
            ->where('status', 'paid')
            ->sum('instructor_amount');

        $totalStudents = CourseOrder::whereIn(
            'course_id',
            $courseIds
        )
            ->distinct('user_id')
            ->count();

        $totalCourses = Course::where(
            'instructor_id',
            $instructorId
        )->count();

        $recentOrders = CourseOrder::with([
            'user',
            'course'
        ])
            ->whereIn('course_id', $courseIds)
            ->where('status', 'paid')
            ->latest()
            ->paginate(10);
        $wallet = DB::table('instructor_wallets')->where('user_id', $instructorId)->first();
        $courses = DB::table('courses')
            ->where('instructor_id', $instructorId)
            ->orderBy('id', 'desc')
            ->get();

        $chartTitles = [];
        $chartEarnings = [];

        foreach ($courses as $course) {

            $totalEarnedForCourse = DB::table('course_orders')
                ->where('course_id', $course->id)
                ->where('status', 'paid')
                ->sum('instructor_amount');

            $chartTitles[] = $course->title;
            $chartEarnings[] = $totalEarnedForCourse;
        }
        return view(
            'instructor.earning',
            compact(
                'totalEarnings',
                'monthlyEarnings',
                'totalStudents',
                'totalCourses',
                'recentOrders',
                'courses',
                'wallet',
                'chartTitles',
                'chartEarnings'
            )
        );
    }
    public function earningsChart()
    {
        $courseIds = Course::where(
            'instructor_id',
            auth()->id()
        )->pluck('id');

        $earnings = CourseOrder::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(instructor_amount) as total')
        )
            ->whereIn('course_id', $courseIds)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($earnings);
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


    public function show(Course $course, User $user) //instructor show each learner
    {
        // Only course owner
        // abort_if($course->instructor_id != Auth::id(), 403);

        // Learner purchased this course?
        $order = CourseOrder::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->firstOrFail();


        // Quiz Analysis
        $quizzes = Quiz::where('course_id', $course->id)
            ->whereNot('status', 'draft')
            ->get();

        $quizRows = [];

        $quizTotal = $quizzes->count();

        // Log::info('total quiz count');
        // Log::info($quizTotal);

        $completedQuiz = 0;

        $totalQuizPercentage = 0;
        foreach ($quizzes as $quiz) {

            $answers = StudentAnswer::where('quiz_id', $quiz->id)
                ->where('user_id', $user->id)
                ->get();

            if ($answers->count()) {

                $completedQuiz++;

                $earned = $answers->where('is_correct', 1)->count();
                // Log::info('each quiz correct count');
                // Log::info($earned);
                $total = $answers->count();
                // Log::info('ဝင်ဖြေတဲ့ question count');
                // Log::info($total);
                $percentage = $total > 0
                    ? round(($earned / $total) * 100, 2)
                    : 0;
                // Log::info('each quiz percentage');
                // Log::info($percentage);
                $totalQuizPercentage += $percentage;

                $quizRows[] = [
                    'quiz' => $quiz,
                    'attempted' => true,
                    'earned' => $earned,
                    'total' => $total,
                    'percentage' => $percentage,
                ];
            } else {

                $quizRows[] = [
                    'quiz' => $quiz,
                    'attempted' => false,
                    'earned' => 0,
                    'total' => 0,
                    'percentage' => 0,
                ];
            }
        }
        // Log::info('complete quiz count');
        // Log::info($completedQuiz);
        // Log::info('Total quiz percentage');
        // Log::info($totalQuizPercentage);

        $quizCompletionRate = $quizTotal
            ? round(($completedQuiz / $quizTotal) * 100, 2)
            : 0;

        $quizAverage = $completedQuiz
            ? round($totalQuizPercentage / $completedQuiz, 2)
            : 0;



        // Log::info('quizCompletionRate');
        // Log::info($quizCompletionRate);
        // Log::info('quizAverage');
        // Log::info($quizAverage);

        // Log::info('Quiz finish');

        // | Live Analysis


        $lives = CourseLiveSession::where('course_id', $course->id)
            ->orderBy('scheduled_at')
            ->get();

        $liveRows = [];

        $totalLives = $lives->count();

        $joinedLives = 0;

        $totalJoinSeconds = 0;

        $totalCourseLiveSeconds = 0;

        foreach ($lives as $live) {

            if ($live->started_at && $live->ended_at) {

                $liveSeconds = strtotime($live->ended_at) - strtotime($live->started_at);
            } else {

                $liveSeconds = 0;
            }

            $totalCourseLiveSeconds += $liveSeconds;

            $participant = CourseLiveParticipant::where('live_session_id', $live->id)
                ->where('user_id', $user->id)
                ->first();

            $joinSeconds = $participant->duration_seconds ?? 0;
            if ($participant) {

                $joinedLives++;


                $totalJoinSeconds += $joinSeconds;

                $liveRows[] = [
                    'live' => $live,
                    'joined' => true,
                    'started_at' => $live->started_at,
                    'ended_at' => $live->ended_at,
                    'joined_at' => $participant->joined_at,
                    'left_at' => $participant->left_at,
                    'duration_seconds' => $joinSeconds,
                    'duration_minutes' => round($joinSeconds / 60, 1),
                    'live_seconds' => $liveSeconds,
                ];
            } else {

                $liveRows[] = [
                    'live' => $live,
                    'joined' => true,
                    'started_at' => $live->started_at,
                    'ended_at' => $live->ended_at,
                    'joined_at' => $participant->joined_at ?? '',
                    'left_at' => $participant->left_at ?? '',
                    'duration_seconds' => $joinSeconds ?? '',
                    'duration_minutes' => round($joinSeconds / 60, 1),
                    'live_seconds' => $liveSeconds,
                ];
            }
        }
        // Log::info('totalLives');
        // Log::info($totalLives);
        // Log::info('joinedLives');
        // Log::info($joinedLives);
        // Log::info('totalJoinSeconds');
        // Log::info($totalJoinSeconds);
        // Log::info('totalCourseLiveSeconds');
        // Log::info($totalCourseLiveSeconds);

        $attendanceRate = $totalLives
            ? round(($joinedLives / $totalLives) * 100, 2)
            : 0;

        $averageJoinMinutes = $joinedLives
            ? round(($totalJoinSeconds / $joinedLives) / 60, 2)
            : 0;

        $overallAverageMinutes = $totalLives
            ? round(($totalJoinSeconds / $totalLives) / 60, 2)
            : 0;
        $engagementRate = $totalCourseLiveSeconds
            ? round(($totalJoinSeconds / $totalCourseLiveSeconds) * 100, 2)
            : 0;
        // Log::info('live percentage');
        // Log::info('attendanceRate');
        // Log::info($attendanceRate);
        // Log::info('averageJoinMinutes');
        // Log::info($averageJoinMinutes);
        // Log::info('overallAverageMinutes');
        // Log::info($overallAverageMinutes);
        // Log::info('engagementRate');
        // Log::info($engagementRate);

        // Overall Progress
        $overallProgress = round(
            ($quizCompletionRate * 0.40) +
                ($quizAverage * 0.30) +
                ($attendanceRate * 0.15) +
                ($engagementRate * 0.15),
            2
        );
        Log::info('overallProgress');
        Log::info($overallProgress);
        // Course Order


        if ($order) {
            $order->update([
                'percentage' => $overallProgress,
            ]);
        }
        return view('instructor.learners_profile', [

            'course' => $course,

            'learner' => $user,

            'order' => $order,

            'quizRows' => $quizRows,

            'quizTotal' => $quizTotal,

            'completedQuiz' => $completedQuiz,

            'quizCompletionRate' => $quizCompletionRate,

            'quizAverage' => $quizAverage,

            'liveRows' => $liveRows,

            'totalLives' => $totalLives,

            'joinedLives' => $joinedLives,

            'attendanceRate' => $attendanceRate,

            'averageJoinMinutes' => $averageJoinMinutes,

            'overallAverageMinutes' => $overallAverageMinutes,

            'engagementRate' => $engagementRate,

            'overallProgress' => $overallProgress,

        ]);
    }

    public function complete(Course $course) //instructor complete course 
    {
        if ($course->instructor_id != auth()->id()) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ]);
        }

        $quizCount = Quiz::where('course_id', $course->id)->count();

        $liveCount = CourseLiveSession::where('course_id', $course->id)->count();

        $errors = [];

        if ($quizCount < 10) {
            $errors[] = "Quiz count must be at least 10. (Current : {$quizCount})";
        }

        if ($liveCount < 10) {
            $errors[] = "Live session count must be at least 10. (Current : {$liveCount})";
        }

        if (!empty($errors)) {

            return response()->json([
                'success' => false,
                'message' => implode('<br><br>', $errors)
            ]);
        }

        $course->status = 'completed';
        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'Course completed successfully.'
        ]);
    }
}
