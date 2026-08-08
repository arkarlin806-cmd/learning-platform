<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\InstructorWallet;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Log;

class WithdrawalController extends Controller
{

    public function index_with() //instructor withdraw page
    {
        $wallet = InstructorWallet::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'balance'      => 0,
                'total_earned'  => 0,
                // 'pending_balance'    => 0,
                'total_withdrawn'  => 0,
            ]
        );

        $withdrawals = Withdrawal::where('instructor_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('instructor.withdraw', compact('wallet', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'          => 'required|numeric|min:10000',
            'payment_method'  => 'required|string|max:100',
            'account_name'    => 'required|string|max:255',
            'account_number'  => 'required|string|max:255',
            'note'            => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {

            $wallet = InstructorWallet::where('user_id', Auth::id())
                ->lockForUpdate()
                ->firstOrFail();

            if ($request->amount > $wallet->balance) {

                return back()
                    ->withInput()
                    ->with('error', 'Insufficient available balance.');
            }

            Withdrawal::create([
                'wallet_id'       => $wallet->id,
                'instructor_id'   => Auth::id(),
                'amount'          => $request->amount,
                'payment_method'  => $request->payment_method,
                'account_name'    => $request->account_name,
                'account_number'  => $request->account_number,
                'note'            => $request->note,
                'status'          => 'pending',
            ]);

            $wallet->balance -= $request->amount;
            $wallet->pending_balance += $request->amount;
            $wallet->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Withdrawal request submitted successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $withdrawals = Withdrawal::where('instructor_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('instructor.wallet.history', compact('withdrawals'));
    }

    public function cancel($id) //instructor withdraw  request cancel
    {
        DB::beginTransaction();

        try {

            $withdrawal = Withdrawal::where('id', $id)
                ->where('instructor_id', Auth::id())
                ->where('status', 'pending')
                ->firstOrFail();

            $wallet = InstructorWallet::lockForUpdate()
                ->findOrFail($withdrawal->wallet_id);

            $wallet->balance += $withdrawal->amount;
            $wallet->pending_balance -= $withdrawal->amount;
            $wallet->save();

            $withdrawal->status = 'rejected';
            $withdrawal->rejected_reason = 'Cancelled by instructor';
            $withdrawal->save();

            DB::commit();

            return back()->with('success', 'Withdrawal cancelled successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function withdraw_index(Request $request) //admin all withdraw show
    {

        $query = Withdrawal::with([
            'instructor',
            'wallet'
        ]);


        // Search Instructor
        if ($request->search) {

            $query->whereHas('instructor', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }



        // Status Filter
        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }



        // Date Filter
        if ($request->date) {

            $query->whereDate(
                'created_at',
                $request->date
            );
        }



        $withdrawals =
            $query
            ->latest()
            ->paginate(10);
        // ->withQueryString();



        /*
        Statistics
        */


        $pendingCount =
            Withdrawal::where('status', 'pending')
            ->count();



        $pendingAmount =
            Withdrawal::where('status', 'pending')
            ->sum('amount');



        $todayPaid =
            Withdrawal::where('status', 'paid')
            ->whereDate(
                'approved_at',
                today()
            )
            ->sum('amount');



        $rejectedCount =
            Withdrawal::where('status', 'rejected')
            ->count();



        return view(
            'admin.withdraw',
            compact(
                'withdrawals',
                'pendingCount',
                'pendingAmount',
                'todayPaid',
                'rejectedCount'
            )
        );
    }

    public function withdraw_approve($id) //admin single withdraw accept
    {

        DB::beginTransaction();
        try {
            $withdrawal =
                Withdrawal::where('id', $id)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->firstOrFail();
            $wallet =
                InstructorWallet::where(
                    'id',
                    $withdrawal->wallet_id
                )
                ->lockForUpdate()
                ->firstOrFail();

            $wallet->pending_balance -=
                $withdrawal->amount;

            // $wallet->balance -=
            //     $withdrawal->amount;

            $wallet->total_withdrawn +=
                $withdrawal->amount;

            $wallet->save();

            $withdrawal->update([
                'status' => 'paid',
                'approved_at' => now()
            ]);
            DB::commit();
            return back()->with(
                'success',
                'Withdrawal approved successfully.'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function withdraw_reject(Request $request, $id) //admin single withdraw reject
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        DB::beginTransaction();

        try {
            $withdrawal =
                Withdrawal::where('id', $id)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->firstOrFail();
            $wallet =
                InstructorWallet::where(
                    'id',
                    $withdrawal->wallet_id
                )
                ->lockForUpdate()
                ->firstOrFail();

            $wallet->pending_balance -=
                $withdrawal->amount;
            $wallet->balance +=
                $withdrawal->amount;
            $wallet->save();

            $withdrawal->update([
                'status' => 'rejected',
                'rejected_reason' =>
                $request->reason
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Withdrawal rejected successfully.'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function walletAnalytics()
    {
        return response()->json([

            'success' => true,

            'data' => [

                'total_earnings' => InstructorWallet::sum('total_earned'),

                'total_withdraw' => InstructorWallet::sum('total_withdrawn'),

                'total_balance' => InstructorWallet::sum('balance'),

            ]

        ]);
    }
}
