@extends('layout.course_ins')

@section('title','Live Room')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-10 animate-fade-up">
        <div class="inline-flex items-center gap-2 
                        px-4 py-2 rounded-full
                        bg-indigo-100 text-indigo-600
                        text-sm font-semibold">
            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            Live Learning Room
        </div>
        <h1 class="mt-4 text-3xl sm:text-4xl 
                       font-black text-slate-800">
            Your Live Classes
        </h1>
        <p class="mt-3 text-slate-500 max-w-xl">
            Join interactive sessions with your instructor
            and learn together in real time.
        </p>
    </div>

    {{-- Sessions --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @forelse($sessions as $session)

        <div
            class="live-card group relative overflow-hidden
           rounded-[32px]
           bg-white/80 backdrop-blur-xl
           border border-white
           shadow-xl
           p-6 sm:p-8
           opacity-0
           animate-card-in"
            style="animation-delay: '{{ $loop->index * 200 }}'ms;">

            {{-- Glow --}}
            <div class="
                    absolute -top-16 -right-16
                    w-40 h-40
                    rounded-full
                    bg-indigo-200/40
                    blur-3xl
                    group-hover:scale-125
                    transition duration-500">
            </div>
            <div class="relative">

                {{-- Top --}}
                <div class="flex items-start justify-between gap-4">
                    <div
                        class="w-14 h-14
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-indigo-500
                                   to-blue-500
                                   text-white
                                   flex items-center justify-center
                                   shadow-lg
                                   group-hover:scale-110
                                   transition">

                        <i class="ri-live-line text-2xl"></i>
                    </div>
                    <span
                        class="inline-flex items-center gap-2
                                   px-3 py-1.5
                                   rounded-full
                                   bg-red-50
                                   text-red-600
                                   text-xs
                                   font-bold">

                        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>

                        LIVE

                    </span>
                </div>


                {{-- Content --}}
                <div class="mt-6">
                    <h2 class="
                            text-xl sm:text-2xl
                            font-extrabold
                            text-slate-800
                            line-clamp-2">

                        {{ $session->title }}

                    </h2>
                    <p class="
                            mt-3
                            text-sm
                            leading-6
                            text-slate-500
                            line-clamp-3">

                        {{ $session->description }}

                    </p>
                </div>

                {{-- Footer --}}
                <div class="mt-7 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <i class="ri-video-chat-line text-indigo-500 text-lg"></i>
                        Online Class
                    </div>
                    @if($session->status == 'live')
                    <a href="{{ route('courses.live.show',[$course,$session]) }}"
                        class="
                           inline-flex items-center gap-2
                           px-5 py-3
                           rounded-2xl
                           bg-gradient-to-r
                           from-indigo-600
                           to-blue-600
                           text-white
                           font-bold
                           text-sm
                           shadow-lg
                           shadow-indigo-200
                           hover:shadow-xl
                           hover:scale-105
                           transition-all duration-300">
                        Join
                        <i class="ri-arrow-right-line"></i>
                    </a>
                    @else
                    <p class="text-sm text-slate-600">Not Class</p>
                    @endif
                </div>
            </div>
        </div>

        @empty

        <div class="
                col-span-full
                bg-white/80
                backdrop-blur-xl
                rounded-3xl
                p-10
                text-center
                shadow-xl">

            <i class="ri-live-line text-5xl text-slate-300"></i>

            <h3 class="mt-4 text-xl font-bold text-slate-700">
                No Live Session
            </h3>

            <p class="text-slate-500 mt-2">
                Upcoming live classes will appear here.
            </p>

        </div>
        @endforelse
    </div>


</div>


<style>
    @keyframes card-in {

        from {
            opacity: 0;
            transform: translateY(50px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }


    .animate-card-in {

        animation-name: card-in;
        animation-duration: .7s;
        animation-timing-function: ease-out;
        animation-fill-mode: forwards;

    }
</style>


@endsection