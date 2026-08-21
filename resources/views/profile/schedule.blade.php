@extends('layout.user')
@section('title','Learner Schedule')

@section('content')

@php

$weekDays = [
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday',
'Saturday',
'Sunday'
];

@endphp

<div class="mb-8">

    <h1 class="text-xl md:text-4xl font-bold text-slate-800">
        <span class="text-slate-800 dark:text-white">My Learning</span> <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
            Schedule
        </span>
    </h1>

    <p class="text-slate-600 mt-2 dark:text-white" data-en="Weekly course schedule and upcoming classes" data-mm="တပတ်အတွင်း သင်တန်းချိန်များ နှင့် မကြာမှီလာမည့်သင်တန်းချိန်များ">
        Weekly course schedule and upcoming classes
    </p>

</div>

<!-- LIVE CLASS -->

@if($nextClass)

<div class="mb-8 bg-gradient-to-r from-indigo-500/20 to-cyan-500/20 border border-indigo-500/20 rounded-3xl p-6">
    <div class="flex justify-between items-center">
        <div>
            <span class="px-3 py-1 bg-green-500 rounded-full text-xs text-white">
                NEXT CLASS
            </span>
            <h2 class="text-2xl font-bold text-white mt-3">
                {{ $nextClass->course->title }}
            </h2>
            <p class="text-slate-300 mt-2">
                {{ \Carbon\Carbon::parse($nextClass->schedule_date)->format('d M Y') }}
                •
                {{ date('g:i A',strtotime($nextClass->start_time)) }}
            </p>
        </div>
        <a href="{{ $nextClass->meeting_link }}"
            class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3 rounded-2xl text-white">
            Join Class
        </a>
    </div>
</div>
@endif

<!-- Stats -->

<div class="grid md:grid-cols-3 gap-5 mb-8">

    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/50 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 
                hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300"
        style="animation-delay:0ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p data-en="Courses" data-mm="ဘာသာရပ်များ" class="text-sm font-semibold text-slate-500 dark:text-white">Course</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
                        {{ $courseCount }}
                    </h2>
                    <p data-en="Total Courses" data-mm="စုစုပေါင်း ဘာသာရပ်များ" class="mt-2 text-xs text-slate-500 dark:text-white">Total course counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                    <span class="text-2xl">📚</span>
                </div>
            </div>


        </div>
    </div>


    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/50 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300" style="animation-delay:150ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-pink-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p data-en="Class" data-mm="သင်တန်း" class="text-sm font-semibold text-slate-500 dark:text-white">Today Class</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
                        {{ $todayClassCount }}
                    </h2>
                    <p data-en="Total Class (weekly)" data-mm="စုစုပေါင်း သင်တန်း" class="mt-2 text-xs text-slate-500 dark:text-white">Total today class counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-pink-500 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                    <span class="text-2xl">👨‍🎓</span>
                </div>
            </div>


        </div>
    </div>


    <div class="stat-card opacity-0 animate-stat-in group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/50 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(14,165,233,0.12)] transition duration-300" style="animation-delay:300ms">
        <div class="absolute top-0 right-0 w-28 h-28 bg-sky-100 rounded-full blur-3xl opacity-60 -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p data-en="Upcoming Class" data-mm="မကြာသေးမီ သင်တန်း" class="text-sm font-semibold text-slate-500 dark:text-white">Upcoming class</p>
                    <h2 class="mt-3 text-xl md:text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
                        {{ $upcomingClassCount }}
                    </h2>
                    <p data-en="Total Upcoming Class" data-mm="စုစုပေါင်းမကြာသေးမီ သင်တန်း" class="mt-2 text-xs text-slate-500 dark:text-white">Total upcoming counts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-500 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                    <span class="text-2xl">👨‍🎓</span>
                </div>
            </div>


        </div>
    </div>


</div>

<div class="grid lg:grid-cols-3 gap-6">

    <!-- LEFT -->

    <div class="lg:col-span-2 space-y-6">

        <!-- WEEKLY SCHEDULE -->

        <div class="stat-card opacity-0 animate-stat-in bg-white/80 dark:bg-white/20 p-6 border border-slate-200 rounded-3xl" style="animation-delay:450ms">
            <h2 class="text-xl font-bold text-slate-800 mb-6 dark:text-white" data-en="Weekly Schedule" data-mm="တပတ်အတွင်း သင်တန်းများ">
                Weekly Schedule
            </h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-7 gap-3 overflow-x-auto">
                @php
                $weekDays = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
                ];
                @endphp


                @foreach($weekDays as $day)

                <div class="bg-pink-100 dark:bg-white/20 rounded-2xl p-3 min-h-[350px]">

                    <h3 class="text-blue-800 dark:text-white font-bold text-center mb-4">
                        {{ substr($day,0,3) }}
                    </h3>

                    <hr class="text-slate-400 mb-2">
                    @forelse($weeklyGrouped[$day] ?? [] as $schedule)

                    <div class="mb-3 p-3 rounded-xl bg-indigo-500/20">

                        <div class="text-slate-800 text-sm font-semibold">
                            {{ $schedule->course->title ?? 'Course' }}
                        </div>

                        <div class="text-blue-700 text-xs mt-2">
                            start -
                            {{ date('g:i A', strtotime($schedule->start_time)) }}


                        </div>

                    </div>

                    @empty

                    <div class="text-orange-700 text-xs text-center">
                        Not Class
                    </div>

                    @endforelse

                </div>

                @endforeach


            </div>

        </div>

    </div>

    <!-- RIGHT SIDEBAR -->

    <div class="space-y-6">

        <!-- TODAY -->

        <div class="stat-card opacity-0 animate-stat-in bg-white/80 border border-slate-200 rounded-2xl py-6 px-8" style="animation-delay:600ms">

            <h2
                class="text-slate-800
                        font-bold mb-4" data-en="Today's Classes" data-mm="ယနေ့ သင်တန်း">

                Today's Classes

            </h2>

            <div class="space-y-4">

                @forelse($todayClasses as $class)

                <div
                    class="border-l-4
                            border-cyan-500
                            pl-4">

                    <div
                        class="text-slate-600
                                font-semibold">

                        {{ $class->course->title }}

                    </div>

                    <div
                        class="text-slate-400
                                text-sm">

                        {{ date('g:i A',strtotime($class->start_time)) }}

                    </div>

                </div>

                @empty

                <div
                    class="text-slate-500">

                    No classes today

                </div>

                @endforelse

            </div>

        </div>

        <!-- UPCOMING -->

        <div class="stat-card opacity-0 animate-stat-in bg-white/80 border border-slate-200 rounded-2xl py-6 px-8" style="animation-delay:750ms">

            <h2 class="text-slate-800 font-bold mb-4" data-en="Upcoming Class" data-mm="မကြာသေးမီ သင်တန်း">
                Upcoming Classes
            </h2>
            <div class="space-y-4">

                @foreach($upcomingClasses as $class)
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-slate-600 font-medium">
                            {{ $class->course->title }}
                        </div>
                        <div
                            class="text-slate-400 text-xs">
                            {{ \Carbon\Carbon::parse($class->day)->format('d M') }}
                        </div>
                    </div>
                    <div class="text-cyan-400 text-sm">
                        {{ date('g:i A',strtotime($class->start_time)) }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>


<style>
    .glass-card {
        background: rgba(255, 255, 255, .05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 24px;
        padding: 24px;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom,
                #6366f1,
                #06b6d4);
        border-radius: 999px;
    }
</style>

@endsection