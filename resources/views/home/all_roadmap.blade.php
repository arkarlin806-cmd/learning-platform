@extends('layout.user')

@section('title','Roadmaps')
@section('page','Learner Create and Show Roadmap')

@section('content')


<style>
    html {

        scroll-behavior: smooth;

    }

    .filter-btn {

        transition: .35s;

    }

    .filter-btn:hover {

        transform: translateY(-3px);

    }

    .roadmap-card {

        transition: all .5s;

    }

    .progress-bar {

        transition: width 1.4s ease;

    }

    .counter {

        transition: all .5s;

    }

    .phase-segment {

        animation:
            circleGrow 1.5s ease forwards;

        transform-origin: center;

    }


    @keyframes circleGrow {

        from {

            stroke-dashoffset: 251;

        }

        to {

            stroke-dashoffset: 0;

        }

    }
</style>

<div class="relative max-w-7xl mx-auto">

    <!-- Hero -->
    <div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-indigo-600 via-violet-600 to-cyan-500 p-8 lg:p-12 shadow-lg">
        <!-- Floating circle -->
        <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-white/10 blur-2xl">
        </div>

        <div class="absolute left-1/3 bottom-0 w-56 h-56 rounded-full bg-white/10 blur-2xl">
        </div>

        <div class="relative z-10">
            <span class="inline-flex items-center rounded-full bg-white/20 backdrop-blur-xl px-4 py-2 text-sm text-white">
                🚀 AI Personalized Learning
            </span>
            <h1 class="mt-6 text-4xl md:text-6xl font-black text-white leading-tight">
                My Learning
                <span class="block">
                    Roadmaps
                </span>

            </h1>
            <p class="mt-5  text-white/80 max-w-2xl text-lg">
                Continue your personalized learning journey,
                track your roadmap progress,
                and achieve your dream career.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('learning.roadmap.create') }}" class="rounded-full bg-white px-7 py-3 font-bold text-indigo-700 transition duration-300 hover:scale-105">
                    Create Roadmap
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
        <!-- Card -->
        <div class="group rounded-3xl bg-white/50 backdrop-blur-xl p-6 shadow-lg transition duration-500 hover:-translate-y-2">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">
                        Active Goals
                    </p>
                    <h2 data-counter="{{ $goals->where('status','active')->count() }}" class="counter mt-3 text-2xl font-bold text-indigo-600">
                        0
                    </h2>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">
                    🎯
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="group rounded-3xl bg-white/50 backdrop-blur-xl p-6 shadow-lg transition duration-500 hover:-translate-y-2">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">
                        Total Goals
                    </p>
                    <h2 data-counter="{{ $goals->count() }}" class="counter mt-3 text-2xl font-bold text-purple-600">
                        0
                    </h2>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center text-2xl">
                    📚
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="group rounded-3xl bg-white/50 backdrop-blur-xl p-6 shadow-lg transition duration-500 hover:-translate-y-2">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">
                        Estimated Days
                    </p>
                    <h2 data-counter="{{ $goals->sum('estimated_days') }}" class="counter mt-3 text-2xl font-bold text-orange-600">
                        0
                    </h2>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center text-2xl">
                    ⏳
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="group rounded-3xl bg-white/50 backdrop-blur-xl p-6 shadow-lg transition duration-500 hover:-translate-y-2">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">
                        Study Hours
                    </p>
                    <h2 data-counter="{{ $goals->sum('daily_hours') }}" class="counter mt-3 text-2xl font-bold text-pink-600">
                        0
                    </h2>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-2xl">
                    🔥
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-8">
        <div class="flex items-center rounded-3xl bg-white shadow-lg px-6 py-4">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.2-5.2M10 18a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <input id="roadmapSearch" type="text" placeholder="Search your roadmap..."
                class="w-full bg-transparent px-4 outline-none text-lg">
        </div>
    </div>

    <!-- Roadmap Cards -->
    <div id="roadmaps" class="mt-10">
        @if($goals->count())

        <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8">

            @foreach($goals as $goal)

            @php

            $progress = rand(15,95);

            @endphp

            <div class="roadmap-card group relative overflow-hidden rounded-[34px]
                        bg-white/80 backdrop-blur-xl border border-white/50
                        shadow-xl hover:shadow-[0_30px_80px_rgba(79,70,229,.18)]
                        transition-all duration-700 hover:-translate-y-3">

                <!-- Gradient Border -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-700">
                    <div class="absolute inset-0 rounded-[34px] bg-gradient-to-r from-indigo-500 via-cyan-400 to-violet-500 p-[1px]">
                        <div class="w-full h-full rounded-[33px] bg-white"></div>
                    </div>
                </div>
                <div class="relative z-10 p-7">

                    <!-- Header -->
                    <div class="flex justify-between items-start">
                        <div>
                            <span
                                class="inline-flex items-center rounded-full bg-indigo-100 text-indigo-700 px-3 py-1 text-xs font-bold">
                                🚀 {{ $goal->target_role }}
                            </span>
                            <h2 class="mt-4 text-2xl font-black text-slate-800">
                                {{ $goal->goal_name }}
                            </h2>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="ri-road-map-fill"></i>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="mt-5 text-slate-500 line-clamp-2">
                        {{ optional($goal->roadmap)->description ?? 'AI personalized learning roadmap.' }}
                    </p>

                    <!-- Progress Ring -->
                    <!-- <div class="mt-8 flex items-center justify-between">
                        <div class="relative w-24 h-24">
                            <svg class="w-24 h-24 -rotate-90">
                                <circle
                                    cx="48"
                                    cy="48"
                                    r="40"
                                    stroke="#e5e7eb"
                                    stroke-width="8"
                                    fill="none" />

                                <circle
                                    class="progress-ring"
                                    cx="48"
                                    cy="48"
                                    r="40"
                                    stroke="url(#gradient)"
                                    stroke-width="8"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-dasharray="251"
                                    stroke-dashoffset="{{ 251 - ($progress*251/100) }}" />

                                <defs>
                                    <linearGradient id="gradient">
                                        <stop offset="0%" stop-color="#6366F1" />
                                        <stop offset="100%" stop-color="#06B6D4" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="font-black text-lg">
                                    {{ $progress }}%
                                </span>
                            </div>
                        </div>
                        <div class="space-y-3 text-right">
                            <div>
                                <p class="text-sm text-gray-400">
                                    Daily Hours
                                </p>
                                <h4 class="font-bold">
                                    {{ $goal->daily_hours }}
                                </h4>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">
                                    Lessons / Day
                                </p>
                                <h4 class="font-bold">
                                    {{ $goal->daily_lessons }}
                                </h4>
                            </div>
                        </div>
                    </div> -->



                    <!-- Phase Estimate Day Circle -->

                    @php

                    $roadmap = $goal->roadmap;

                    $totalDays = $roadmap
                    ? $roadmap->phases->sum('estimated_days')
                    : 0;


                    $colors = [
                    '#6366f1',
                    '#06b6d4',
                    '#22c55e',
                    '#f97316',
                    '#ec4899',
                    '#6366f1',
                    '#06b6d4',
                    '#22c55e',
                    '#f97316',
                    '#ec4899'
                    ];


                    $circumference = 251;

                    $offset = 0;

                    @endphp
                    @if($roadmap && $roadmap->phases->count())
                    <div class="mt-8 flex items-center gap-6">
                        <!-- Circle Chart -->
                        <div class="relative w-28 h-28">
                            <svg class="w-28 h-28 -rotate-90">

                                @foreach($roadmap->phases as $index=>$phase)
                                @php
                                $percent =($phase->estimated_days / $totalDays) * 100;
                                $dash =($percent/100) * $circumference;
                                @endphp

                                <circle
                                    cx="56"
                                    cy="56"
                                    r="40"
                                    fill="none"
                                    stroke="{{ $colors[$index % count($colors)] }}"
                                    stroke-width="10"
                                    stroke-linecap="round"
                                    stroke-dasharray="
                                        {{ $dash }}
                                        {{ $circumference-$dash }}
                                        "
                                    stroke-dashoffset="
                                        -{{ $offset }}
                                        "
                                    class="phase-circle transition-all duration-1000" />
                                @php
                                $offset += $dash;
                                @endphp
                                @endforeach


                            </svg>



                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-xl font-black">
                                    {{ $totalDays }}
                                </span>
                                <span class="text-[10px] text-gray-500">
                                    Days
                                </span>
                            </div>


                        </div>

                        <!-- Phase Legend -->
                        <div class="space-y-2">
                            @foreach($roadmap->phases as $index=>$phase)
                            <div class="flex items-center gap-2">


                                <span class="w-3 h-3 rounded-full"
                                    style="background:'{{ $colors[$index % count($colors)] }}'">
                                </span>
                                <p class="text-xs font-semibold">
                                    Phase {{ $phase->phase_no }}
                                    <span class="text-gray-400">
                                        {{ $phase->estimated_days }} Days
                                    </span>
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Info -->
                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div class="rounded-2xl bg-slate-100 p-4 text-center">
                            <div class="text-xl">
                                <i class="ri-hourglass-fill text-2xl text-sky-600"></i>
                            </div>
                            <div class="font-black mt-1">
                                {{ $totalDays }}
                            </div>
                            <p class="text-xs text-gray-500">
                                Days
                            </p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4 text-center">
                            <div class="text-xl">
                                <i class="ri-video-on-ai-line text-2xl text-yellow-600"></i>
                            </div>
                            <div class="font-black mt-1">
                                {{ $goal->daily_lessons }}
                            </div>
                            <p class="text-xs text-gray-500">
                                Lessons
                            </p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4 text-center">
                            <div class="text-xl">
                                <i class="ri-fire-fill text-green-700"></i>
                            </div>
                            <div class="font-black mt-1">
                                {{ ucfirst($goal->status) }}
                            </div>
                            <p class="text-xs text-gray-500">
                                Status
                            </p>
                        </div>
                    </div>

                    <!-- Button -->

                    <a href="{{ route('learner.roadmaps.show',$goal) }}"
                        class="mt-8 group/button flex items-center justify-center rounded-2xl bg-gradient-to-r 
                                from-indigo-600 via-violet-600 to-cyan-500 py-4 text-white font-bold transition-all duration-500 hover:scale-[1.02]">
                        Continue Roadmap
                        <svg
                            class="w-5 h-5 ml-2 transition group-hover/button:translate-x-2"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        @else
        <div class="rounded-[36px] bg-white shadow-xl p-20 text-center">
            <div class="text-7xl">
                🤖
            </div>
            <h2 class="mt-6 text-3xl font-black">
                No Learning Goal Yet
            </h2>
            <p class="mt-4 text-gray-500">
                Create your first AI learning goal to generate a personalized roadmap.
            </p>
        </div>
        @endif
    </div>


