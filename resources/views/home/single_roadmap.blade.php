@extends('layout.user')
@section('title','My Learning Roadmaps')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="bg-gradient-to-r from-indigo-600 to-cyan-500 rounded-3xl p-8 text-white shadow-xl">

        <h1 class="text-3xl font-black">

            {{ $goal->goal_name }}

        </h1>

        <p class="mt-2">

            Career :

            {{ $roadmap->career }}

        </p>

        <p class="mt-3 opacity-90">

            {{ $roadmap->description }}

        </p>

    </div>

    <div class="mt-10 space-y-10">

        @foreach($roadmap->phases as $phase)

        <div class="relative pl-14">

            <div class="absolute left-5 top-0 bottom-0 w-1 bg-indigo-200"></div>

            <div class="absolute left-0 top-0 w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

                {{ $phase->phase_no }}

            </div>

            <div class="bg-white rounded-3xl shadow-xl p-6">

                <div class="flex justify-between">

                    <h2 class="text-2xl font-bold">

                        {{ $phase->title }}

                    </h2>

                    <span class="bg-indigo-100 text-indigo-600 rounded-full px-3 py-1">

                        {{ $phase->estimated_days }} Days

                    </span>

                </div>

                <p class="text-gray-600 mt-3">

                    {{ $phase->description }}

                </p>

                <div class="grid md:grid-cols-2 gap-5 mt-6">

                    @foreach($phase->tasks as $task)

                    <div class="border rounded-2xl p-5 hover:bg-indigo-50 hover:border-indigo-400 transition">

                        <h3 class="font-bold">

                            {{ $task->title }}

                        </h3>

                        <p class="text-gray-500 mt-2">

                            {{ $task->description }}

                        </p>

                        <div class="mt-4 text-sm space-y-2">

                            <div>

                                ⏱ {{ $task->estimated_minutes }} mins

                            </div>

                            <div>

                                📚 {{ $task->lesson_count }} Lessons

                            </div>

                            <div>

                                💻 {{ $task->practice_count }} Practices

                            </div>

                            @if($task->course)

                            <div>

                                🎓 {{ $task->course->title }}

                            </div>

                            @endif

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection