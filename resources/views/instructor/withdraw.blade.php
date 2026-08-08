@extends('layout.ins')
@section('title','Withdraw')
@section('page','Instructor Withdraw request and history Analysis.')
@section('content')

<style>
    @keyframes floatCard {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    @keyframes pulseGlow {

        0%,
        100% {
            box-shadow: 0 0 0 rgba(59, 130, 246, .2);
        }

        50% {
            box-shadow: 0 20px 40px rgba(59, 130, 246, .18);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .float-card {
        animation: floatCard 5s ease-in-out infinite;
    }

    .glow-card {
        animation: pulseGlow 4s infinite;
    }

    .fade-up {
        animation: fadeUp .7s ease;
    }

    .glass {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, .70);
    }

    .counter {
        font-variant-numeric: tabular-nums;
    }
</style>

<div class="pt-10">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div> <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-200/50 border border-sky-300 text-sky-700 text-sm font-semibold"> <i class="ri-wallet-3-line"></i> Instructor Wallet </span>
            <br>
            <h1 class="mt-4 text-3xl lg:text-35xl font-extrabold gradient-shine"> Withdraw Dashboard </h1>
            <p class="text-gray-500 mt-2"> Manage your earnings and withdraw your income securely. </p>
        </div>
        <div class="hidden lg:flex">
            <div class="glass rounded-3xl px-6 py-5 shadow-xl border border-white/60">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-r from-sky-500 to-cyan-500 flex items-center justify-center text-white text-3xl"> <i class="ri-bank-card-line"></i> </div>
                    <div>
                        <p class="text-sm text-gray-500"> Wallet Status </p>
                        <h3 class="font-bold text-emerald-600"> Active </h3>
                        <p class="text-xs text-gray-400"> Withdraw Anytime </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" px-4 mt-10">
    <div class="float-card glow-card rounded-[30px] overflow-hidden bg-gradient-to-r from-sky-600 via-cyan-500 to-blue-500 p-8 text-white shadow-2xl">
        <div class="flex flex-col lg:flex-row justify-between gap-8">
            <div>
                <p class="uppercase tracking-widest text-white/80"> Available Balance </p>
                <h2 class="counter mt-3 text-4xl lg:text-4xl font-black"> Ks {{ number_format($wallet->balance,2) }} </h2>
                <div class="mt-6 flex items-center gap-3"> <span class="h-3 w-3 rounded-full bg-green-300 animate-pulse"></span> <span class="text-white/90"> Ready for withdrawal </span> </div>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div class="glass rounded-3xl p-5 text-slate-700">
                    <div class="flex items-center justify-between"> <i class="ri-money-dollar-circle-line text-3xl"></i> <span class="text-xs bg-white/20 px-3 py-1 rounded-full"> Total </span> </div>
                    <p class="mt-5 text-sm"> Total Earnings </p>
                    <h3 class="mt-2 text-2xl font-bold"> Ks {{ number_format($wallet->total_earned,2) }} </h3>
                </div>
                <div class="glass rounded-3xl p-5 text-slate-700">
                    <div class="flex items-center justify-between"> <i class="ri-time-line text-3xl"></i> <span class="text-xs bg-yellow-300 text-yellow-900 px-3 py-1 rounded-full"> Pending </span> </div>
                    <p class="mt-5 text-sm"> Pending Balance </p>
                    <h3 class="mt-2 text-2xl font-bold"> Ks {{ number_format($wallet->pending_balance,2) }} </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6"> {{-- Available --}}
        <div class="fade-up glass rounded-3xl p-6 border border-white shadow-lg hover:-translate-y-2 duration-300">
            <div class="flex justify-between items-center">
                <div class="h-14 w-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                    <i class="ri-wallet-3-line text-sky-600 text-2xl"></i>
                </div>
                <span class="text-sky-600 text-sm font-semibold px-3 py-1 border border-sky-300 bg-sky-100/50 rounded-full"> + Active </span>
            </div>
            <h4 class="my-3 text-sm text-gray-500"> Available Balance </h4>
            <h2 class="text-2xl font-extrabold text-sky-800"> Ks {{ number_format($wallet->balance,2) }} </h2>
        </div>
        <div class="fade-up glass rounded-3xl p-6 shadow-lg border border-white hover:-translate-y-2 duration-300">
            <div class="flex justify-between items-center">
                <div class="h-14 w-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                    <i class="ri-loader-4-line text-yellow-500 text-2xl"></i>
                </div>
                <span class="text-yellow-600 text-sm font-semibold px-3 py-1 border border-yellow-300 bg-yellow-100/50 rounded-full"> Pending </span>
            </div>
            <h4 class="my-3 text-sm text-gray-500"> Pending Withdrawal </h4>
            <h2 class="text-2xl font-black text-yellow-800"> Ks {{ number_format($wallet->pending_balance,2) }} </h2>
        </div>
        <div class="fade-up glass rounded-3xl p-6 shadow-lg border border-white hover:-translate-y-2 duration-300">
            <div class="flex justify-between items-center">
                <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="ri-bank-card-line text-emerald-600 text-2xl"></i>
                </div>
                <span class="text-emerald-600 text-sm font-semibold px-3 py-1 border border-emerald-300 bg-emerald-100/50 rounded-full"> Paid </span>
            </div>
            <h4 class="my-3 text-sm text-gray-500"> Withdrawn </h4>
            <h2 class="mt-2 text-2xl font-black text-emerald-800"> Ks {{ number_format($wallet->total_withdrawn,2) }} </h2>
        </div> {{-- Total --}}
        <div class="fade-up glass rounded-3xl p-6 shadow-lg border border-white hover:-translate-y-2 duration-300">
            <div class="flex justify-between items-center">
                <div class="h-14 w-14 rounded-2xl bg-purple-100 flex items-center justify-center">
                    <i class="ri-line-chart-line text-purple-600 text-2xl"></i>
                </div>
                <span class="text-purple-600 text-sm font-semibold px-3 py-1 border border-purple-300 bg-purple-100/50 rounded-full"> Lifetime </span>
            </div>
            <h4 class="my-3 text-sm text-gray-500"> Total Earnings </h4>
            <h2 class="text-2xl font-black text-purple-800"> Ks {{ number_format($wallet->total_earned,2) }} </h2>
        </div>
    </div>
</div>
<div class=" px-4 pb-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8"> {{-- Withdraw Form --}}
        <div class="lg:col-span-2">
            <div class="glass rounded-[28px] shadow-xl border border-white p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-r from-sky-500 to-cyan-500 flex items-center justify-center text-white text-3xl"> <i class="ri-bank-card-line"></i> </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800"> Withdraw Request </h2>
                        <p class="text-gray-500 mt-1"> Your request will be reviewed by the administrator. </p>
                    </div>
                </div> @if(session('success')) <div class="mb-6 rounded-2xl bg-green-100 border border-green-300 text-green-700 p-4"> {{ session('success') }} </div> @endif @if(session('error')) <div class="mb-6 rounded-2xl bg-red-100 border border-red-300 text-red-700 p-4"> {{ session('error') }} </div> @endif <form action="{{ route('instructor.withdraw.store') }}" method="POST" class="space-y-7"> @csrf {{-- Amount --}}
                    <div> <label class="font-semibold text-gray-700"> Withdraw Amount (Ks) </label>
                        <div class="relative mt-2"> <i class="ri-money-dollar-circle-line absolute left-4 top-4 text-xl text-sky-500"></i> <input type="number" name="amount" value="{{ old('amount') }}" placeholder="Enter amount" class="w-full rounded-2xl border border-gray-200 bg-white pl-12 pr-4 py-4 focus:outline-none focus:ring-2 focus:ring-sky-400"> </div> @error('amount') <p class="text-red-500 mt-2 text-sm"> {{ $message }} </p> @enderror
                    </div> {{-- Payment Method --}}
                    <div> <label class="font-semibold text-gray-700"> Payment Method </label> <select name="payment_method" class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 focus:ring-2 focus:ring-sky-400">
                            <option value="KBZ Pay">KBZ Pay</option>
                            <option value="Wave Pay">Wave Pay</option>
                            <option value="AYA Pay">AYA Pay</option>
                            <option value="CB Pay">CB Pay</option>
                            <option value="UAB Pay">UAB Pay</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select> @error('payment_method') <p class="text-red-500 mt-2 text-sm"> {{ $message }} </p> @enderror </div> {{-- Account Name --}}
                    <div> <label class="font-semibold text-gray-700"> Account Name </label> <input type="text" name="account_name" value="{{ old('account_name') }}" placeholder="Account Holder Name" class="mt-2 w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-sky-400"> @error('account_name') <p class="text-red-500 mt-2 text-sm"> {{ $message }} </p> @enderror </div> {{-- Account Number --}}
                    <div> <label class="font-semibold text-gray-700"> Account Number </label> <input type="number" name="account_number" value="{{ old('account_number') }}" placeholder="09xxxxxxxx" class="mt-2 w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-sky-400"> @error('account_number') <p class="text-red-500 mt-2 text-sm"> {{ $message }} </p> @enderror </div> {{-- Note --}}
                    <div> <label class="font-semibold text-gray-700"> Note </label> <textarea rows="4" name="note" placeholder="Optional note..." class="mt-2 w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-sky-400">{{ old('note') }}</textarea> </div> {{-- Summary Box --}}
                    <div class="rounded-3xl bg-gradient-to-r from-sky-50 to-cyan-50 border border-sky-100 p-6">
                        <div class="flex justify-between mb-3"> <span class="text-gray-500"> Available Balance </span> <span class="font-bold text-sky-700"> Ks {{ number_format($wallet->available_balance,2) }} </span> </div>
                        <div class="flex justify-between"> <span class="text-gray-500"> Status </span> <span class="px-4 py-1 rounded-full bg-green-100 text-green-600 text-sm font-semibold"> Ready to Withdraw </span> </div>
                    </div> {{-- Button --}} <button class="w-full rounded-2xl py-4 text-lg font-bold text-white bg-gradient-to-r from-sky-500 via-cyan-500 to-blue-500 shadow-xl hover:scale-[1.02] duration-300"> <i class="ri-send-plane-fill mr-2"></i> SubmitWithdraw Request </button>
                </form>
            </div>
        </div> {{-- Right Side --}}
        <div> {{-- Tips Card --}}
            <div class="glass rounded-[28px] p-6 shadow-xl">
                <div class="h-16 w-16 rounded-2xl bg-yellow-100 flex items-center justify-center text-yellow-500 text-3xl"> <i class="ri-lightbulb-flash-line"></i> </div>
                <h3 class="mt-6 text-xl font-bold"> Withdrawal Tips </h3>
                <div class="mt-5 space-y-4 text-gray-600">
                    <div class="flex gap-3"> <i class="ri-checkbox-circle-fill text-green-500 mt-1"></i>
                        <p>Make sure your account number is correct.</p>
                    </div>
                    <div class="flex gap-3"> <i class="ri-checkbox-circle-fill text-green-500 mt-1"></i>
                        <p>Requests are reviewed within 24 hours.</p>
                    </div>
                    <div class="flex gap-3"> <i class="ri-checkbox-circle-fill text-green-500 mt-1"></i>
                        <p>Only available balance can be withdrawn.</p>
                    </div>
                    <div class="flex gap-3"> <i class="ri-checkbox-circle-fill text-green-500 mt-1"></i>
                        <p>Incorrect payment information may delay your payment.</p>
                    </div>
                </div>
            </div> {{-- Security Card --}}
            <div class="glass rounded-[28px] shadow-xl p-6 mt-6">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-2xl bg-green-100 flex items-center justify-center"> <i class="ri-shield-check-line text-2xl text-green-600"></i> </div>
                    <div>
                        <h4 class="font-bold text-lg"> Secure Payment </h4>
                        <p class="text-sm text-gray-500"> All withdrawals are manually verified. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" px-4 pb-16">
    <div class="glass rounded-[30px] shadow-xl border border-white overflow-hidden"> {{-- Header --}}
        <div class="p-6 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-r from-indigo-500 to-sky-500 text-white flex items-center justify-center text-2xl"> <i class="ri-history-line"></i> </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800"> Withdrawal History </h2>
                        <p class="text-gray-500"> View all your withdrawal requests. </p>
                    </div>
                </div>
            </div>
        </div>
        @if($withdrawals->count()) {{-- Desktop Table --}}
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-sky-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> # </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> Amount </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> Payment </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> Account </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> Status </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700"> Date </th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700"> Action </th>
                    </tr>
                </thead>
                <tbody> @foreach($withdrawals as $withdraw) <tr class="border-t hover:bg-sky-50 duration-300">
                        <td class="px-6 py-5 font-semibold"> #{{ $withdraw->id }} </td>
                        <td class="px-6 py-5 font-bold text-sky-700"> Ks {{ number_format($withdraw->amount,2) }} </td>
                        <td class="px-6 py-5"> {{ $withdraw->payment_method }} </td>
                        <td class="px-6 py-5"> {{ $withdraw->account_number }} </td>
                        <td class="px-6 py-5"> @if($withdraw->status=='pending') <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold animate-pulse"> Pending </span> @elseif($withdraw->status=='paid') <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold"> Paid </span> @else <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold"> Rejected </span> @endif </td>
                        <td class="px-6 py-5 text-gray-500"> {{ $withdraw->created_at->format('d M Y') }} </td>
                        <td class="px-6 py-5 text-center">
                            @if($withdraw->status=='pending')
                            <form action="{{ route('instructor.withdraw.cancel',$withdraw->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Cancel this withdrawal request?')"
                                    class="px-5 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white duration-300"> Cancel </button>
                            </form>
                            @else
                            @if($withdraw->status=='rejected')
                            <span class="text-gray-400"> {{ $withdraw->rejected_reason }}</span>
                            @else
                            <span class="text-gray-400"> -- </span>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> {{-- Mobile Cards --}}
        <div class="lg:hidden p-5 space-y-5"> @foreach($withdrawals as $withdraw) <div class="rounded-3xl border border-sky-100 bg-white shadow-lg p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg"> Ks {{ number_format($withdraw->amount,2) }} </h3>
                        <p class="text-sm text-gray-500 mt-1"> {{ $withdraw->payment_method }} </p>
                    </div> @if($withdraw->status=='pending') <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold animate-pulse"> Pending </span> @elseif($withdraw->status=='paid') <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold"> Paid </span> @else <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold"> Rejected </span> @endif
                </div>
                <div class="mt-5 space-y-2 text-sm">
                    <div class="flex justify-between"> <span class="text-gray-500"> Account </span> <span> {{ $withdraw->account_number }} </span> </div>
                    <div class="flex justify-between"> <span class="text-gray-500"> Date </span> <span> {{ $withdraw->created_at->format('d M Y') }} </span> </div>
                </div>
                @if($withdraw->status=='pending')
                <form action="{{ route('instructor.withdraw.cancel',$withdraw->id) }}" method="POST"
                    class="mt-5">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Cancel this withdrawal request?')"
                        class="w-full py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold duration-300">
                        Cancel Request </button>
                </form>
                @endif
            </div>
            @endforeach
        </div> {{-- Pagination --}}
        <div class="p-6 border-t border-gray-100"> {{ $withdrawals->links() }} </div> @else {{-- Empty State --}}
        <div class="py-20 text-center">
            <div class="h-28 w-28 rounded-full bg-sky-100 mx-auto flex items-center justify-center"> <i class="ri-bank-card-line text-5xl text-sky-500"></i> </div>
            <h3 class="mt-6 text-2xl font-bold text-gray-800"> No Withdrawal Requests </h3>
            <p class="mt-3 text-gray-500"> You haven't submitted any withdrawal requests yet. </p>
        </div>
        @endif
    </div>
</div>
@endsection