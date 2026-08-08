@extends('layout.admin')
@section('page_title','Learning Roadmaps')
@section('content')

<div class="max-w-7xl mx-auto">
    <!-- TOPBAR -->
    <div class="animate-fade-in bg-white/80 rounded-3xl shadow-lg shadow-blue-200 p-6 flex items-center justify-between">

        <div>
            <h1 class="gradient-shine text-4xl font-extrabold">
                {{$roadmap->career}}
            </h1>
            <p class="mt-3 text-slate-600">
                {{$roadmap->description}}
            </p>

        </div>

        <!-- Profile -->
        <div>
            @if($roadmap->is_active)
            <span class="bg-green-100/70 border border-green-300 text-green-800 font-bold px-5 py-2 rounded-full">
                Active
            </span>
            @else
            <span class="bg-red-500 px-5 py-2 rounded-full">
                Inactive
            </span>
            @endif
        </div>
    </div>

    <!-- Summary -->
    <div class="grid md:grid-cols-4 gap-5 mt-8">
        <div class="rounded-3xl bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
            <div class="flex justify-between">
                <div class="">
                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                        Phases
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{$roadmap->phases->count()}}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center">

                    <i class="ri-pages-fill text-xl"></i>

                </div>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Total Phases
            </p>
        </div>
        <div class="rounded-3xl bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
            <div class="flex justify-between">
                <div class="">
                    <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">
                        Tasks
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{$roadmap->tasks->count()}}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center">

                    <i class="ri-pages-fill text-xl"></i>

                </div>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Total Tasks
            </p>
        </div>

        <div class="rounded-3xl bg-gradient-to-br from-pink-200 to-red-100 border border-pink-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
            <div class="flex justify-between">
                <div class="">
                    <p class="text-xs font-semibold uppercase tracking-wide text-pink-600">
                        Days
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{ $roadmap->phases->sum('estimated_days') }}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-pink-500 text-white flex items-center justify-center">

                    <i class="ri-pages-fill text-xl"></i>

                </div>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Total Estimated Days
            </p>
        </div>
        <div class="rounded-3xl bg-gradient-to-br from-slate-200 to-slate-100 border border-slate-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
            <div class="flex justify-between">
                <div class="">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                        souce
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                        {{ucfirst($roadmap->source)}}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-slate-500 text-white flex items-center justify-center">

                    <i class="ri-pages-fill text-xl"></i>

                </div>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                AI or Deault
            </p>
        </div>
    </div>


    <!-- Timeline -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-slate-700 mb-8">
            Learning Roadmap Timeline
        </h2>
        <div class="relative border-l-4 border-indigo-500 ml-5">
            @foreach($roadmap->phases as $phase)
            <div class="mb-10 ml-8">
                <!-- Circle -->
                <div class="absolute -left-5 w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{$phase->phase_no}}
                </div>
                <div class="bg-white shadow rounded-3xl p-6">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-xl font-bold">
                                {{$phase->title}}
                            </h3>
                            <p class="text-gray-500 text-sm mt-2">
                                {{$phase->description}}
                            </p>
                        </div>
                        <span class="bg-blue-100/50 border border-blue-300 h-10 w-28 text-blue-700 font-bold px-4 py-2 rounded-full">
                            {{$phase->estimated_days}} Days
                        </span>
                    </div>
                    <!-- Tasks -->
                    <div class="mt-6 space-y-4">
                        @foreach($phase->tasks as $task)
                        <div class="border border-slate-300 rounded-2xl p-5 hover:shadow transition">
                            <div class="flex justify-between">
                                <div>
                                    <h4 class="font-bold text-lg">
                                        {{$task->title}}
                                    </h4>
                                    <p class="text-gray-500">
                                        {{$task->description}}
                                    </p>
                                </div>
                                <span class="text-sm bg-orange-100/50 border border-orange-300 h-10 flex items-center px-5 py-1 text-orange-700 font-bold rounded-full">
                                    {{$task->estimated_minutes}} min
                                </span>
                            </div>
                            <div class="grid grid-cols-3 gap-3 mt-5 text-center">
                                <div class="bg-blue-50 rounded-xl p-3">
                                    <b>
                                        {{$task->lesson_count}}
                                    </b>
                                    <br>
                                    Lessons
                                </div>
                                <div class="bg-green-50 rounded-xl p-3">
                                    <b>
                                        {{$task->practice_count}}
                                    </b>
                                    <br>
                                    Practice
                                </div>
                                <div class="bg-purple-50 rounded-xl p-3">
                                    <b>
                                        {{$task->course ? 'YES':'NO'}}
                                    </b>
                                    <br>
                                    Course
                                </div>
                            </div>
                            @if($task->course)
                            <a href="#"
                                class="inline-block mt-5 text-indigo-600 font-semibold">
                                📘 {{$task->course->title}}
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection