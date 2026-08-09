<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstructorRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseRating;
use App\Models\CourseOrder;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Course::select(
            'category',
            DB::raw('COUNT(*) as total_courses')
        )
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderByDesc('total_courses')
            ->get();
        $topCourses = Course::select(
            'courses.*',
            DB::raw('ROUND(AVG(course_ratings.rating),1) as average_rating'),
            DB::raw('COUNT(course_ratings.id) as total_ratings')
        )
            ->leftJoin('course_ratings', 'courses.id', '=', 'course_ratings.course_id')
            ->groupBy('courses.id')
            ->orderByDesc('average_rating')
            ->orderByDesc('total_ratings')
            ->take(3)
            ->get();
        return view('home.index', compact('categories', 'topCourses'));
    }
    public function comparison()
    {
        return view('comparison.index');
    }
    public function create()    //instructro request form
    {
        return view('home.request');
    }
    public function store(Request $request)
    {
        // Already instructor
        if (auth()->user()->role == 2) {

            return back()->with(
                'error',
                'You are already an instructor.'
            );
        }

        // Pending Request
        $pending = InstructorRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->exists();

        if ($pending) {

            return back()->with(
                'error',
                'You already have a pending request.'
            );
        }

        // Validation
        $request->validate([

            'phone' => 'required|string|max:30',

            'profession' => 'required|string|max:255',

            'experience' => 'nullable|string|max:255',

            'bio' => 'required|string|min:30',

            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',

            'certificate' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',

        ]);

        /**
         * Upload CV
         */
        $cv = null;

        if ($request->hasFile('cv')) {

            $cv = $request
                ->file('cv')
                ->store('instructor/cv', 'public');
        }

        /**
         * Upload Certificate
         */
        $certificate = null;

        if ($request->hasFile('certificate')) {

            $certificate = $request
                ->file('certificate')
                ->store('instructor/certificate', 'public');
        }

        /**
         * Save
         */
        InstructorRequest::create([

            'user_id' => auth()->id(),

            'full_name' => auth()->user()->name,

            'email' => auth()->user()->email,

            'phone' => $request->phone,

            'profession' => $request->profession,

            'experience' => $request->experience,

            'bio' => $request->bio,

            'cv' => $cv,

            'certificate' => $certificate,

            'status' => 'pending',

        ]);

        return redirect()

            ->route('become-instructor')

            ->with(
                'success',
                'Your instructor request has been submitted successfully.'
            );
    }


    public function ins_index(Request $request)
    {
        $query = User::query()
            ->where('role', 2)
            ->select('users.*')
            ->selectSub(function ($q) {
                $q->from('course_ratings')
                    ->join('courses', 'courses.id', '=', 'course_ratings.course_id')
                    ->whereColumn('courses.instructor_id', 'users.id')
                    ->selectRaw('ROUND(AVG(course_ratings.rating), 1)');
            }, 'average_rating');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $instructors = $query
            ->latest()
            ->paginate(12);

        return view('home.all_ins', compact('instructors'));
    }

    public function single_ins_show(User $instructor)
    {

        abort_if($instructor->role != 2, 404);
        $instructor->load([
            'courses' => function ($query) {
                $query->latest()
                    ->take(6);
            }
        ]);

        $ins_info = InstructorRequest::where('user_id', $instructor->id)
            ->where('status', 'approved')
            ->first();
        $totalStudents = $instructor
            ->courses()
            ->withCount('orders')
            ->get()
            ->sum('orders_count');


        $totalCourses = $instructor
            ->courses()
            ->count();



        $averageRating = $instructor
            ->courses()
            ->withAvg('ratings', 'rating')
            ->get()
            ->avg('ratings_avg_rating');

        $userId = auth()->id();

        $courses = Course::with([
            'ratings' => function ($query) use ($userId) {

                $query->where(
                    'user_id',
                    $userId
                );
            }
        ])
            ->where('instructor_id', $instructor->id)
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->latest()
            ->get();



        $purchasedCourseIds = CourseOrder::where('user_id', $userId)
            ->pluck('course_id')
            ->toArray();

        $topRatedStudents = CourseRating::whereHas(
            'course',
            function ($query) use ($instructor) {

                $query->where(
                    'instructor_id',
                    $instructor->id
                );
            }
        )
            ->with('user')
            ->orderByDesc('rating')
            ->take(3)
            ->get();

        return view(
            'home.single_ins',
            compact(
                'instructor',
                'totalStudents',
                'totalCourses',
                'averageRating',
                'ins_info',
                'courses',
                'purchasedCourseIds',
                'topRatedStudents'
            )
        );
    }

    public function getAboutPageData(): array
    {
        return [
            'hero' => [
                'title' => 'Empowering Education Through Technology',
                'description' => 'Welcome to our platform. We are dedicated to bridging the gap between passionate learners and expert educators.',
            ],
            'learners' => [
                'tagline' => 'For Learners',
                'title' => 'Transform Your Learning Journey',
                'description' => 'Master new skills and advance your career with tools designed to keep you engaged and on track.',
                'features' => [
                    [
                        'title' => 'Structured & Flexible Courses',
                        'description' => 'Access curated content from fundamentals to advanced levels, and learn at your own pace anytime.'
                    ],
                    [
                        'title' => 'Hands-on Practice',
                        'description' => 'Test your skills with real-world projects, assignments, and interactive quizzes.'
                    ],
                    [
                        'title' => 'Interactive Discussions',
                        'description' => 'Ask questions directly to instructors and collaborate with a community of peers.'
                    ],
                    [
                        'title' => 'Verified Certificates',
                        'description' => 'Earn certificates upon completion to showcase your achievements on your CV or LinkedIn.'
                    ],
                ]
            ],
            'instructors' => [
                'tagline' => 'For Instructors',
                'title' => 'Share Knowledge & Build Your Legacy',
                'description' => 'Empower the next generation of professionals while growing your personal brand and income.',
                'features' => [
                    [
                        'title' => 'Easy Course Creation',
                        'description' => 'Upload video lessons, quizzes, and resources with our intuitive management tools.'
                    ],
                    [
                        'title' => 'Student Management',
                        'description' => 'Track student progress, grade assignments, and offer personalized feedback effortlessly.'
                    ],
                    [
                        'title' => 'Monetization & Analytics',
                        'description' => 'Generate sustainable income and gain insights into student engagement with built-in analytics.'
                    ],
                ]
            ],
            'mission' => [
                'statement' => 'To make quality education accessible to every learner, and to empower every educator with the platform they deserve.',
                'author' => 'The EduPlatform Team'
            ]
        ];
    }

    public function set_index()
    {
        return view('settings.index');
    }
}
