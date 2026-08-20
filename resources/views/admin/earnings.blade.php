@extends('layout.admin')
@section('page_title','Eanrings Analysis')
@section('page','Admin earnings analysis and instructor.')
@section('content')

<style>
    .chart-container {
        position: relative;
        width: 80%;
        max-width: 900px;
        min-height: 400px;
        margin: 60px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
</style>
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-4">
    <div>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
            <i class="ri-rocket-2-fill"></i>
            Earnings Analysis
        </span>
        <h1 class="mt-3 text-3xl font-black tracking-tight text-gray-900">
            Admin Eanrings Analysis
        </h1>
        <p class="mt-1 text-slate-500 text-sm">
            Admin earning analysis for admin and monitor every instructors earning.
        </p>
    </div>
</div>
<!-- TOP STATS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-2 my-3">

    <div class="relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Total Earnings
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $total }}
                </h2>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                <span class="text-2xl">💰</span>
            </div>

        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-purple-400 via-purple-600 to-purple-800">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                This Month Earnings
            </span>

            <span class="font-bold text-purple-700">
                {{ $currentMonthIncome }} MMK
            </span>

        </div>

    </div>
    <div class="relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Admin Earnings
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $totalAdmin }}
                </h2>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-500 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                <span class="text-2xl">👨‍🎓</span>
            </div>

        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-yellow-300 via-yellow-500 to-orange-800">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                This Month Earnings
            </span>

            <span class="font-bold text-orange-700">
                {{ $currentMonthAdminIncome }} MMK
            </span>

        </div>

    </div>
    <div class="relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Instructor Earnings
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $totalIns }}
                </h2>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                <span class="text-2xl">📈</span>
            </div>
        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-green-300 via-green-500 to-green-800">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                This Month Eanrings
            </span>

            <span class="font-bold text-green-700">
                {{ $currentMonthInstructorIncome }} MMK
            </span>

        </div>

    </div>

</div>

<div class="rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 p-6">

    <canvas id="earningChart" height="460"></canvas>

</div>
<div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-6 ">

    <canvas id="instructorChart"
        height="">
    </canvas>

</div>
<script>
    let chart;

    async function loadChart() {

        const res = await fetch("{{ route('admin.chart.earnings') }}");

        const json = await res.json();

        const ctx = document
            .getElementById('earningChart')
            .getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 450);

        gradient.addColorStop(0, "rgba(59,130,246,.45)");
        gradient.addColorStop(.5, "rgba(139,92,246,.18)");
        gradient.addColorStop(1, "rgba(255,255,255,0)");
        if (chart) {
            chart.destroy();
        }

        chart = new Chart(ctx, {

            type: 'line',

            data: {
                labels: json.labels,

                datasets: [{
                    label: 'Registered Users',
                    data: json.earnings,
                    borderColor: '#3b82f6',
                    backgroundColor: gradient,
                    borderWidth: 1,
                    tension: 0.1,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointHoverRadius: 7
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
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }

        });

    }

    loadChart();

    setInterval(loadChart, 60000);


    async function loadInstructorChart() {

        const response = await fetch(
            "{{ route('admin.instructor.chart') }}"
        );

        const data = await response.json();


        const labels = data.map(
            item => item.name
        );


        const total = data.map(
            item => item.total
        );


        const available = data.map(
            item => item.available
        );


        const withdraw = data.map(
            item => item.withdraw
        );


        new Chart(
            document.getElementById('instructorChart'), {

                type: 'bar',

                data: {

                    labels: labels,

                    datasets: [

                        {
                            label: 'Total Earnings',

                            data: total,

                            backgroundColor: '#3B82F6',

                            borderRadius: 12,

                        },


                        {
                            label: 'Available Balance',

                            data: available,

                            backgroundColor: '#10B981',

                            borderRadius: 12,

                        },


                        {
                            label: 'Withdraw Amount',

                            data: withdraw,

                            backgroundColor: '#F59E0B',

                            borderRadius: 12,

                        }

                    ]

                },


                options: {

                    responsive: true,

                    animation: {
                        duration: 1800,
                        easing: 'easeOutQuart'
                    },


                    plugins: {

                        legend: {
                            labels: {
                                color: '#fff'
                            }
                        },


                        tooltip: {

                            backgroundColor: 'rgba(15,23,42,.95)',

                            callbacks: {

                                label: (ctx) => {

                                    return ctx.dataset.label +
                                        ': ' +
                                        Number(ctx.raw)
                                        .toLocaleString();

                                }

                            }

                        }

                    },


                    scales: {

                        x: {

                            ticks: {
                                color: '#cbd5e1'
                            },

                            grid: {
                                display: false
                            }

                        },


                        y: {

                            ticks: {
                                color: '#cbd5e1',

                                callback: (value) =>
                                    value.toLocaleString()
                            }

                        }

                    }

                }

            });

    }


    loadInstructorChart();
</script>
@endsection