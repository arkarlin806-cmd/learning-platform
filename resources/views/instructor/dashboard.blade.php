@extends('layout.ins')

@section('title','Dashboard')
@section('page','Instructor Dashboard and courses analysis.')
@section('content')

<style>
    .menu-link {
        display: block;
        padding: 16px;
        border-radius: 16px;
        transition: .3s;
    }

    .menu-link:hover {
        background: #eef2ff;
        transform: translateX(8px);
    }

    .card {
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        transition: .3s;
    }

    .card:hover {
        transform: translateY(-8px);
    }
</style>


<main class="px-6 content-animation">
    <!-- header -->
    <div
        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-8 lg:p-12 rounded-b-[40px]">
        <div class="flex flex-col lg:flex-row justify-between gap-5">
            <div>
                <h1
                    class="text-2xl lg:text-5xl font-bold text-white">
                    Welcome Back 👋
                </h1>
                <p
                    class="text-indigo-100 mt-3">
                    Manage your courses and earnings.
                </p>
            </div>
            <div
                class="bg-white/20 backdrop-blur-lg rounded-3xl p-6 text-white">
                <div>Total Earnings</div>
                <div
                    class="text-lg md:text-2xl font-bold mt-2 md:mb-2">
                    {{ number_format($totalEarned,2) }} MMK
                </div>
            </div>
        </div>
    </div>

    <!-- statics -->
    <div class="p-4 lg:p-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-5 -mt-12">

            <div class="card bg-white/80 px-6 py-4 rounded-2xl shadow-xl">
                <div class="flex justify-between">
                    <div class="">
                        <p class="text-slate-500 font-semibold text-sm">Students</p>
                        <h2 class="md:text-3xl text-lg font-bold text-indigo-700 my-1 md:my-2">
                            {{ number_format($studentCount) }}
                        </h2>
                    </div>
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-2xl"><svg class="md:h-6 md:w-6 h-4 w-4 text-white"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />

                            </svg>
                        </span>
                    </div>
                </div>
                <p class="text-slate-600 pt-2 text-xs">Total Students </p>
            </div>

            <div class="card bg-white/80 px-6 py-4 rounded-2xl shadow-xl">
                <div class="flex justify-between">
                    <div class="">
                        <p class="text-gray-500 font-semibold text-sm">Course</p>
                        <h2 class="md:text-3xl text-lg font-bold text-indigo-700 my-1 md:my-2">
                            {{ $courseCount }}
                        </h2>
                    </div>
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                        <span class="text-2xl">📚</span>
                    </div>
                </div>
                <p class="text-slate-600 pt-2 text-xs">Total Courses </p>
            </div>

            <div class="card bg-white/80 px-6 py-4 rounded-2xl shadow-xl">
                <div class="flex justify-between">
                    <div class="">
                        <p class="text-gray-500 font-semibold text-sm">Earning</p>
                        <h2 class="md:text-3xl text-lg font-bold text-indigo-700 my-1 md:my-2">
                            {{ number_format($totalEarned) }}
                        </h2>
                    </div>
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-green-500 to-green-700 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                        <span class="text-2xl">💰</span>
                    </div>
                </div>
                <p class="text-slate-600 pt-2 text-xs">Total Earning (MMK)</p>
            </div>

            <div class="card bg-white/80 px-6 py-4 rounded-2xl shadow-xl">
                <div class="flex justify-between">
                    <div class="">
                        <p class="text-gray-500 font-semibold text-sm">Ratings</p>
                        <h2 class="md:text-3xl text-lg font-bold text-indigo-700 my-1 md:my-2">
                            {{ $averageRating }} <span class="text-slate-600 text-sm">({{ $totalReviews }})</span>
                        </h2>
                    </div>
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-yellow-200 to-orange-200 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                        <span class="text-2xl text-slate-600"><i class="ri-star-half-fill"></i></span>
                    </div>
                </div>
                <p class="text-slate-600 pt-2 text-xs">Average Ratings </p>
            </div>

        </div>
    </div>

    <!-- Courses -->
    <section class="md:py-14 py-4">
        <div class="max-w-7xl mx-auto md:px-6">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-10">
                @foreach($courses as $course)

                <div data-course-card="{{ $course->id }}" class="card-animate relative overflow-hidden rounded-3xl bg-white/10 backdrop-blur-lg border border-gray-300 group transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_20px_60px_rgba(220,130,246,0.5)]">
                    <div class="glow bg-blue-500 top-0 right-0 group-hover:scale-150 transition duration-700"></div>
                    <div class="relative z-10">

                        <div class="relative">
                            <img
                                src="{{ asset('storage/' . $course->thumbnail) }}"
                                class="w-full h-50 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ $course->level }}
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
                            <a href="{{ route('instructor.single_course', $course->id) }}" class="px-5 py-1 border border-blue-300 rounded-xl bg-blue-100/50 text-blue-700 font-semibold transition duration-300 hover:bg-blue-100/30 hover:scale-105">
                                Details
                            </a>
                            <p class="mt-3">
                                <span class="text-gray-500 text-xs">Start date - </span> <i class="text-sm">{{ $course->start_date }}</i>
                            </p>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </section>

    </div>

</main>

@endsection