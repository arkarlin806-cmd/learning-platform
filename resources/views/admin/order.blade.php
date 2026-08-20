@extends('layout.admin')
@section('page_title','Course Orders')
@section('page','Admin analysis course orders and accept or reject.')
@section('content')



<!-- Hero Header -->
<div class="mb-8">
    <div class="rounded-[30px] border border-white/70 bg-white/75 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-5 md:p-7">
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 mb-4">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Order Management
                </div>

                <h2 class="text-2xl md:text-4xl font-extrabold tracking-tight text-slate-800 leading-tight">
                    Course Orders
                </h2>
                <p class="text-slate-500 mt-3 max-w-2xl text-sm md:text-base">
                    Track course purchases, review payment statuses, and manage learner order activity from one clean dashboard.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full xl:w-auto">
                <div class="rounded-3xl bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                        Total Orders
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{ $orders->total() }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">
                        All recorded orders
                    </p>
                </div>

                <div class="rounded-3xl bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">
                        Paid Orders
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{ $orders->where('status', 'paid')->count() }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">
                        Successful payments
                    </p>
                </div>

                <div class="rounded-3xl bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-600">
                        Pending
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{ $orders->where('status', 'pending')->count() }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">
                        Awaiting confirmation
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search / Filter -->
<div class="mb-8">
    <div class="rounded-[30px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_35px_rgba(15,23,42,0.06)] p-5 md:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-5">
            <div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-800">
                    Search & Filter Orders
                </h3>
                <p class="text-sm text-slate-500 mt-1">
                    Find orders by order number or narrow results by payment status.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-100 px-3 py-1.5 text-xs font-semibold">
                    Pending
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-green-50 text-green-700 border border-green-100 px-3 py-1.5 text-xs font-semibold">
                    Paid
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-red-50 text-red-700 border border-red-100 px-3 py-1.5 text-xs font-semibold">
                    Failed
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-sky-50 text-sky-700 border border-sky-100 px-3 py-1.5 text-xs font-semibold">
                    Refund
                </span>
            </div>
        </div>

        <form method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            <!-- Search input -->
            <div class="lg:col-span-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Order Number
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search order no..."
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-4 py-4 text-slate-700 outline-none focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 transition">
                </div>
            </div>

            <!-- Status -->
            <div class="lg:col-span-3">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Payment Status
                </label>
                <select
                    name="status"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-4 text-slate-700 outline-none focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 transition">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refund" {{ request('status') == 'refund' ? 'selected' : '' }}>Refund</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="lg:col-span-3 flex flex-col sm:flex-row gap-3 lg:items-end">
                <button
                    type="submit"
                    class="w-full sm:flex-1 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-semibold px-6 py-4 shadow-lg shadow-indigo-200 hover:-translate-y-0.5 hover:shadow-xl transition">
                    Search
                </button>

                <a
                    href="{{ url()->current() }}"
                    class="w-full sm:w-auto rounded-2xl border border-slate-200 bg-white text-slate-700 font-semibold px-6 py-4 text-center hover:bg-slate-50 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Orders -->
