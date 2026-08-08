<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\InstructorWallet;
use App\Models\InstructorRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totaluser = User::where('role', 0)->count();
        $monthuser = User::where('role', 0)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $totalInstructor = User::where('role', 2)->count();
        $monthInstructor = User::where('role', 2)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $totalCourse = Course::where('status', 'draft')->count();
        $monthCourse = Course::where('status', 'draft')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();

        $userId = auth()->id();


        $courses = Course::with([
            'ratings' => function ($query) use ($userId) {

                $query->where(
                    'user_id',
                    $userId
                );
            }
        ])
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->latest()
            ->get();



        $purchasedCourseIds = CourseOrder::where('user_id', $userId)
            ->pluck('course_id')
            ->toArray();

        // instructor role id = 2
        $totalAccounts = $totaluser + $totalInstructor;


        return view('admin/dashboard', compact(
            'totaluser',
            'totalInstructor',
            'totalCourse',
            'monthuser',
            'monthInstructor',
            'monthCourse',
            'courses',
            'purchasedCourseIds',
            'totalAccounts'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->search;

        $users = User::query()
            ->where('role', 0)
            ->when($search, function ($query) use ($search) {

                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->where('role', 0);
            })

            ->latest()
            ->paginate(5);

        // AJAX REQUEST
        if ($request->ajax()) {

            return view('admin.table', compact('users'))->render();
        }

        return view('admin.users', compact('users'));
    }
    public function instructors(Request $request)
    {
        $search = $request->search;

        $users = User::query()
            ->where('role', 2)
            ->when($search, function ($query) use ($search) {

                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->where('role', 1);
            })

            ->latest()
            ->paginate(5);

        // AJAX REQUEST
        if ($request->ajax()) {

            return view('admin.table', compact('users'))->render();
        }

        return view('admin.instructors', compact('users'));
    }

    public function earnings()
    {
        $total = CourseOrder::where('status', 'paid')
            ->sum('amount');
        $currentMonthIncome = CourseOrder::where('status', 'paid')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $totalAdmin = CourseOrder::where('status', 'paid')
            ->sum('admin_amount');
        $currentMonthAdminIncome = CourseOrder::where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('admin_amount');
        $totalIns = CourseOrder::where('status', 'paid')
            ->sum('instructor_amount');
        $currentMonthInstructorIncome = CourseOrder::where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('instructor_amount');
        return view('admin.earnings', compact(
            'total',
            'currentMonthIncome',
            'totalAdmin',
            'currentMonthAdminIncome',
            'totalIns',
            'currentMonthInstructorIncome'
        ));
    }
    public function course_show($id) //single course show
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
            'admin.course',
            compact(
                'course',
                'instructor',
                'courseCount',
                'isPurchased'
            )
        );
    }

    public function earningsChart()
    {
        $labels = [];
        $earnings = [];

        for ($i = 11; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $labels[] = $date->format('M');

            $earnings[] = CourseOrder::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('admin_amount');
        }

        return response()->json([
            'labels' => $labels,
            'earnings' => $earnings
        ]);
    }
    public function instructorEarningsChart()
    {
        $wallets = InstructorWallet::with('instructor:id,name')
            ->get();


        $data = $wallets->map(function ($wallet) {

            return [

                'name' => $wallet->instructor
                    ? $wallet->instructor->name
                    : 'Unknown',


                'total' => $wallet->total_earned ?? 0,


                'available' => $wallet->balance ?? 0,


                'withdraw' => $wallet->total_withdrawn ?? 0,

            ];
        });


        return response()->json($data);
    }
    public function getChartData(Request $request)
    {
        $filter = $request->get('filter', 'days');
        $labels = [];
        $data = [];


        if ($filter === 'days') {
            $startDate = Carbon::now()->subDays(14)->startOfDay();
            $endDate = Carbon::now()->endOfDay();


            $users = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('count', 'date')->toArray();


            for ($i = 14; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('Y-m-d');
                $labels[] = Carbon::now()->subDays($i)->format('M d');
                $data[] = $users[$date] ?? 0;
            }
        } elseif ($filter === 'months') {
            $users = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('month')
                ->pluck('count', 'month')->toArray();

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            foreach ($months as $key => $monthName) {
                $labels[] = $monthName;
                $data[] = $users[$key + 1] ?? 0; // MONTH() က 1 မှ 12 အထိ ပြန်ပေးသောကြောင့် key + 1 သုံးသည်
            }
        } elseif ($filter === 'years') {
            $currentYear = Carbon::now()->year;
            $users = User::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
                ->whereYear('created_at', '>=', $currentYear - 4)
                ->groupBy('year')
                ->pluck('count', 'year')->toArray();

            for ($i = 4; $i >= 0; $i--) {
                $year = $currentYear - $i;
                $labels[] = (string)$year;
                $data[] = $users[$year] ?? 0;
            }
        }


        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
    public function ins_request_index(Request $request) //instructor request to admin
    {
        $requests = InstructorRequest::with('user')

            ->when($request->search, function ($query) use ($request) {

                $query->where(function ($q) use ($request) {

                    $q->where('full_name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%' . $request->search . '%')
                        ->orWhere('profession', 'like', '%' . $request->search . '%');
                });
            })

            ->when($request->status, function ($query) use ($request) {

                $query->where('status', $request->status);
            })

            ->latest()

            ->paginate(10);

        // ->withQueryString();

        return view(
            'admin.ins_request',
            compact('requests')
        );
    }
    public function ins_request_show($id) //instructor request single show
    {
        $requestData = InstructorRequest::with('user')
            ->findOrFail($id);

        return view(
            'admin.ins_single_request',
            compact('requestData')
        );
    }

    public function ins_request_updateStatus(Request $request, $id) // instructor request accept or reject
    {
        log::info('recieve');
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reject_reason' => 'nullable|string|max:1000'
        ]);

        $instructorRequest = InstructorRequest::with('user')
            ->findOrFail($id);

        /**
         * Prevent updating again
         */
        if ($instructorRequest->status != 'pending') {

            return back()->with(
                'error',
                'This request has already been processed.'
            );
        }

        /**
         * Approve
         */
        if ($request->status == 'approved') {

            $instructorRequest->update([

                'status' => 'approved',

                'approved_by' => auth()->id(),

                'approved_at' => Carbon::now(),

                'reject_reason' => null,

            ]);

            /**
             * Update user role
             * role = 2 (Instructor)
             */
            $instructorRequest->user->update([

                'role' => 2

            ]);

            return redirect()

                ->route('instructor.requests.index')

                ->with(
                    'success',
                    'Instructor request approved successfully.'
                );
        }

        /**
         * Reject
         */

        if (!$request->reject_reason) {

            return back()

                ->with(
                    'error',
                    'Reject reason is required.'
                );
        }

        $instructorRequest->update([

            'status' => 'rejected',

            'reject_reason' => $request->reject_reason,

            'approved_by' => auth()->id(),

            'approved_at' => Carbon::now()

        ]);

        return redirect()

            ->route('instructor.requests.index')

            ->with(
                'success',
                'Instructor request rejected successfully.'
            );
    }
}
