@extends('layout.admin')

@section('page_title','Dashboard')
@section('page','Admin analysis earnings and total counts.')
@section('content')


<!-- TOPBAR -->
<div class="animate-fade-in hidden md:flex bg-white/80 rounded-3xl shadow-lg shadow-blue-200 p-6 flex items-center justify-between">

    <div>
        <h1 class="gradient-shine text-2xl md:text-4xl font-extrabold">
            Admin Dashboard
        </h1>
        <p class="mt-2 text-slate-600">
            Admin analysis earnings, course and total user counts.
        </p>

    </div>

    <!-- Profile -->
    <div class="flex items-center gap-4">
        <div class="text-right">
            <h3 class="font-bold">
                ArKar Lin
            </h3>

            <p class="text-sm">
                Administrator
            </p>
        </div>

        <img
            src="{{ auth()->user()->avatar
                                            ? asset('images/avatars/' . auth()->user()->avatar)
                                            : asset('images/avatars/avatar1.png') }}"
            class="w-8 h-8 rounded-2xl shadow-lg object-cover" />

    </div>
</div>

<!-- TOP STATS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-1 md:my-6">

    <div class="stat-card opacity-0 animate-stat-in relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100" style="animation-delay:0ms">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Total Users
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $totaluser }}
                </h2>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                    bg-gradient-to-br from-cyan-500 via-sky-500 to-indigo-600
                    shadow-lg shadow-cyan-300">

                <svg class="h-6 w-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />

                </svg>

            </div>

        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                Active This Month
            </span>

            <span class="font-bold text-sky-700">
                {{ $monthuser }} Users
            </span>

        </div>

    </div>
    <div class="stat-card opacity-0 animate-stat-in relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100" style="animation-delay:200ms">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Total Instructors
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $totalInstructor }}
                </h2>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                    bg-gradient-to-r from-pink-400 via-pink-500 to-pink-800
                    shadow-lg shadow-cyan-300">

                <svg class="h-6 w-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />

                </svg>

            </div>

        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-pink-300 via-pink-500 to-pink-800">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                Active This Month
            </span>

            <span class="font-bold text-pink-700">
                {{ $monthInstructor }} Instructors
            </span>

        </div>

    </div>
    <div class="stat-card opacity-0 animate-stat-in relative overflow-hidden rounded-3xl border border-white/90
            bg-gradient-to-br from-white via-sky-50 to-indigo-100
            p-6 shadow-xl shadow-sky-100" style="animation-delay:300ms">
        <div class="relative flex items-center justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wider text-slate-500">
                    Total Courses
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-800">
                    {{ $totalCourse }}
                </h2>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                <span class="text-2xl">📚</span>
            </div>
        </div>

        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full
                    bg-gradient-to-r from-yellow-500 via-orange-500 to-amber-700">
            </div>

        </div>

        <div class="mt-3 flex justify-between text-sm">

            <span class="text-slate-500">
                Active This Month
            </span>

            <span class="font-bold text-orange-700">
                {{ $monthCourse }} Courses
            </span>

        </div>

    </div>

</div>

<div class="lg:flex lg:justify-between sm:grid sm:grid-cols-1">
    <div class="stat-card opacity-0 animate-stat-in rounded-3xl shadow-sm w-full" style="animation-delay:450ms">
        <div class="bg-white/80 rounded-t-3xl px-4 py-3 flex justify-between">
            <h5 class=" text-slate-700 text-xl font-bold py-3">
                All Users Analytics
            </h5>

            <div class="mr-6">
                <label for="timeFilter" class="text-blue-600 text-lg font-bold">View By:</label>
                <select id="timeFilter" class="border border-slate-700 ml-2 hover:bg-slate-50 font-semibold  rounded-lg px-8 py-2 px-4 py-2" onchange="updateChartType()">
                    <option value="days" class=" font-semibold" selected>15 days</option>
                    <option value="months" class=" font-semibold">Months</option>
                    <option value="years" class=" font-semibold">Years</option>
                </select>
            </div>
        </div>

        <div class="card-body p-4">
            <div style="position: relative; height: 400px; width: 100%;">
                <canvas id="adminUserChart" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="w-80 stat-card opacity-0 animate-stat-in" style="animation-delay:500ms">
        <h1 class="ml-10 font-bold text-2xl mt-10">Account Analytics</h1>
        <div class="relative w-40 h-40 mx-auto mt-16">
            <canvas id="userChart"></canvas>
            <!-- Center Text -->
            <div class="absolute inset-0 flex flex-col items-center justify-center">

                <h1 class="text-4xl font-bold text-gray-800">
                    {{ $totalAccounts }}
                </h1>

                <p class="text-gray-500">
                    Total Accounts
                </p>

            </div>

        </div>
        <div class="flex justify-center mt-10">
            <div class="h-2 w-10 bg-blue-500 mt-2 mr-3"></div><span>Users</span>
        </div>
        <div class="flex flex justify-center">
            <div class="h-2 w-10 bg-pink-500  mt-2 mr-3"></div><span>Instructors</span>
        </div>

    </div>
