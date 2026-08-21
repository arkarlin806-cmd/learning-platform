@extends('layout.master')

@section('content')
<!-- Hero Section -->
<section class="hero-bg min-h-screen flex items-center relative pt-4 md:pt-24">

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 md:gap-16 items-center">

        <!-- Left -->
        <div data-aos="fade-right">

            <span class="px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-200 text-sm">
                #1 Modern Learning Platform
            </span>
            <h1
                class="text-5xl md:text-7xl font-bold text-white leading-tight mt-6">
                Learn New
                <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                    Skills
                </span>
                Anytime
            </h1>

            <p data-en="Build your future with modern online courses,
                expert instructors, certificates, quizzes,
                real projects and interactive learning experience."
                data-mm="ခေတ်မီ အွန်လိုင်းသင်တန်းများ၊ ကျွမ်းကျင်နည်းပြများ၊ သင်တန်းဆင်းလက်မှတ်များ၊ မေးခွန်းတိုဉာဏ်စမ်းများ၊ လက်တွေ့ပရောဂျက်များနှင့် အပြန်အလှန် လေ့လာနိုင်သော သင်ယူမှုအတွေ့အကြုံများဖြင့် သင့်အနာဂတ်ကို တည်ဆောက်လိုက်ပါ။" class="text-gray-300 text-lg mt-6 leading-relaxed">
                Build your future with modern online courses,
                expert instructors, certificates, quizzes,
                real projects and interactive learning experience.
            </p>

            <div class="flex flex-wrap gap-4 mt-10">

                <button

                    class="px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-2xl shadow-indigo-600/40 transition shine">
                    <a href="{{ route('courses.index') }}" data-en="Start Learning"
                        data-mm="စတင်လေ့လာရန်">Start Learning</a>
                </button>



            </div>

        </div>

        <!-- Right -->
        <div class="relative" data-aos="fade-left">

            <div class="glass rounded-[40px] p-6 floating">

                <img
                    src="{{ asset('uploads/group/photo_2026-08-02_08-03-02.jpg') }}"
                    class="rounded-[30px] w-full h-[500px] object-cover">

            </div>



        </div>

    </div>
</section>


