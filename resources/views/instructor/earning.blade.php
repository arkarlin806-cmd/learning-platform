@extends('layout.ins')
@section('title','Earning')
@section('page','Instructor Earnings Analysis.')
@section('content')

<div class=" pt-6 space-y-8 pb-12">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        <!-- Total Earnings -->
        <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(79,70,229,0.12)] transition duration-300">
            <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Total Earnings</p>
                        <h2 class="mt-3 text-xl md:text-2xl font-extrabold tracking-tight text-slate-800">
                            {{ number_format($totalEarnings) }} <span class="text-lg">MMK</span>
                        </h2>
                        <p class="mt-2 text-xs text-slate-500">All-time instructor revenue</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-2xl">💰</span>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-bold border border-emerald-100">
                        ▲ Revenue
                    </span>
                    <span class="text-xs text-slate-400">Instructor earnings</span>
                </div>
            </div>
        </div>

        <!-- Monthly Earnings -->
        <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(16,185,129,0.12)] transition duration-300">
            <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">This Month</p>
                        <h2 class="mt-3 text-xl md:text-2xl font-extrabold tracking-tight text-emerald-600">
                            {{ number_format($monthlyEarnings) }} <span class="text-lg">MMK</span>
                        </h2>
                        <p class="mt-2 text-xs text-slate-500">Current month performance</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                        <span class="text-2xl">📈</span>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-bold border border-emerald-100">
                        Live
                    </span>
                    <span class="text-xs text-slate-400">Updated from paid orders</span>
                </div>
            </div>
        </div>

        <!-- Students -->
        <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300">
            <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Students</p>
                        <h2 class="mt-3 text-xl md:text-2xl font-extrabold tracking-tight text-slate-800">
                            {{ $totalStudents }}
                        </h2>
                        <p class="mt-2 text-xs text-slate-500">Total enrolled learners</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-500 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                        <span class="text-2xl">👨‍🎓</span>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-sky-50 text-sky-700 px-3 py-1 text-xs font-bold border border-sky-100">
                        Active
                    </span>
                    <span class="text-xs text-slate-400">Across your courses</span>
                </div>
            </div>
        </div>

        <!-- Courses -->
        <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(249,115,22,0.12)] transition duration-300">
            <div class="absolute top-0 right-0 w-28 h-28 bg-orange-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Courses</p>
                        <h2 class="mt-3 text-xl md:text-2xl font-extrabold tracking-tight text-slate-800">
                            {{ $totalCourses }}
                        </h2>
                        <p class="mt-2 text-xs text-slate-500">Published teaching products</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                        <span class="text-2xl">📚</span>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-orange-50 text-orange-700 px-3 py-1 text-xs font-bold border border-orange-100">
                        Catalog
                    </span>
                    <span class="text-xs text-slate-400">Instructor content count</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Earnings Chart -->
        <div class="rounded-[30px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] overflow-hidden">
            <div class="p-5 md:p-7 border-b border-slate-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-slate-800">
                            Earnings Analytics
                        </h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Revenue performance across recent dates
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-2 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100 px-3 py-1.5 text-xs font-semibold">
                            Revenue Trend
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 px-3 py-1.5 text-xs font-semibold">
                            Live Data
                        </span>
                    </div>
                    <select id="chartFilter"
                        class="border rounded-xl px-4 py-2">
                        <option value="day">Last 7 Days</option>
                        <option value="month">Last 12 Months</option>
                        <option value="year">Last 5 Years</option>
                    </select>

                </div>
            </div>

            <div class="p-4 md:p-6">
                <div class="rounded-[24px] bg-gradient-to-br from-slate-50 via-white to-indigo-50/40 border border-slate-100 p-4 md:p-6">
                    <div class="h-[300px] md:h-[380px]">
                        <canvas id="earningChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="flex gap-6 justify-between">
        <div class="rounded-[30px] w-full border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] overflow-hidden">
            <div class="p-5 md:p-7 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-800">
                        Recent Sales
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Latest course purchases and instructor revenue entries
                    </p>
                </div>

                <div class="inline-flex items-center gap-2 rounded-2xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 w-fit">
                    <span>🧾</span>
                    {{ $recentOrders->count() }} sales on this page
                </div>
            </div>
            <!-- Desktop Table -->
            <div class="hidden xl:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50/90">
                        <tr class="text-left">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Student</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Course</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr class="border-t border-slate-100 hover:bg-indigo-50/30 transition duration-200">
                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-800">
                                    {{ $order->user->name }}
                                </div>
                                <div class="text-sm text-slate-500 mt-1">
                                    Student account
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
                                <span class="inline-flex items-center rounded-2xl bg-emerald-50 border border-emerald-100 px-3 py-2 text-sm font-bold text-emerald-700">
                                    ${{ number_format($order->instructor_amount, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <div class="font-medium text-slate-700">
                                    {{ $order->created_at->format('d M Y') }}
                                </div>
                                <div class="text-sm text-slate-500 mt-1">
                                    {{ $order->created_at->format('h:i A') }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-14 text-center">
                                <div class="max-w-md mx-auto">
                                    <div class="w-20 h-20 mx-auto rounded-3xl bg-slate-100 flex items-center justify-center text-4xl mb-4">
                                        📊
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-800">No recent sales found</h3>
                                    <p class="text-slate-500 mt-2">
                                        Recent paid orders will appear here once students purchase your courses.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="xl:hidden p-4 md:p-5 space-y-4">
                @forelse($recentOrders as $order)
                <div class="group rounded-[26px] border border-slate-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">
                    <div class="h-1.5 bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-500"></div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                    Student
                                </p>
                                <h3 class="text-lg font-bold text-slate-800 mt-1 break-words">
                                    {{ $order->user->name }}
                                </h3>
                            </div>

                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                Paid
                            </span>
                        </div>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-indigo-50 border border-indigo-100 px-4 py-3 sm:col-span-2">
                                <p class="text-[11px] uppercase tracking-wider text-indigo-500 font-semibold">
                                    Course
                                </p>
                                <p class="text-sm md:text-base font-bold text-indigo-700 mt-1 break-words">
                                    {{ $order->course->title }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 border border-emerald-100 px-4 py-3">
                                <p class="text-[11px] uppercase tracking-wider text-emerald-600 font-semibold">
                                    Amount
                                </p>
                                <p class="text-base md:text-lg font-extrabold text-emerald-700 mt-1">
                                    ${{ number_format($order->instructor_amount, 2) }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                                <p class="text-[11px] uppercase tracking-wider text-slate-500 font-semibold">
                                    Date
                                </p>
                                <p class="text-sm font-bold text-slate-800 mt-1">
                                    {{ $order->created_at->format('d M Y') }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $order->created_at->format('h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="rounded-[24px] border border-slate-100 bg-white shadow-sm p-8 text-center">
                    <div class="w-16 h-16 mx-auto rounded-3xl bg-slate-100 flex items-center justify-center text-3xl mb-4">
                        📊
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">No recent sales found</h3>
                    <p class="text-slate-500 mt-2 text-sm">
                        Recent paid orders will appear here once students purchase your courses.
                    </p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="p-4 md:p-6 border-t border-slate-100">
                {{ $recentOrders->links() }}
            </div>
        </div>
        <div class="bg-white p-5 h-80 rounded-2xl shadow-sm border border-slate-100">
            <div class="mb-3">
                <h4 class="text-sm font-bold text-slate-700">📊 All course earnings analysis</h4>
                <p class="text-[10px] text-slate-400">Each course eanings</p>
            </div>

            <div class="relative w-full h-56">
                <canvas id="instructorEarningChart"
                    data-titles="{{ json_encode($chartTitles ?? []) }}"
                    data-earnings="{{ json_encode($chartEarnings ?? []) }}">
                </canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->

<script>
    let earningChart = null;
    loadChart('day');
    document
        .getElementById('chartFilter')
        .addEventListener('change', function() {

            loadChart(this.value);

        });

    function loadChart(type) {
        fetch(`{{ route('instructor.earnings.chart',':type') }}`.replace(':type', type))

            .then(response => response.json())

            .then(data => {

                const canvas = document.getElementById('earningChart');

                const ctx = canvas.getContext('2d');

                if (earningChart) {
                    earningChart.destroy();
                }

                const gradient = ctx.createLinearGradient(0, 0, 0, 380);

                gradient.addColorStop(0, 'rgba(99,102,241,.28)');
                gradient.addColorStop(.5, 'rgba(59,130,246,.14)');
                gradient.addColorStop(1, 'rgba(255,255,255,0)');

                earningChart = new Chart(ctx, {

                    type: 'line',

                    data: {

                        labels: data.labels,

                        datasets: [{

                            label: 'Earnings',

                            data: data.data,

                            borderColor: '#4F46E5',

                            backgroundColor: gradient,

                            fill: true,

                            borderWidth: 2,

                            tension: .4,

                            pointRadius: 1,

                            pointHoverRadius: 3,

                            pointBackgroundColor: '#fff',

                            pointBorderColor: '#4F46E5',

                            pointBorderWidth: 2

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        interaction: {
                            mode: 'index',
                            intersect: false
                        },

                        plugins: {

                            legend: {
                                display: false
                            },

                            tooltip: {

                                backgroundColor: '#111827',

                                padding: 12,

                                cornerRadius: 12,

                                displayColors: false,

                                callbacks: {

                                    label: function(context) {

                                        return '$' + Number(context.raw).toLocaleString();

                                    }

                                }

                            }

                        },

                        scales: {

                            x: {

                                grid: {
                                    display: false
                                },

                                border: {
                                    display: false
                                }

                            },

                            y: {

                                beginAtZero: true,

                                grid: {
                                    color: 'rgba(148,163,184,.15)'
                                },

                                border: {
                                    display: false
                                },

                                ticks: {

                                    callback: function(value) {

                                        return '$' + value;

                                    }

                                }

                            }

                        }

                    }

                });

            });

    }


    document.addEventListener("DOMContentLoaded", function() {
        const chartCanvas = document.getElementById('instructorEarningChart');
        if (!chartCanvas) return;


        let courseTitles = [];
        let courseEarnings = [];

        try {
            const rawTitles = chartCanvas.getAttribute('data-titles');
            const rawEarnings = chartCanvas.getAttribute('data-earnings');

            courseTitles = JSON.parse(rawTitles) || [];
            courseEarnings = JSON.parse(rawEarnings) || [];


            if (typeof courseTitles === 'string') courseTitles = JSON.parse(courseTitles);
            if (typeof courseEarnings === 'string') courseEarnings = JSON.parse(courseEarnings);
        } catch (e) {
            console.error("Data parsing error:", e);
        }

        const ctx = chartCanvas.getContext('2d');


        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: courseTitles,
                datasets: [{
                    label: 'ဝင်ငွေ (MMK)',
                    data: courseEarnings,
                    backgroundColor: 'rgba(79, 70, 229, 0.25)',
                    borderColor: 'rgb(79, 70, 229)',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(241, 245, 249, 1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' MMK';
                            },
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection