@extends('layout.user')

@section('title','My Orders')
@section('content')



<!-- Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            My <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                Orders
            </span>
        </h1>

        <p class="text-slate-600 mt-1">
            Track and manage your purchases
        </p>
    </div>

    <div class="flex gap-3">

        <input
            type="text"
            placeholder="Search orders..."
            class="bg-slate-100 border border-slate-200 rounded-2xl px-4 py-3 w-64">

        <select
            class="bg-slate-100 border border-slate-200 rounded-2xl px-4 py-3">

            <option value="">All Orders</option>
            <option value="pending">Pending</option>
            <option value="failed">Processing</option>
            <option value="paid">Delivered</option>

        </select>

    </div>

</div>

<!-- Stats -->
<div class="grid md:grid-cols-4 gap-5 mb-8">

    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/50 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300"
        style="animation-delay:0ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Total Orders</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800">
                        {{ $totalOrderCount }}
                    </h2>
                    <p class="mt-2 text-xs text-slate-500">Total order counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                    <i class="ri-list-ordered text-2xl"></i>
                </div>
            </div>


        </div>
    </div>
    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300"
        style="animation-delay:150ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Pending</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800">
                        {{ $pendingCount ?? 0 }}
                    </h2>
                    <p class="mt-2 text-xs text-slate-500">Total pending counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                    <i class="ri-loader-2-line text-2xl"></i>
                </div>
            </div>


        </div>
    </div>
    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300"
        style="animation-delay:300ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Delivered</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800">
                        {{ $deliveredCount ?? 0 }}
                    </h2>
                    <p class="mt-2 text-xs text-slate-500">Total delivered counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-400 to-red-400 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                    <i class="ri-check-double-fill text-2xl"></i>
                </div>
            </div>


        </div>
    </div>
    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300"
        style="animation-delay:450ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Total Spent</p>
                    <h2 class="mt-3 text-lg md:text-xl font-extrabold tracking-tight text-slate-800">
                        {{ $totalSpent ?? 0}}
                    </h2>
                    <p class="mt-2 text-xs text-slate-500">Total spents</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-violet-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                    <i class="ri-hand-coin-line text-2xl"></i>
                </div>
            </div>


        </div>
    </div>

</div>

<!-- Orders -->

<div class="space-y-6 stat-card opacity-0 animate-stat-in" style="animation-delay:600ms">

    @foreach($orders as $order)

    <div
        class="group bg-white/80 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden hover:border-indigo-500/50 transition duration-500">

        <!-- Order Header -->
        <div class="border-b border-white/10 p-5">
            <div class="flex flex-col lg:flex-row lg:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h3 class="text-white font-bold text-lg">
                            <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                                Order #{{ $order->id }}
                            </span>
                        </h3>
                        @if($order->status == 'delivered')
                        <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                            Delivered
                        </span>@elseif($order->status == 'pending')
                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400 animate-pulse">
                            Pending
                        </span>
                        @else
                        <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-400">
                            Processing
                        </span>
                        @endif
                    </div>
                    <p class="text-slate-400 mt-2">
                        {{ $order->created_at->format('d M Y h:i A') }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-slate-400 text-sm">
                        Total Amount
                    </p>
                    <h2 class="text-xl font-bold text-slate-600">
                        {{ number_format($order->amount,2) }} MMK
                    </h2>
                </div>
            </div>
        </div>
        <!-- Products -->
        <div class="p-5">
            <div class="flex gap-4 pl-4">
                <img
                    src="{{ asset('storage/' . $order->payment_screenshot) }}"
                    class="w-24 h-24 rounded-2xl object-cover">
                <div class="flex-1">
                    <h4 class="">
                        <span class="text-sm text-slate-700">Title </span>
                        <a href="{{ route('instructor.single_course',$order->course->id) }}"><span class="text-blue-700 pl-4 font-bold text-lg"> {{ $order->course->title ?? ordername}}</span></a>
                    </h4>
                    <p class="text-slate-700 mt-1">
                        Qty : {{ $order->payment_method }}
                    </p>
                    <p class="text-slate-700 mt-2">
                        Status : {{ $order->status }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Timeline -->
        <div class="px-5 pb-5">
            <div class="flex justify-between items-center">
                <div class="flex-1">
                    <div class="relative">
                        <div class="h-1 bg-slate-700 rounded-full"></div>
                        <div
                            class="absolute top-0 left-0 h-1 bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full
    {{ $order->status == 'pending' ? 'w-1/4' : ($order->status == 'processing' ? 'w-2/4' : 'w-full') }}">
                        </div>
                    </div>
                    <div class="flex justify-between mt-3 text-xs">
                        <span class="text-green-400">
                            Ordered
                        </span>
                        <span class="text-yellow-400">
                            Processing
                        </span>
                        <span class="text-cyan-400">
                            Shipped
                        </span>
                        <span class="text-white">
                            Delivered
                        </span>

                    </div>

                </div>

            </div>

        </div>
    </div>

    @endforeach

</div>

<!-- Pagination -->

<div class="mt-8">
    {{ $orders->links() }}
</div>



<style>
    .custom-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg,
                #6366f1,
                #06b6d4);
        border-radius: 999px;
    }

    @keyframes float {

        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-50px);
        }

        100% {
            transform: translateY(0);
        }

    }

    .animate-float {
        animation: float 12s infinite ease-in-out;
    }

    .animate-float-delay {
        animation: float 16s infinite ease-in-out;
    }
</style>

@endsection