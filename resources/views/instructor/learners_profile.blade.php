@extends('layout.course_ins')
@section("title","Learner Profile")
@section("page","Instructor Analysis Learner Learning Progress.")
@section('content')


<!-- Header -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
    <div class="flex flex-col lg:flex-row justify-between items-center">
        <div class="flex items-center gap-6">
            <img
                src="https://ui-avatars.com/api/?background=4f46e5&color=fff&size=200&name={{ urlencode($learner->name) }}"
                class="w-28 h-28 rounded-full border-4 border-indigo-500 object-cover">

            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    {{ $learner->name }}
                </h1>
                <p class="text-slate-500 mt-1">
                    {{ $learner->email }}
                </p>

                <div class="mt-4 flex flex-wrap gap-3">

                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">
                        Purchased
                    </span>

                    <span class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                        {{ $course->title }}
                    </span>

                </div>

            </div>

        </div>

        <div class="mt-8 lg:mt-0 text-center">

            <div class="text-3xl font-black text-indigo-600">
                {{ $overallProgress }}%
            </div>

            <div class="text-slate-500 font-semibold text-sm mt-2">
                Overall Progress
            </div>

        </div>

    </div>

</div>

<!-- Learner Information -->
<div class="grid lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <h2 class="text-xl font-bold mb-6">
            Learner Information
        </h2>
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="text-slate-500">
                    Name
                </span>
                <span class="font-semibold">
                    {{ $learner->name }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">
                    Email
                </span>
                <span class="font-semibold">
                    {{ $learner->email }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">
                    Purchased
                </span>
                <span class="font-semibold">
                    {{ optional($order->paid_at)->format('d M Y h:i A') }}
                </span>
            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">
                    Course
                </span>

                <span class="font-semibold">
                    {{ $course->title }}
                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">
                    Category
                </span>

                <span class="font-semibold">
                    {{ $course->category }}
                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">
                    Level
                </span>

                <span class="font-semibold">
                    {{ $course->level }}
                </span>

            </div>

        </div>

    </div>


    {{-- Overall Progress --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <h2 class="text-xl font-bold mb-6">
            Overall Progress
        </h2>

        <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">

            <div
                class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full transition-all duration-1000"
                style="width:{{ $overallProgress . '%' }}">
            </div>

        </div>

        <div class="mt-8 grid grid-cols-2 gap-4">

            <div class="bg-indigo-50 rounded-2xl p-5">

                <div class="text-sm text-slate-500">
                    Quiz Completion
                </div>

                <div class="text-xl font-bold text-indigo-700 mt-2">
                    {{ $quizCompletionRate }}%
                </div>

            </div>

            <div class="bg-green-50 rounded-2xl p-5">

                <div class="text-sm text-slate-500">
                    Quiz Average
                </div>

                <div class="text-xl font-bold text-green-600 mt-2">
                    {{ $quizAverage }}%
                </div>

            </div>

            <div class="bg-orange-50 rounded-2xl p-5">

                <div class="text-sm text-slate-500">
                    Attendance
                </div>

                <div class="text-xl font-bold text-orange-600 mt-2">
                    {{ $attendanceRate }}%
                </div>

            </div>

            <div class="bg-pink-50 rounded-2xl p-5">

                <div class="text-sm text-slate-500">
                    Engagement
                </div>

                <div class="text-xl font-bold text-pink-600 mt-2">
                    {{ $engagementRate }}%
                </div>

            </div>

        </div>

    </div>

</div>

<!-- Statistics  -->
<div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(79,70,229,0.12)] transition duration-300">

        <div class="flex justify-between">
            <div class="">

                <div class="text-slate-700 text-sm font-bold">
                    Total Quiz
                </div>

                <div class="text-2xl font-black text-indigo-600 mt-2">
                    {{ $quizTotal }}
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                <span class="text-2xl">💰</span>
            </div>
        </div>

        <div class="mt-2 text-slate-500 text-xs">
            Completed {{ $completedQuiz }}
        </div>

    </div>

    <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(79,70,229,0.12)] transition duration-300">


        <div class="flex justify-between">
            <div class="">
                <div class="text-slate-700 text-sm font-bold">
                    Live Sessions
                </div>

                <div class="text-2xl font-black text-green-600 mt-3">
                    {{ $totalLives }}
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                <span class="text-2xl"><i class="ri-phone-line"></i></span>
            </div>
        </div>

        <div class="mt-2 text-slate-500 text-xs">
            Joined {{ $joinedLives }}
        </div>

    </div>

    <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(79,70,229,0.12)] transition duration-300">
        <div class="flex justify-between">
            <div class="">
                <div class="text-slate-700 text-sm font-bold">
                    Average Join Time
                </div>

                <div class="text-2xl font-black text-sky-500 mt-3">
                    {{ $averageJoinMinutes }}
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-500 text-white flex items-center justify-center shadow-lg shadow-sky-200">
                <span class="text-2xl">👨‍🎓</span>
            </div>
        </div>



        <div class="mt-2 text-slate-500 text-xs">
            Minutes
        </div>

    </div>

    <div class="group relative overflow-hidden rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-6 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(79,70,229,0.12)] transition duration-300">
        <div class="flex justify-between">
            <div class="">
                <div class="text-slate-700 text-sm font-bold">
                    Overall Live Average
                </div>

                <div class="text-2xl font-black text-orange-600 mt-3">
                    {{ $overallAverageMinutes }}
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-200">
                <span class="text-2xl"><i class="ri-phone-line"></i></span>
            </div>
        </div>


        <div class="mt-2 text-slate-500 text-xs">
            Minutes
        </div>

    </div>

</div>

<!-- QUIZ ANALYSIS -->
<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Quiz Performance Analysis
            </h2>

            <p class="text-slate-500 mt-2">
                Learner's quiz performance for this course.
            </p>
        </div>

        <div class="mt-5 lg:mt-0">

            <span class="px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                {{ $completedQuiz }} / {{ $quizTotal }} Completed
            </span>

        </div>

    </div>

    <!-- Progress -->
    <div class="mb-8">

        <div class="flex justify-between mb-2">

            <span class="font-semibold">
                Quiz Completion
            </span>

            <span class="font-bold text-indigo-600">
                {{ $quizCompletionRate }}%
            </span>

        </div>

        <div class="w-full bg-slate-200 rounded-full h-4">

            <div
                class="h-4 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 transition-all duration-1000"
                style="width: {{ $quizCompletionRate }}%">
            </div>

        </div>

    </div>


    <!-- Table -->
    <div class="overflow-x-auto h-100 overflow-y-auto pr-5">

        <table class="min-w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4 px-4">
                        Quiz
                    </th>

                    <th class="text-center">
                        Status
                    </th>

                    <th class="text-center">
                        Score
                    </th>

                    <th class="text-center">
                        Percentage
                    </th>

                    <th class="text-center">
                        Performance
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($quizRows as $row)

                <tr class="border-b hover:bg-slate-50 transition">

                    <td class="py-5 px-4">

                        <div class="font-semibold">

                            {{ $row['quiz']->title }}

                        </div>

                        <div class="text-xs text-slate-500 mt-1">

                            Passing :
                            {{ $row['quiz']->passing_score }} %

                        </div>

                    </td>

                    <td class="text-center">

                        @if($row['attempted'])

                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                            Attempted
                        </span>

                        @else

                        <span class="px-4 py-2 rounded-full bg-red-100 text-red-600 text-sm font-semibold">
                            Not Attempted
                        </span>

                        @endif

                    </td>

                    <td class="text-center font-bold">

                        {{ $row['earned'] }}

                        /

                        {{ $row['total'] }}

                    </td>

                    <td class="text-center">

                        <span class="font-bold">

                            {{ $row['percentage'] }}%

                        </span>

                    </td>

                    <td class="w-72">

                        <div class="flex items-center gap-4">

                            <div class="flex-1 bg-slate-200 rounded-full h-3">

                                <div
                                    class="h-3 rounded-full
                                    @if($row['percentage']>=80)

                                        bg-green-500

                                    @elseif($row['percentage']>=50)

                                        bg-yellow-400
@else

                                        bg-red-500

                                    @endif"
                                    style="width:'{{ $row['percentage'] }}%'">
                                </div>

                            </div>

                            <div class="font-semibold text-sm w-14 text-right">

                                {{ $row['percentage'] }}%

                            </div>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-10 text-slate-500">

                        No Quiz Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



{{-- Weak / Average / Excellent --}}
@php
if($quizAverage>=80){
$performance="Excellent";
$color="green";
}elseif($quizAverage>=50){
$performance="Average";
$color="yellow";
}else{
$performance="Needs Improvement";
$color="red";
}
@endphp

<div class="bg-white/80 rounded-3xl shadow-xl p-8 mb-10">
    <h3 class="text-xl font-bold mb-2">
        Quiz Result Summary
    </h3>
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <div>
            <div class="text-slate-500">
                Overall Performance
            </div>
            <div class="mt-2 text-xl font-black text-{{ $color }}-600">
                {{ $performance }}
            </div>
        </div>

        <div class="mt-8 lg:mt-0 w-full lg:w-96">
            <div class="flex justify-between mb-2">
                <span>Average Score</span>
                <span>{{ $quizAverage }}%</span>
            </div>

            <div class="bg-slate-200 h-3 rounded-full">
                <div
                    class="h-3 rounded-full bg-{{ $color }}-500"
                    style="width:'{{ $quizAverage }}%'">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- LIVE SESSION ANALYSIS -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Live Class Analysis
            </h2>
            <p class="text-slate-500 mt-2">
                Learner live attendance and engagement statistics.
            </p>
        </div>
        <div class="mt-6 lg:mt-0">
            <span
                class="px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                {{ $joinedLives }} / {{ $totalLives }} Joined
            </span>
        </div>
    </div>
</div>


<!-- SUMMARY CARDS -->
<div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    {{-- Total Live --}}
    <div
        class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-3xl shadow-lg p-4">
        <div class="text-indigo-100 font-bold">
            Total Live Classes
        </div>
        <div class="text-xl font-black mt-1">
            {{ $totalLives }}
        </div>
        <div class="mt-1 text-xs text-indigo-100">
            Sessions
        </div>
    </div>

    {{-- Joined --}}
    <div
        class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-3xl shadow-lg p-4">
        <div class="text-green-100 font-bold">
            Joined Classes
        </div>
        <div class="text-xl font-black mt-1">
            {{ $joinedLives }}
        </div>

        <div class="mt-1 text-xs text-green-100">
            Attendance
        </div>
    </div>


    {{-- Attendance --}}
    <div
        class="bg-gradient-to-br from-orange-500 to-red-500 text-white rounded-3xl shadow-lg p-4">
        <div class="text-orange-100 font-bold">
            Attendance Rate
        </div>
        <div class="text-xl font-black mt-1">
            {{ $attendanceRate }}%
        </div>

        <div class="w-full bg-white/30 rounded-full h-3 mt-1">
            <div
                class="bg-white rounded-full h-3 transition-all duration-1000"
                style="width:{{ $attendanceRate }}%">
            </div>
        </div>
    </div>


    {{-- Engagement --}}
    <div
        class="bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-3xl shadow-lg p-4">
        <div class="text-purple-100 font-bold">
            Engagement
        </div>
        <div class="text-xl font-black mt-1">
            {{ $engagementRate }}%
        </div>
        <div class="w-full bg-white/30 rounded-full h-3 mt-1">
            <div
                class="bg-white rounded-full h-3 transition-all duration-1000"
                style="width:{{ $engagementRate }}%">
            </div>
        </div>
    </div>
</div>



<!-- LIVE SUMMARY -->
<div class="grid lg:grid-cols-2 gap-6 mb-8">

    {{-- Average Join Time --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <h3 class="text-xl font-bold mb-1">
            Average Join Time
        </h3>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-slate-500">
                    Joined Live Only
                </div>
                <div class="text-2xl font-black text-indigo-600 mt-1">
                    {{ number_format($averageJoinMinutes,1) }}
                </div>

                <div class="text-slate-500 mt-2">
                    Minutes
                </div>
            </div>
            <div
                class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-2xl font-bold text-indigo-700">
                    {{ $joinedLives }}
                </span>
            </div>
        </div>
    </div>
    <!-- Overall Average  -->
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <h3 class="text-xl font-bold mb-1">
            Overall Live Average
        </h3>

        <div class="flex items-center justify-between">
            <div>
                <div class="text-slate-500">
                    All Course Live Sessions
                </div>
                <div class="text-2xl font-black text-pink-600 mt-1">
                    {{ number_format($overallAverageMinutes,1) }}
                </div>
                <div class="text-slate-500 mt-2">

                    Minutes

                </div>

            </div>

            <div
                class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">

                <span class="text-2xl font-bold text-pink-700">

                    {{ $totalLives }}

                </span>

            </div>

        </div>

    </div>

</div>



<!-- PERFORMANCE STATUS -->
@php

if($attendanceRate >= 90){

$liveStatus = "Excellent Attendance";
$liveColor = "green";

}elseif($attendanceRate >= 70){

$liveStatus = "Good Attendance";
$liveColor = "blue";

}elseif($attendanceRate >= 50){

$liveStatus = "Average Attendance";
$liveColor = "yellow";

}else{

$liveStatus = "Poor Attendance";
$liveColor = "red";

}

@endphp


<div class="bg-white rounded-3xl shadow-lg p-8 mb-10">

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">

        <div>

            <h3 class="text-xl font-bold">

                Live Attendance Performance

            </h3>

            <p class="text-slate-500 mt-2">

                Based on learner participation across all live classes.

            </p>

        </div>

        <div class="mt-6 lg:mt-0">

            <span
                class="px-6 py-3 rounded-full bg-{{ $liveColor }}-100 text-{{ $liveColor }}-700 font-bold">

                {{ $liveStatus }}

            </span>

        </div>

    </div>

    <div class="mt-2">

        <div class="flex justify-between mb-2">

            <span class="font-semibold">

                Attendance

            </span>

            <span class="font-bold">

                {{ $attendanceRate }}%

            </span>

        </div>

        <div class="bg-slate-200 rounded-full h-3">

            <div
                class="bg-{{ $liveColor }}-500 h-3 rounded-full transition-all duration-1000"
                style="width:{{ $attendanceRate }}%">
            </div>

        </div>

    </div>

</div>


<!-- LIVE SESSION DETAILS -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">

    <div class="flex justify-between items-center mb-5">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Live Session Details
            </h2>

            <p class="text-slate-500 mt-2">
                Attendance history for every live class.
            </p>

        </div>

    </div>


    <div class="overflow-x-auto h-100 overflow-y-auto">

        <table class="min-w-full">

            <thead>

                <tr class="border-b bg-slate-50">

                    <th class="text-left py-4 px-4">
                        Live
                    </th>

                    <th class="text-center">
                        Live Time
                    </th>

                    <th class="text-center">
                        Joined
                    </th>

                    <th class="text-center">
                        Left
                    </th>

                    <th class="text-center">
                        Duration
                    </th>

                    <th class="text-center">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($liveRows as $row)

                <tr class="border-b hover:bg-slate-50 transition">

                    <td class="py-5 px-4">

                        <div class="font-bold">

                            {{ $row['live']->title }}

                        </div>

                        <div class="text-xs text-slate-500 mt-1">

                            {{ optional($row['started_at'])->format('d M Y') }}

                        </div>

                    </td>

                    <td class="text-center">

                        @if($row['started_at'])

                        {{ \Carbon\Carbon::parse($row['started_at'])->format('h:i A') }}

                        <br>

                        <span class="text-slate-400">

                            ↓

                        </span>

                        <br>

                        {{ \Carbon\Carbon::parse($row['ended_at'])->format('h:i A') }}

                        @else

                        -

                        @endif

                    </td>

                    <td class="text-center">

                        @if($row['joined'])

                        <span class="font-semibold text-green-600">

                            {{ \Carbon\Carbon::parse($row['joined_at'])->format('h:i A') }}

                        </span>

                        @else

                        <span class="text-red-500">

                            Not Joined

                        </span>

                        @endif

                    </td>

                    <td class="text-center">

                        @if($row['joined'])

                        {{ \Carbon\Carbon::parse($row['left_at'])->format('h:i A') }}

                        @else

                        -

                        @endif

                    </td>

                    <td class="text-center">

                        @php

                        $minutes=floor($row['duration_seconds']/60);

                        $seconds=$row['duration_seconds']%60;

                        @endphp

                        @if($row['joined'])

                        <span
                            class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">

                            {{ $minutes }}m {{ $seconds }}s

                        </span>

                        @else

                        <span
                            class="px-4 py-2 rounded-full bg-red-100 text-red-600">

                            0 min

                        </span>

                        @endif

                    </td>
                    <td class="text-center">

                        @if($row['joined'])

                        <span
                            class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                            Present

                        </span>

                        @else

                        <span
                            class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

                            Absent

                        </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-10 text-slate-500">

                        No Live Session Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- LIVE ENGAGEMENT SUMMARY -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">


    <div class="mb-8">

        <h2 class="text-2xl font-bold text-slate-800">

            Live Engagement Analysis

        </h2>

        <p class="text-slate-500 mt-2">

            Overall learner participation analysis for this course.

        </p>

    </div>



    {{-- Engagement Metrics --}}

    <div class="grid md:grid-cols-3 gap-6">


        {{-- Total Live Time --}}

        <div class="rounded-3xl bg-indigo-50 p-5">

            <div class="text-indigo-600 font-semibold">

                Total Live Duration

            </div>


            @php

            $totalLiveMinutes = round(collect($liveRows)->sum('live_seconds')/60);

            @endphp


            <div class="text-2xl font-black text-indigo-700 mt-2">

                {{ $totalLiveMinutes }}

            </div>


            <div class="text-slate-500 mt-2">

                Minutes

            </div>


        </div>



        {{-- Learner Watched --}}

        <div class="rounded-3xl bg-green-50 p-5">

            <div class="text-green-600 font-semibold">

                Learner Joined Duration

            </div>


            @php

            $learnerMinutes = round(
            collect($liveRows)
            ->sum('duration_seconds') / 60
            );

            @endphp


            <div class="text-2xl font-black text-green-700 mt-2">

                {{ $learnerMinutes }}

            </div>


            <div class="text-slate-500 mt-2">

                Minutes Attended

            </div>


        </div>



        {{-- Missed Live --}}

        <div class="rounded-3xl bg-red-50 p-5">


            <div class="text-red-600 font-semibold">

                Missed Live

            </div>


            <div class="text-2xl font-black text-red-700 mt-2">

                {{ $totalLives - $joinedLives }}

            </div>


            <div class="text-slate-500 mt-2">

                Sessions

            </div>


        </div>


    </div>


</div>




<!-- ENGAGEMENT SCORE -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
    <h2 class="text-2xl font-bold mb-8">
        Engagement Score
    </h2>

    <div class="space-y-8">
        <!-- Attendance  -->
        <div>
            <div class="flex justify-between mb-3">
                <span class="font-semibold">
                    Attendance Rate
                </span>
                <span class="font-bold text-indigo-600">
                    {{ $attendanceRate }}%
                </span>
            </div>
            <div class="h-4 bg-slate-200 rounded-full">
                <div class="h-4 rounded-full bg-indigo-500 transition-all duration-1000"
                    style="width:{{ $attendanceRate }}%">
                </div>
            </div>
        </div>

        <!-- Engagement  -->
        <div>
            <div class="flex justify-between mb-3">
                <span class="font-semibold">
                    Watching Engagement
                </span>
                <span class="font-bold text-purple-600">
                    {{ $engagementRate }}%
                </span>
            </div>
            <div class="h-4 bg-slate-200 rounded-full">
                <div class="h-4 rounded-full bg-purple-500 transition-all duration-1000"
                    style="width:{{ $engagementRate }}%">
                </div>
            </div>
        </div>

        <!-- Average Join  -->
        <div>
            <div class="flex justify-between mb-3">
                <span class="font-semibold">
                    Average Live Participation
                </span>
                <span class="font-bold text-pink-600">
                    {{ $averageJoinMinutes }} min
                </span>
            </div>

            @php

            $averagePercent = $totalCourseLiveSeconds ?? 0;
            if($averagePercent > 0){
            $averagePercent = min(round((($averageJoinMinutes*60)/($averagePercent/$totalLives)) *100 ),100);
            }else{
            $averagePercent = 0;
            }

            @endphp


            <div class="h-4 bg-slate-200 rounded-full">
                <div class="h-4 rounded-full bg-pink-500 transition-all duration-1000"
                    style="width:{{ $averagePercent }}%">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- FINAL LIVE PERFORMANCE -->

@php

if($engagementRate >= 80){

$performanceText = "Highly Engaged Learner";

$performanceColor = "green";


}elseif($engagementRate >= 50){

$performanceText = "Active Learner";

$performanceColor = "blue";


}elseif($engagementRate >= 30){

$performanceText = "Needs Attention";

$performanceColor = "yellow";


}else{

$performanceText = "Low Participation";

$performanceColor = "red";

}


@endphp

<div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl shadow-xl p-10 text-white">
    <div class="flex flex-col lg:flex-row justify-between items-center">
        <div>
            <h2 class="text-3xl font-black">
                Live Learning Performance
            </h2>
            <p class="text-slate-300 mt-3">
                Based on attendance, duration and participation.
            </p>
        </div>
        <div class="mt-6 lg:mt-0">
            <span
                class="px-8 py-4 rounded-full bg-{{ $performanceColor }}-500 text-white font-bold text-lg">
                {{ $performanceText }}
            </span>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-10">
        <div class="bg-white/10 rounded-2xl p-6">
            <div class="text-slate-300">
                Attendance
            </div>
            <div class="text-4xl font-black mt-2">
                {{ $attendanceRate }}%
            </div>
        </div>

        <div class="bg-white/10 rounded-2xl p-6">
            <div class="text-slate-300">
                Engagement
            </div>
            <div class="text-4xl font-black mt-2">
                {{ $engagementRate }}%
            </div>
        </div>

        <div class="bg-white/10 rounded-2xl p-6">
            <div class="text-slate-300">
                Avg Join
            </div>

            <div class="text-4xl font-black mt-2">
                {{ $averageJoinMinutes }}
                <span class="text-xl">
                    min
                </span>
            </div>
        </div>
    </div>
</div>


<!-- ANALYTICS CHARTS -->
<div class="grid lg:grid-cols-2 hidden gap-8 mt-10 ">

    <!-- Quiz Performance Chart  -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-xl font-bold mb-6">
            Quiz Performance
        </h2>
        <canvas id="quizChart"></canvas>
    </div>

    <!-- Live Attendance Chart  -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-xl font-bold mb-6">
            Live Attendance
        </h2>
        <canvas id="liveChart"></canvas>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8 mt-8 max-w-6xl mx-auto">

    <!-- Engagement Doughnut  -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-xl font-bold mb-6">
            Learning Engagement
        </h2>
        <canvas id="engagementChart"></canvas>
    </div>

    {{-- Overall Radar --}}
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-xl font-bold mb-6">
            Overall Progress Analysis
        </h2>
        <canvas id="progressChart"></canvas>
    </div>
</div>

<script>
    // | Quiz Chart
    const quizLabels = `@json(
    collect($quizRows)
    ->pluck('quiz.title')
)`;


    const quizScores = `@json(
    collect($quizRows)
    ->pluck('percentage')
)`;



    new Chart(
        document.getElementById('quizChart'), {
            type: 'bar',
            data: {
                labels: quizLabels,
                datasets: [{
                    label: 'Score %',
                    data: quizScores,
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        }
    );


    // Live Attendance Chart

    const liveLabels = `@json(

    collect($liveRows)
    ->map(function($row){

        return $row['live']->title;
    })
)`;

    const liveData = `@json(

    collect($liveRows)
    ->map(function($row){

        return $row['joined']
        ? round(($row['duration_seconds']/60),2)
        : 0;

    })

)`;

    new Chart(
        document.getElementById('liveChart'), {
            type: 'bar',
            data: {
                labels: liveLabels,
                datasets: [{
                    label: 'Minutes Joined',
                    data: liveData,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        }
    );


    // | Engagement Doughnut
    new Chart(
        document.getElementById('engagementChart'), {
            type: 'doughnut',
            data: {
                labels: [
                    'Attended',
                    'Missed'
                ],
                datasets: [{
                    data: [
                        `{{ $joinedLives }}`,
                        `{{ $totalLives-$joinedLives }}`
                    ],
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true
            }
        }
    );


    // | Overall Progress Radar
    new Chart(
        document.getElementById('progressChart'), {
            type: 'radar',
            data: {
                labels: [
                    'Quiz Completion',
                    'Quiz Score',
                    'Attendance',
                    'Engagement'
                ],
                datasets: [{
                    label: 'Learner Performance',
                    data: [
                        `{{ $quizCompletionRate }}`,
                        `{{ $quizAverage }}`,
                        `{{ $attendanceRate }}`,
                        `{{ $engagementRate }}`
                    ],
                    borderWidth: 2
                }]
            },

            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        }
    );
</script>


@endsection