</div>




<!-- Courses -->
<section class="py-14">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($courses as $course)

            <div data-course-card="{{ $course->id }}" class="card-animate relative overflow-hidden rounded-3xl bg-white/10 backdrop-blur-lg border border-gray-300 group transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_20px_60px_rgba(220,130,246,0.5)]">
                <div class="glow bg-blue-500 top-0 right-0 group-hover:scale-150 transition duration-700"></div>
                <div class="relative z-10">

                    <div class="relative">
                        <img
                            src="{{ $course->thumbnail_url }}"
                            class="w-full h-50 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                                @if($course->price < 1)
                                    <span>Free</span>
                            @else
                            {{ $course->level }}
                            @endif
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between px-6 pt-4">
                        <h2 class="text-sm font-bold text-gray-700 mb-4">
                            {{ $course->title }}
                        </h2>

                        @php

                        $userRating = $course->ratings->first();

                        @endphp

                        <div class="course-rating" data-course-id="{{ $course->id }}" data-my-rating="{{ $userRating->rating ?? 0 }}">
                            <div class="flex items-center gap-2">
                                <div class="flex rating-stars text-yellow-600">
                                    @for($i=1;$i<=5;$i++)

                                        <button type="button"
                                        class="rating-star 
                                                {{ 
                                                ($userRating && $i <= $userRating->rating)
                                                ? 'star-active'
                                                : ''
                                                }}"
                                        data-rating="{{ $i }}">
                                        <svg class="star-icon w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921
                                                    1.603-.921 1.902 0l1.07
                                                    3.292a1 1 0 00.95.69h3.462
                                                    c.969 0 1.371 1.24.588
                                                    1.81l-2.8 2.034a1 1
                                                    0 00-.364 1.118l1.07
                                                    3.292c.3.921-.755 1.688
                                                    -1.54 1.118l-2.8-2.034a1
                                                    1 0 00-1.176 0l-2.8
                                                    2.034c-.784.57-1.838
                                                    -.197-1.539-1.118l1.07
                                                    -3.292a1 1 0 00-.364
                                                    -1.118L2.98 8.72c-.783
                                                    -.57-.38-1.81.588-1.81h3.461
                                                    a1 1 0 00.951-.69l1.069-3.292z" />

                                        </svg>

                                        </button>
                                        @endfor
                                </div>

                                <span class="average-rating font-bold">

                                    {{ number_format($course->ratings_avg_rating ?? 0,1) }}

                                </span>

                            </div>

                            <button
                                class="remove-rating hidden  text-red-500 text-sm mt-2">
                                <!-- $userRating ? '' : 'hidden'  -->
                                Remove Rating
                            </button>
                        </div>

                    </div>

                    <div class="flex justify-between px-6 mb-6">
                        <a href="{{ route('admin.course.show', $course->id) }}" class="px-5 py-2 border border-blue-300 rounded-xl bg-blue-100/50 text-blue-700 font-semibold transition duration-300 hover:bg-blue-100/30 hover:scale-105">
                            Detail
                        </a>
                        <p class="mt-5">
                            <span class="text-gray-500 text-xs">Start date - </span> <i class="text-sm">{{ $course->start_date }}</i>
                        </p>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

</section>
<div class="p-6">

    {{ $courses->links() }}

</div>
<script>
    let myChart = null;
    let ctx = null;


    window.onload = function() {
        ctx = document.getElementById('adminUserChart').getContext('2d');
        fetchRealChartData('days');
    };


    function updateChartType() {
        const filterValue = document.getElementById('timeFilter').value;
        fetchRealChartData(filterValue);
    }


    function fetchRealChartData(filterType) {

        const apiUrl = `{{ route('admin.user.chart.data') }}?filter=${filterType}`;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Database data fetch failed');
                }
                return response.json();
            })
            .then(resData => {

                const chartType = (filterType === 'days') ? 'line' : 'bar';


                if (myChart !== null) {
                    myChart.destroy();
                }


                myChart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: resData.labels,
                        datasets: [{
                            label: 'Registered Users',
                            data: resData.data,
                            borderColor: '#3b82f6',
                            backgroundColor: chartType === 'line' ? 'rgba(59, 130, 246, 0.1)' : '#3b82f6',
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
            })
            .catch(error => {
                console.error('Error fetching real chart data:', error);
            });
    }

    const ctx_circle = document.getElementById('userChart');


    new Chart(ctx_circle, {
        type: 'doughnut',
        data: {
            labels: [
                'Users',
                'Instructors'
            ],
            datasets: [{
                data: [
                    '{{ $totaluser}}',
                    '{{ $totalInstructor }}'
                ],
                backgroundColor: [
                    '#1a1aff',
                    '#cc0099'
                ],
                borderWidth: 0,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>


@endsection