</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".counter");
        counters.forEach(counter => {
            const target = Number(
                counter.dataset.counter || 0
            );
            let current = 0;
            const speed = Math.max(
                20,
                1000 / target
            );
            const updateCounter = () => {
                if (current < target) {
                    current++;
                    counter.innerText = current;
                    setTimeout(
                        updateCounter,
                        speed
                    );

                } else {
                    counter.innerText = target;
                }
            };
            updateCounter();
        });

        const searchInput =
            document.getElementById(
                "roadmapSearch"
            );
        const roadmapCards =
            document.querySelectorAll(
                ".roadmap-card"
            );
        if (searchInput) {
            searchInput.addEventListener(
                "keyup",
                function() {
                    const keyword =
                        this.value.toLowerCase();
                    roadmapCards.forEach(card => {
                        const text =
                            card.innerText.toLowerCase();
                        if (
                            text.includes(keyword)
                        ) {
                            card.style.display = "block";
                            card.animate(
                                [{
                                        opacity: 0,
                                        transform: "translateY(20px)"
                                    },
                                    {
                                        opacity: 1,
                                        transform: "translateY(0)"
                                    }
                                ], {
                                    duration: 400
                                });
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
        }
        const filterButtons =
            document.querySelectorAll(
                ".filter-btn"
            );
        filterButtons.forEach(button => {
            button.addEventListener(
                "click",
                () => {
                    const filter =
                        button.dataset.filter;
                    filterButtons.forEach(btn => {
                        btn.classList.remove(
                            "bg-indigo-600",
                            "text-white"
                        );
                        btn.classList.add(
                            "bg-slate-100"
                        );
                    });
                    button.classList.remove(
                        "bg-slate-100"
                    );
                    button.classList.add(
                        "bg-indigo-600",
                        "text-white"
                    );
                    roadmapCards.forEach(card => {
                        const status =
                            card.innerText
                            .toLowerCase();
                        if (filter === "all") {
                            card.style.display = "block";
                        } else if (
                            status.includes(filter)
                        ) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
        });
        const revealElements =
            document.querySelectorAll(
                ".roadmap-card"
            );
        const observer =
            new IntersectionObserver(
                (entries) => {
                    entries.forEach(
                        (entry) => {
                            if (entry.isIntersecting) {
                                entry.target.animate(
                                    [{
                                            opacity: 0,
                                            transform: "translateY(50px) scale(.95)"
                                        },
                                        {
                                            opacity: 1,
                                            transform: "translateY(0) scale(1)"
                                        }
                                    ], {
                                        duration: 700,
                                        easing: "cubic-bezier(.2,.8,.2,1)",
                                        fill: "forwards"
                                    });
                                observer.unobserve(
                                    entry.target
                                );
                            }
                        });
                }, {
                    threshold: 0.15
                }
            );
        revealElements.forEach(
            element => {
                observer.observe(
                    element
                );
            });
        const progressBars =
            document.querySelectorAll(
                ".progress-bar"
            );
        progressBars.forEach(bar => {
            const width =
                bar.style.width;
            bar.style.width = "0%";
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
        roadmapCards.forEach(card => {
            card.addEventListener(
                "mousemove",
                (e) => {
                    const rect =
                        card.getBoundingClientRect();
                    const x =
                        e.clientX - rect.left;
                    const y =
                        e.clientY - rect.top;
                    const rotateX =
                        ((y - rect.height / 2) /
                            rect.height) *
                        -8;
                    const rotateY =
                        ((x - rect.width / 2) /
                            rect.width) *
                        8;
                    card.style.transform =
                        `
                            perspective(1000px)

                            rotateX(${rotateX}deg)

                            rotateY(${rotateY}deg)

                            translateY(-8px)
                            `;
                });
            card.addEventListener(
                "mouseleave",
                () => {
                    card.style.transform = "";
                });
        });
        const buttons =
            document.querySelectorAll(
                "a,button"
            );
        buttons.forEach(btn => {
            btn.addEventListener(
                "click",
                function(e) {
                    const ripple =
                        document.createElement(
                            "span"
                        );
                    ripple.className =
                        "absolute rounded-full bg-white/40";
                    const rect =
                        this.getBoundingClientRect();
                    ripple.style.width =
                        ripple.style.height =
                        "100px";
                    ripple.style.left =
                        (
                            e.clientX -
                            rect.left -
                            50
                        ) + "px";
                    ripple.style.top =
                        (
                            e.clientY -
                            rect.top -
                            50
                        ) + "px";

                    this.style.position = "relative";
                    this.style.overflow = "hidden";
                    this.appendChild(
                        ripple
                    );
                    setTimeout(() => {
                        ripple.remove();
                    }, 500);
                });
        });
        const blobs =
            document.querySelectorAll(
                ".blur-3xl"
            );
        window.addEventListener(
            "mousemove",
            (e) => {
                const x =
                    e.clientX / window.innerWidth;
                const y =
                    e.clientY / window.innerHeight;
                blobs.forEach((blob, index) => {
                    blob.style.transform =
                        `
                        translate(
                        ${x*30}px,
                        ${y*30}px
                        )
                        `;
                });

            });
    });
</script>

@endsection