<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">

            <span data-en="Popular Categories"
                data-mm="လူကြိုက်များသော အမျိုးစားများ" class="px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">

                🚀 Popular Categories

            </span>

            <h2 class=" text-2xl md:text-3xl font-black dark:text-white mt-5">

                Learn Skills
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-pink-500 ">
                    Without Limits
                </span>

            </h2>

            <p data-en="Choose your learning path and build real-world skills with expert instructors."
                data-mm="မိမိနှင့် ကိုက်ညီမည့် သင်ယူမှုလမ်းကြောင်းကို ရွေးချယ်ပြီး ကျွမ်းကျင်နည်းပြများနှင့်အတူ လက်တွေ့နယ်ပယ်သုံး ကျွမ်းကျင်မှုများကို တည်ဆောက်လိုက်ပါ။" class="max-w-2xl mx-auto text-gray-500 dark:text-white mt-5 text-lg">

                Choose your learning path and build real-world skills with expert instructors.

            </p>

        </div>

        <div class="swiper categorySwiper">
            <div class="swiper-wrapper">

                @if($categories)
                @foreach($categories as $category)

                @php

                $design = [

                'Backend Language'=>[
                'icon'=>'ri-sparkling-2-line',
                'color'=>'from-blue-500 to-cyan-500',
                'desc'=>'Laravel, PHP, Node.js, API Development'
                ],
                'Photography'=>[
                'icon'=>'ri-sparkling-2-line',
                'color'=>'from-blue-500 to-cyan-500',
                'desc'=>'Laravel, PHP, Node.js, API Development'
                ],

                'Frontend Language'=>[
                'icon'=>'ri-code-box-line',
                'color'=>'from-pink-500 to-rose-500',
                'desc'=>'HTML, CSS, JavaScript, React, Vue'
                ],
                'Graphic Design'=>[
                'icon'=>'ri-code-box-line',
                'color'=>'from-pink-500 to-rose-500',
                'desc'=>'HTML, CSS, JavaScript, React, Vue'
                ],

                'Language'=>[
                'icon'=>'ri-translate-2',
                'color'=>'from-green-500 to-emerald-500',
                'desc'=>'English, Japanese and more languages'
                ],
                'Cyber Security'=>[
                'icon'=>'ri-database-2-line',
                'color'=>'from-green-500 to-emerald-500',
                'desc'=>'English, Japanese and more languages'
                ],
                'Video Editing'=>[
                'icon'=>'ri-database-2-line',
                'color'=>'from-green-500 to-emerald-500',
                'desc'=>'English, Japanese and more languages'
                ],

                'Artificial Intelligence'=>[
                'icon'=>'ri-robot-2-line',
                'color'=>'from-violet-600 to-fuchsia-500',
                'desc'=>'Machine Learning, ChatGPT, Deep Learning'
                ],
                'Data Science'=>[
                'icon'=>'ri-robot-2-line',
                'color'=>'from-yellow-600 to-orange-500',
                'desc'=>'Machine Learning, ChatGPT, Deep Learning'
                ],

                'Web Development'=>[
                'icon'=>'ri-stack-line',
                'color'=>'from-orange-500 to-red-500',
                'desc'=>'Frontend + Backend Complete Roadmap'
                ],
                'UI/UX Design'=>[
                'icon'=>'ri-stack-line',
                'color'=>'from-orange-500 to-red-500',
                'desc'=>'Frontend + Backend Complete Roadmap'
                ],

                'Other'=>[
                'icon'=>'ri-apps-2-line',
                'color'=>'from-slate-500 to-gray-700',
                'desc'=>'Networking, Office, Design and more'
                ],
                'Business'=>[
                'icon'=>'ri-apps-2-line',
                'color'=>'from-slate-500 to-gray-700',
                'desc'=>'Networking, Office, Design and more'
                ]

                ];

                $item = $design[$category->category] ?? [

                'icon'=>'ri-book-open-line',
                'color'=>'from-indigo-500 to-purple-500',
                'desc'=>'Explore amazing learning experiences.'

                ];

                @endphp


                <div class="swiper-slide">

                    <a href="{{ route('category.courses', $category->category) }}">

                        <div
                            class="group relative overflow-hidden rounded-[32px] p-8 bg-white dark:bg-slate-200 border border-slate-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-4">

                            <div class="absolute -right-12 -top-12 w-36 h-36 rounded-full bg-gradient-to-br {{ $item['color'] }} opacity-15 group-hover:scale-125 duration-700"></div>

                            <div class="relative">

                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-r {{ $item['color'] }}
                                    flex items-center justify-center text-white text-4xl shadow-xl group-hover:rotate-12 group-hover:scale-110 duration-500">

                                    <i class="{{ $item['icon'] }}"></i>

                                </div>

                                <h3 class="mt-6 text-xl font-extrabold">

                                    {{ $category->category }}

                                </h3>

                                <p class="text-gray-500 mt-3 leading-7 h-14">

                                    {{ $item['desc'] }}

                                </p>

                                <div class="flex items-center justify-between mt-8">

                                    <span
                                        class="px-4 py-2 rounded-full bg-gray-100 font-semibold">

                                        {{ $category->total_courses }} <span data-en="Courses" data-mm="ဘာသာရပ်များ">Courses</span>

                                    </span>

                                    <div
                                        class="w-11 h-11 rounded-full bg-gradient-to-r {{ $item['color'] }}
                                            text-white flex items-center justify-center
                                            group-hover:translate-x-2 duration-300">

                                        <i class="ri-arrow-right-line"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

                @endforeach
                @else
                <div class="">Not Found</div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Popular Courses -->
<section class="py-6 ">
    <div class="max-w-7xl mx-auto px-6 ">
        <div class="text-center mb-12">
            <span class="px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                ⭐ Top Rated Courses
            </span>

            <h2 data-en="Students' Favorite Courses"
                data-mm="လူကြိုက်များဆုံး ဘာသာရပ်များ" class=" text-2xl md:text-3xl font-black mt-5 dark:text-white">
                Students' Favorite Courses
            </h2>

            <p data-en="Highest rated courses by our learners."
                data-mm="သင်ကြားသူများမှ အများဆုံး ကြိုက်နှစ်သက်သည်။" class="text-gray-500 mt-3 dark:text-white/70">
                Highest rated courses by our learners.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            @foreach($topCourses as $course)

            <a href="{{ route('course.show',$course->id) }}"
                class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 overflow-hidden">

                <div class="relative">

                    <img src="{{ $course->thumbnail_url }}"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-700">

                    <span class="absolute top-4 left-4 bg-yellow-400 text-white px-4 py-2 rounded-full font-bold flex items-center gap-1">
                        ⭐ {{ number_format($course->average_rating,1) }}
                    </span>

                </div>

                <div class="p-6">

                    <span class="text-sm text-indigo-600 font-semibold">
                        {{ $course->category }}
                    </span>

                    <h3 class="text-2xl font-bold mt-2 line-clamp-2">
                        {{ $course->title }}
                    </h3>

                    <p class="text-gray-500 mt-3 line-clamp-2">
                        {{ $course->short_description }}
                    </p>

                    <div class="flex justify-between items-center mt-6">

                        <div>
                            <div class="font-bold text-xl text-indigo-600">
                                {{ number_format($course->price,2) }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $course->total_ratings }} Reviews
                            </div>
                        </div>

                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center group-hover:rotate-12 transition">
                            <i class="ri-arrow-right-up-line text-xl"></i>
                        </div>

                    </div>

                </div>

            </a>

            @endforeach

        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-28">

    <div class="max-w-6xl mx-auto px-6">

        <div class="hero-bg rounded-[40px] p-12 lg:p-20 text-center relative overflow-hidden"
            data-aos="zoom-in">

            <div class="absolute w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl top-[-100px] left-[-100px]"></div>

            <div class="relative z-10">

                <h2 data-en="Start Your Learning Journey Today"
                    data-mm="သင်၏ သင်ယူမှုခရီးစဉ်ကို ယနေ့ပဲ စတင်လိုက်ပါ။" class="text-3xl md:text-4xl font-bold text-white leading-tight">
                    Start Your Learning Journey Today
                </h2>

                <p data-en="Join thousands of students and improve your skills with modern online education."
                    data-mm="ခေတ်မီ အွန်လိုင်းပညာရေးနှင့်အတူ ကျောင်းသားပေါင်း သောင်းနှင့်ချီတွင် ပူးပေါင်းပါဝင်ပြီး သင့်ကျွမ်းကျင်မှုများကို မြှင့်တင်လိုက်ပါ။" class="text-gray-300 text-lg mt-6 max-w-2xl mx-auto">
                    Join thousands of students and improve your skills with modern online education.
                </p>

                <button class="mt-10 px-10 py-4 rounded-2xl bg-white text-indigo-700 font-bold hover:scale-105 transition shadow-2xl">
                    <a href="{{ route('courses.index') }}" data-en="Get Started"
                        data-mm="စတင်ရန်">Get Started</a>
                </button>

            </div>

        </div>

    </div>

</section>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    new Swiper(".categorySwiper", {
        slidesPerView: 1.2,
        spaceBetween: 20,
        loop: true,
        speed: 600,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: ".category-next",
            prevEl: ".category-prev"
        },
        breakpoints: {
            640: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 4
            },
            1280: {
                slidesPerView: 4
            }
        }
    });
</script>

@endsection