@extends('layout.course_ins')

@section('title','Live Room')
@section('page','Instructor and learner Show Live Room')

@section('content')


<div class="max-w-6xl mx-auto px-4">

    <div
        class="backdrop-blur-3xl bg-white/60 border border-white/40 rounded-[35px] shadow-2xl overflow-hidden animate-fade">

        {{-- Header --}}
        <div
            class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 p-8">

            <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/20 rounded-full blur-3xl"></div>

            <div class="relative flex flex-col md:flex-row justify-between md:items-center gap-5">

                <div>

                    <h1 class="text-4xl font-black text-white">
                        {{ $session->title }}
                    </h1>

                    <p class="text-blue-100 mt-2">
                        {{ $session->room_name }}
                    </p>

                </div>

                @if($session->status=="live")

                <div
                    class="inline-flex items-center gap-3 bg-red-500/30 border border-red-300 px-5 py-3 rounded-full">

                    <span
                        class="w-3 h-3 bg-red-400 rounded-full animate-ping"></span>

                    <span class="text-white font-bold">
                        LIVE NOW
                    </span>

                </div>

                @else

                <div
                    class="bg-white/20 border border-white/30 px-5 py-3 rounded-full text-white font-bold">

                    {{ strtoupper($session->status) }}

                </div>

                @endif

            </div>

        </div>


        {{-- Body --}}
        <div class="p-6 md:p-10">

            {{-- Alert --}}
            @if(session('success'))
            <div
                class="mb-6 rounded-2xl bg-green-100 border border-green-300 p-4 text-green-700">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div
                class="mb-6 rounded-2xl bg-red-100 border border-red-300 p-4 text-red-700">
                {{ session('error') }}
            </div>
            @endif

            {{-- Grid --}}
            <div class="grid md:grid-cols-2 gap-6">

                <div
                    class="rounded-3xl bg-white/70 border border-white shadow-lg p-6 hover:-translate-y-1 transition duration-300">

                    <h2 class="font-bold text-xl mb-6">
                        Session Details
                    </h2>

                    <div class="space-y-5">

                        <div class="flex gap-4">

                            <i class="ri-live-line text-blue-600 text-2xl"></i>

                            <div>

                                <p class="text-gray-500">
                                    Room
                                </p>

                                <h3 class="font-bold">
                                    {{ $session->room_name }}
                                </h3>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <i class="ri-information-line text-indigo-600 text-2xl"></i>

                            <div>

                                <p class="text-gray-500">
                                    Description
                                </p>

                                <h3>
                                    {{ $session->description }}
                                </h3>

                            </div>

                        </div>
                        <div class="flex gap-4">

                            <i class="ri-settings-3-line text-green-600 text-2xl"></i>

                            <div>

                                <p class="text-gray-500">
                                    Recording
                                </p>

                                <h3>

                                    {{ $session->recording_enabled ? 'Enabled' : 'Disabled' }}

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Timeline --}}

                <div
                    class="rounded-3xl bg-white/70 border border-white shadow-lg p-6">

                    <h2 class="font-bold text-xl mb-6">
                        Timeline
                    </h2>

                    <div class="space-y-6">

                        <div class="flex gap-4">

                            <div
                                class="w-4 h-4 rounded-full bg-blue-500 mt-2"></div>

                            <div>

                                <p class="text-gray-500">
                                    Scheduled
                                </p>

                                {{ optional($session->scheduled_at)->format('d M Y h:i A') }}

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="w-4 h-4 rounded-full bg-green-500 mt-2"></div>

                            <div>

                                <p class="text-gray-500">
                                    Started
                                </p>

                                {{ optional($session->started_at)->format('d M Y h:i:s A') }}

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="w-4 h-4 rounded-full bg-red-500 mt-2"></div>

                            <div>

                                <p class="text-gray-500">
                                    Ended
                                </p>

                                {{ optional($session->ended_at)->format('d M Y h:i:s A') }}

                            </div>

                        </div>

                    </div>

                </div>

                <!-- participants  -->
                <div class="mt-10">

                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold">
                            Participants
                        </h2>

                        <span
                            class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">
                            {{ $session->participants->count() }} Joined
                        </span>
                    </div>

                    @forelse($session->participants as $participant)

                    <div
                        class="bg-white border rounded-3xl shadow-sm p-5 mb-4 hover:shadow-lg transition">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl">

                                    {{ strtoupper(substr($participant->user->name ?? 'U',0,1)) }}

                                </div>

                                <div>

                                    <h3 class="font-bold text-lg">
                                        {{ $participant->user->name ?? 'Unknown User' }}
                                    </h3>

                                    <p class="text-gray-500">
                                        {{ ucfirst($participant->role) }}
                                    </p>

                                </div>

                            </div>

                            <span
                                class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                {{ $participant->left_at ? 'Left' : 'Online' }}

                            </span>

                        </div>

                        <div
                            class="grid md:grid-cols-3 gap-4 mt-5 text-sm text-gray-600">

                            <div>

                                <p class="font-semibold">Joined At</p>

                                {{ optional($participant->joined_at)->format('d M Y h:i A') }}

                            </div>

                            <div>

                                <p class="font-semibold">Left At</p>

                                {{ optional($participant->left_at)->format('d M Y h:i A') ?? '-' }}

                            </div>

                            <div>

                                <p class="font-semibold">Duration</p>

                                {{ gmdate('H:i:s', $participant->duration_seconds ?? 0) }}

                            </div>

                        </div>

                    </div>

                    @empty

                    <div
                        class="rounded-3xl border-2 border-dashed border-gray-300 p-12 text-center bg-gray-50">

                        <i class="ri-group-line text-6xl text-gray-400"></i>

                        <h3 class="text-2xl font-bold mt-4">
                            No Participants Found
                        </h3>

                        <p class="text-gray-500 mt-2">
                            No one has joined this live session yet.
                        </p>

                    </div>

                    @endforelse

                </div>
            </div>


            {{-- Buttons --}}

            <div
                class="mt-10 flex flex-wrap justify-center md:justify-end gap-4">

                @if(auth()->user()->role == 2)
                @if($session->status!="live")

                <form action="{{ route('courses.live.start',[$course,$session]) }}"
                    method="POST">

                    @csrf

                    <button
                        class="px-7 py-2 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold shadow-xl hover:scale-105 transition">

                        <i class="ri-play-circle-fill"></i>

                        Start Session

                    </button>

                </form>

                @endif
                @endif


                @if($session->status=="live")

                <a href="{{ route('courses.live.join',[$course,$session]) }}"
                    class="px-7 py-2 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold shadow-xl hover:scale-105 transition">

                    <i class="ri-video-chat-fill"></i>

                    Join Session

                </a>
                @if(auth()->user()->role == 2)

                <form action="{{ route('courses.live.end',[$course,$session]) }}"
                    method="POST">

                    @csrf
                    <button
                        class="px-7 py-2 rounded-2xl bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold shadow-xl hover:scale-105 transition">

                        <i class="ri-stop-circle-fill"></i>

                        End Session

                    </button>

                </form>
                @endif

                @endif
                @if(auth()->user()->role == 2)

                <a href="{{ route('courses.live.edit',[$course,$session]) }}"
                    class="px-7 py-2 rounded-2xl bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold shadow-xl hover:scale-105 transition">

                    <i class="ri-edit-line"></i>

                    Edit

                </a>
                @endif

            </div>

        </div>

    </div>

</div>


<style>
    @keyframes fade {

        0% {

            opacity: 0;

            transform: translateY(30px);

        }

        100% {

            opacity: 1;

            transform: translateY(0);

        }

    }

    .animate-fade {

        animation: fade .7s ease;

    }
</style>

@endsection