@extends('layout.course_ins')
@section('title','Quizzes')
@section('page','Assignment show and submit.')
@section('content')

<style>
    @keyframes card-in {
        0% {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }


    .animate-card-in {
        animation: card-in 0.7s ease-out forwards;
    }
</style>

@if($isInstructor)
<div class="flex justify-end">
    <a href="{{ route('quiz.create', $course->id) }}"
        class="inline-flex items-center gap-2 px-6 py-3
                          bg-white text-indigo-600 font-bold rounded-2xl
                          shadow-xl hover:scale-105 active:scale-95
                          transition-all duration-300">
        + Create New Quiz
    </a>
</div>
@endif
@if($quizzes->count()==0)

<div class="bg-white/10 backdrop-blur-xl rounded-3xl p-10 text-center">
    <h2 class="text-white text-2xl">
        No Quiz Available
    </h2>
</div>

@endif


{{-- Section Heading --}}
<div class="text-center mb-12" data-aos="fade-up">
    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/70 backdrop-blur-md border border-white shadow-sm text-sm font-semibold text-indigo-600">
        ✨ Interactive Quiz Collection
    </span>

    <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-800">
        Explore & Start Your
        <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
            Smart Quizzes
        </span>
    </h1>

    <p class="mt-4 max-w-2xl mx-auto text-slate-500 text-sm sm:text-base leading-7">
        Practice with beautifully designed quizzes, track your completion status,
        and improve your learning experience with a clean modern interface.
    </p>
</div>

{{-- Quiz Grid --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($quizzes as $quiz)
    @php
    $questionCount = $quiz->questions->count();

    // card accent + icon color by status
    if ($quiz->status === 'published') {

    $topBar = 'from-emerald-400 via-teal-400 to-cyan-400';
    $badgeClass = 'bg-emerald-100 text-emerald-600 border border-emerald-200';
    $iconWrap = 'bg-emerald-50 text-emerald-500';

    } elseif ($quiz->status === 'expired') {

    $topBar = 'from-rose-400 via-pink-400 to-red-400';
    $badgeClass = 'bg-rose-100 text-rose-600 border border-rose-200';
    $iconWrap = 'bg-rose-50 text-rose-500';

    } else {

    $topBar = 'from-amber-400 via-orange-400 to-yellow-400';
    $badgeClass = 'bg-amber-100 text-amber-700 border border-amber-200';
    $iconWrap = 'bg-amber-50 text-amber-500';
    }

    $completedBadge = 'bg-blue-100 text-blue-600 border border-blue-200';
    @endphp

    <div
        class="group relative rounded-[30px] bg-white/75 backdrop-blur-xl border border-white/70 
        shadow-[0_20px_60px_rgba(99,102,241,0.08)] hover:shadow-[0_25px_70px_rgba(99,102,241,0.16)] 
        transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] overflow-hidden
        opacity-0 animate-card-in
        " style="animation-delay: '{{ $loop->index * 100 }}'ms">

        {{-- top gradient line --}}
        <div class="h-1.5 w-full bg-gradient-to-r {{ $topBar }}"></div>

        {{-- floating decoration --}}
        <div class="absolute -top-10 -right-10 w-28 h-28 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 opacity-70 blur-2xl group-hover:scale-110 transition duration-500"></div>
        <div class="absolute bottom-10 -left-6 w-16 h-16 rounded-full bg-pink-100 opacity-50 blur-xl"></div>

        <div class="relative p-6 sm:p-7">
            {{-- top badges --}}
            <div class="flex items-start justify-between gap-3 mb-6">
                <div class="flex flex-wrap gap-2">
                    @if($quiz->status == 'published')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $badgeClass }}">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        published
                    </span>
                    @elseif($quiz->status == 'expired')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $badgeClass }}">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Expired
                    </span>
                    @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $badgeClass }}">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Draft
                    </span>
                    @endif
                </div>

                @if($quiz->alreadyAnswered)
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $completedBadge }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Completed
                </span>
                @endif
            </div>

            {{-- center icon --}}
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="w-24 h-24 rounded-full {{ $iconWrap }} flex items-center justify-center shadow-inner ring-8 ring-white/60 group-hover:scale-110 transition duration-500">
                        {{-- quiz icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-11" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 7h6m-6 4h3" />
                        </svg>
                    </div>

                    <span class="absolute right-1 bottom-2 w-4 h-4 rounded-full bg-gradient-to-r from-indigo-400 to-pink-400 shadow-lg"></span>
                </div>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 leading-snug line-clamp-2 min-h-[60px]">
                    {{ $quiz->title }}
                </h2>
            </div>

            {{-- info boxes --}}
            <div class="space-y-3">
                <div class="flex items-center justify-between rounded-2xl bg-slate-50/90 border border-slate-100 px-4 py-3">
                    <div class="flex items-center gap-3 text-slate-500">
                        <div class="w-9 h-9 rounded-xl bg-violet-100 text-violet-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <span class="font-medium">Questions</span>
                    </div>
                    <span class="text-slate-800 font-bold text-lg">{{ $questionCount }}</span>
                </div>

                <div class="flex items-center justify-between rounded-2xl bg-slate-50/90 border border-slate-100 px-4 py-3 gap-3">
                    <div class="flex items-center gap-3 text-slate-500 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-500 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">End Date</span>
                    </div>

                    <span class="text-slate-700 font-semibold text-sm sm:text-[15px] text-right leading-6">
                        {{ \Carbon\Carbon::parse($quiz->end_at)->format('d M Y h:i A') }}
                    </span>
                </div>
            </div>

            {{-- button --}}

            <div class="mt-7">

                @if(auth()->user()->role == 2)
                <a href="{{ route('quiz.show', $quiz->id) }}"
                    class="group/btn inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl text-white font-bold bg-gradient-to-r from-sky-600 to-blue-600 
                    shadow-lg shadow-rose-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    Details
                </a>
                @else



                @if($quiz->status == 'expired')
                <a href="{{ route('quiz.show', $quiz->id) }}"
                    class="group/btn inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl text-white font-bold bg-gradient-to-r from-rose-500 to-red-500 shadow-lg shadow-rose-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover/btn:scale-110 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12H9m12 0A9 9 0 1112 3a9 9 0 019 9z" />
                    </svg>
                    View Result
                </a>
                @elseif($quiz->alreadyAnswered)
                <a href="{{ route('quiz.show', $quiz->id) }}"
                    class="group/btn inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl text-white font-bold bg-gradient-to-r from-emerald-500 to-green-500 shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover/btn:scale-110 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    View Answers
                </a>
                @else
                <a href="{{ route('quiz.show', $quiz->id) }}"
                    class="group/btn inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl text-white font-bold bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-lg shadow-indigo-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover/btn:translate-x-1 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Start Quiz
                </a>
                @endif


                @endif
            </div>

        </div>
    </div>
    @endforeach
</div>


@endsection