<div class="rounded-[30px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] overflow-hidden">
    <!-- section header -->
    <div class="px-5 md:px-7 py-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="font-bold text-xl md:text-2xl text-slate-800">
                Orders List
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Review all course purchases and their current payment status.
            </p>
        </div>

        <div class="inline-flex items-center gap-2 rounded-2xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 w-fit">
            <span>🧾</span>
            {{ $orders->count() }} orders on this page
        </div>
    </div>

    <!-- Desktop Table -->
    <div class="hidden xl:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/90">
                <tr class="text-left">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Order</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">User</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Course</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Amount</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-t border-slate-100 hover:bg-indigo-50/30 transition duration-200">
                    <td class="px-6 py-5">
                        <div class="font-bold text-slate-800">
                            {{ $order->order_no }}
                        </div>
                        <div class="text-sm text-slate-500 mt-1">
                            Order ID
                        </div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="font-semibold text-slate-800">
                            {{ $order->user->name }}
                        </div>
                        <div class="text-sm text-slate-500 mt-1">
                            Student
                        </div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="font-semibold text-slate-800">
                            {{ $order->course->title }}
                        </div>
                        <div class="text-sm text-slate-500 mt-1">
                            Purchased course
                        </div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="inline-flex items-center rounded-2xl bg-slate-50 border border-slate-200 px-3 py-2 text-sm font-bold text-slate-800">
                            MMK {{ number_format($order->amount) }}
                        </div>
                    </td>

                    <td class="px-6 py-5">
                        @if($order->status == 'pending')
                        <span class="inline-flex items-center gap-2 rounded-full bg-yellow-50 border border-yellow-100 px-3 py-1.5 text-xs font-bold text-yellow-700">
                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                            Pending
                        </span>
                        @elseif($order->status == 'paid')
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Paid
                        </span>
                        @elseif($order->status == 'failed')
                        <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 border border-rose-100 px-3 py-1.5 text-xs font-bold text-rose-700">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            Failed
                        </span>
                        @elseif($order->status == 'refund')
                        <span class="inline-flex items-center gap-2 rounded-full bg-sky-50 border border-sky-100 px-3 py-1.5 text-xs font-bold text-sky-700">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            Refund
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-5">
                        <a
                            href="{{ route('course.show_order', $order->id) }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white px-4 py-2.5 font-semibold shadow-md shadow-indigo-200 hover:-translate-y-0.5 transition">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 mx-auto rounded-3xl bg-slate-100 flex items-center justify-center text-4xl mb-4">
                                🧾
                            </div>
                            <h3 class="text-xl font-bold text-slate-800">No orders found</h3>
                            <p class="text-slate-500 mt-2">
                                There are no orders matching your current filters.
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile / Tablet Cards -->
    <div class="xl:hidden p-4 md:p-5 space-y-4">
        @forelse($orders as $order)
        <div class="group rounded-[26px] border border-slate-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">
            <!-- accent line -->
            <div class="h-1.5
                            @if($order->status == 'pending') bg-gradient-to-r from-yellow-400 to-amber-500
                            @elseif($order->status == 'paid') bg-gradient-to-r from-emerald-400 to-teal-500
                            @elseif($order->status == 'failed') bg-gradient-to-r from-rose-400 to-red-500
                            @elseif($order->status == 'refund') bg-gradient-to-r from-sky-400 to-cyan-500
                            @else bg-gradient-to-r from-slate-300 to-slate-400
                            @endif">
            </div>

            <div class="p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">
                            Order No
                        </p>
                        <h3 class="text-lg md:text-xl font-bold text-slate-800 mt-1 break-all">
                            {{ $order->order_no }}
                        </h3>
                    </div>

                    @if($order->status == 'pending')
                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-yellow-50 border border-yellow-100 px-3 py-1.5 text-xs font-bold text-yellow-700">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        Pending
                    </span>
                    @elseif($order->status == 'paid')
                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Paid
                    </span>
                    @elseif($order->status == 'failed')
                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-rose-50 border border-rose-100 px-3 py-1.5 text-xs font-bold text-rose-700">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Failed
                    </span>
                    @elseif($order->status == 'refund')
                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-sky-50 border border-sky-100 px-3 py-1.5 text-xs font-bold text-sky-700">
                        <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                        Refund
                    </span>
                    @endif
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500 font-semibold">
                            User
                        </p>
                        <p class="text-sm md:text-base font-bold text-slate-800 mt-1">
                            {{ $order->user->name }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-indigo-50 border border-indigo-100 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-wider text-indigo-500 font-semibold">
                            Course
                        </p>
                        <p class="text-sm md:text-base font-bold text-indigo-700 mt-1 break-words">
                            {{ $order->course->title }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 border border-emerald-100 px-4 py-3 sm:col-span-2">
                        <p class="text-[11px] uppercase tracking-wider text-emerald-600 font-semibold">
                            Amount
                        </p>
                        <p class="text-base md:text-lg font-extrabold text-emerald-700 mt-1">
                            MMK {{ number_format($order->amount) }}
                        </p>
                    </div>
                </div>

                <div class="mt-5">
                    <a
                        href="{{ route('course.show_order', $order->id) }}"
                        class="inline-flex items-center justify-center w-full rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white px-4 py-3 font-semibold shadow-md shadow-indigo-200 hover:-translate-y-0.5 transition">
                        View Order
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="rounded-[24px] border border-slate-100 bg-white shadow-sm p-8 text-center">
            <div class="w-16 h-16 mx-auto rounded-3xl bg-slate-100 flex items-center justify-center text-3xl mb-4">
                🧾
            </div>
            <h3 class="text-lg font-bold text-slate-800">No orders found</h3>
            <p class="text-slate-500 mt-2 text-sm">
                There are no orders matching your current filters.
            </p>
        </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
<div class="mt-6 md:mt-8">
    {{ $orders->withQueryString()->links() }}
</div>

<script>
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }
</script>
@endsection