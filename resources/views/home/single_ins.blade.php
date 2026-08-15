@extends('layout.master')

@section('title')

{{ $instructor->name }} - Instructor

@endsection


@section('content')


<!-- Hero Cover -->
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="relative overflow-hidden rounded-[40px] p-8 md:p-12 bg-blue-700 shadow-2xl">
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
            {{-- Profile Image --}}

            <div class="relative group">
                @if($instructor->profile_photo)
                <img
                    src="{{asset('storage/'.$instructor->profile_photo)}}"
                    class="w-40 h-40 md:w-48 md:h-48 rounded-full object-cover border-8 border-white/80 shadow-2xl group-hover:scale-110
                            transition duration-500">
                @else
                <div class="w-40 h-40 md:w-48 md:h-48 rounded-full bg-white/20 backdrop-blur-xl text-white flex items-center
                            justify-center text-6xl font-black border-8 border-white/80 shadow-2xl">
                    {{strtoupper(substr($instructor->name,0,1))}}
                </div>
                @endif
                <!-- Verified Badge -->

                <div class="absolute bottom-3 right-3 bg-green-500 text-white w-12 h-12 rounded-full flex items-center justify-center
                            border-4 border-white shadow-lg animate-bounce">
                    <i class="ri-check-line text-2xl"></i>
                </div>
            </div>

            {{-- Information --}}
            <div class="text-center md:text-left text-white">
                <div class="inline-flex items-center  gap-2 bg-white/20 backdrop-blur-md px-5 py-2 rounded-full mb-4">
                    <i class="ri-graduation-cap-line"></i>
                    <span class="font-semibold">
                        Professional Instructor
                    </span>
                </div>
                <h1 class=" text-4xl md:text-6xl font-black tracking-tight">
                    {{$instructor->name}}
                </h1>

                <p class="mt-3 text-white/80 text-lg flex items-center justify-center md:justify-start gap-2">
                    <i class="ri-mail-line"></i>
                    {{$instructor->email}}
                </p>
                <div class="mt-5 grid sm:grid-cols-2 gap-4">
                    <div class="bg-white/20 backdrop-blur-lg rounded-2xl px-5 py-3">
                        <p class="text-white/70 text-sm">
                            Profession
                        </p>
                        <p class="font-bold text-lg">
                            {{$ins_info->profession ?? 'Instructor'}}
                        </p>
                    </div>

                    <div class="bg-white/20 backdrop-blur-lg rounded-2xl px-5 py-3">
                        <p class="text-white/70 text-sm">
                            Experience
                        </p>
                        <p class="font-bold text-lg">
                            {{$ins_info->experience ?? 'N/A'}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards  -->
    <div class="grid md:grid-cols-3 gap-6 mt-10">
        {{-- Total Courses --}}
        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40 dark:bg-white/90
           bg-white/70 backdrop-blur-2xl
           shadow-lg hover:shadow-indigo-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-indigo-500 via-violet-500 to-cyan-500"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-indigo-500 animate-pulse"></span>
                            Students
                        </span>
                        <h2 class="mt-3 text-3xl font-black bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                            {{ $totalStudents }}
                        </h2>

                        <p class="mt-2 text-xs text-slate-600">
                            Total Students
                        </p>
                    </div>

                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 via-violet-500 to-purple-600 text-white
                       flex items-center justify-center shadow-lg group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                        <i class="ri-team-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40 dark:bg-white/90
           bg-white/70 backdrop-blur-2xl
           shadow-lg hover:shadow-pink-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-pink-500 via-pink-500 to-red-600"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-50 text-pink-600 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-pink-500 animate-pulse"></span>
                            Courses
                        </span>
                        <h2 class="mt-3 text-3xl font-black bg-gradient-to-r from-pink-500 via-pink-500 to-red-600 bg-clip-text text-transparent">
                            {{ number_format($totalCourses) }}
                        </h2>

                        <p class="mt-2 text-xs text-slate-600">
                            Total Courses
                        </p>
                    </div>

                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 via-pink-500 to-red-600 text-white
                       flex items-center justify-center shadow-lg group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                        <i class="ri-book-3-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="group relative overflow-hidden rounded-[30px]
           border border-white/40 dark:bg-white/90
           bg-white/70 backdrop-blur-2xl
           shadow-lg hover:shadow-orange-400/30
           transition-all duration-500
           hover:-translate-y-1">

            <!-- Top Gradient Bar -->
            <div class="h-1 w-full bg-gradient-to-r from-yellow-500 via-yellow-600 to-orange-500"></div>
            <div class="relative px-6 py-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-orange-600 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full uppercas bg-orange-500 animate-pulse"></span>
                            Ratings
                        </span>
                        <h2 class="mt-3 text-3xl font-black bg-gradient-to-r from-yellow-600 via-orange-600 to-orange-700 bg-clip-text text-transparent">
                            {{ number_format($averageRating ?? 0,1) }}
                        </h2>

                        <p class="mt-2 text-xs text-slate-600">
                            Total Average Ratings
                        </p>
                    </div>

                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-600 via-yellow-600 to-orange-500 text-white
                       flex items-center justify-center shadow-lg group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                        <i class="ri-star-s-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <!-- Instructor Courses  -->
    <section class="mt-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">
                    Courses By <span class="text-blue-700">{{ $instructor->name }}</span>
                </h2>
                <p class="text-gray-500 dark:text-white/70 mt-2">
                    Explore all courses created by this instructor.
                </p>
            </div>
        </div>
        <!-- Courses -->
        <section class="py-4">
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
                                        {{ $course->level }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between px-6 pt-4">
                                <h2 class="text-xl font-bold text-gray-700 dark:text-white mb-4">
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

                                        <span class="average-rating font-bold dark:text-white">

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
                                <a href="{{ route('course.show', $course->id) }}" class="px-5 py-2 border border-blue-300 rounded-xl dark:bg-white bg-blue-100/50 text-blue-700 font-semibold transition duration-300 hover:bg-blue-100/30 hover:scale-105">
                                    Learn More
                                </a>
                                <p class="mt-5">
                                    <span class="text-gray-500 dark:text-white text-xs">Start date - </span> <i class="text-sm dark:text-white">{{ $course->start_date }}</i>
                                </p>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </section>

    </section>

    <section class="py-14">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-black text-gray-800 dark:text-white">
                    Student Reviews
                </h2>
                <p class="text-gray-500 mt-3 dark:text-white">
                    What learners say about this instructor
                </p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Rating Summary -->
                <div class=" bg-gradient-to-br from-blue-600 to-purple-600 rounded-[35px] p-8 text-white shadow-2xl">
                    <h3 class="text-6xl font-black counter">
                        {{number_format($averageRating ?? 0,1)}}
                    </h3>
                    <div class="text-yellow-300 text-3xl mt-3">
                        ★★★★★
                    </div>
                    <p class="mt-5 text-white/80">
                        Average Rating
                    </p>
                </div>
                <!-- Rating Progress -->
                <div class=" lg:col-span-2 bg-white rounded-[35px] shadow-xl p-8">
                    @foreach([
                    20=>100,
                    15=>75,
                    10=>50,
                    5=>25,
                    1=>5
                    ] as $star=>$percent)
                    <div class="flex items-center gap-4 mb-5">
                        <span class="font-bold w-10">
                            {{$star}}★
                        </span>
                        <div class=" flex-1 bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="h-full bg-yellow-400 rounded-full transition-all duration-1000" style="width:'{{$percent}}%'">
                            </div>
                        </div>
                        <span>
                            {{$percent}}%
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="pb-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-6">


                @foreach($topRatedStudents as $review)


                <div class="
                        bg-white
                        rounded-3xl
                        p-6
                        shadow-xl
                        hover:-translate-y-3
                        transition
                        duration-500
                        ">


                    <div class="flex items-center gap-4">


                        @if($review->user->profile_photo)

                        <img
                            src="{{asset('storage/'.$review->user->profile_photo)}}"
                            class="
                                w-14
                                h-14
                                rounded-full
                                object-cover
                                ">


                        @else

                        <div class="
                                w-14
                                h-14
                                rounded-full
                                bg-blue-600
                                text-white
                                flex
                                items-center
                                justify-center
                                font-bold
                                ">

                            {{substr($review->user->name,0,1)}}

                        </div>

                        @endif



                        <div>

                            <h3 class="font-bold text-gray-800">

                                {{$review->user->name}}

                            </h3>


                            <div class="text-yellow-400">

                                {{str_repeat('★',$review->rating)}}

                            </div>
                            <div class="text-slate-400">

                                Created_at : {{$review->created_at}}

                            </div>


                        </div>


                    </div>



                    <p class="
                            mt-5
                            text-gray-500
                            ">

                        Top rated learner

                    </p>


                </div>


                @endforeach


            </div>
        </div>
    </section>


</div>





@endsection