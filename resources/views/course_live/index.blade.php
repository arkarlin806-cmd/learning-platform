@extends('layout.course_ins')
@section("title","Live Room")
@section("page","Instructor and Learner Group Live Room")
@section('content')
<div class="max-w-7xl mx-auto md:px-4">
    {{-- Header --}}
    <div class="relative overflow-hidden rounded-3xl bg-white/70 backdrop-blur-xl border border-white/40 shadow-[0_20px_60px_rgba(15,23,42,0.08)] p-5 sm:p-6 lg:p-8 mb-6">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-purple-500/10"></div>
        <div class="absolute -top-16 -right-16 h-40 w-40 rounded-full bg-blue-400/20 blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 h-40 w-40 rounded-full bg-indigo-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-blue-100 text-blue-700 px-3 py-1 text-xs sm:text-sm font-semibold mb-3 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Live Classroom
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-slate-900 leading-tight">
                    Live Sessions
                </h1>

                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    {{ $course->title ?? ('Course #' . $course->id) }}
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('courses.live.create', $course) }}"
                    class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-5 py-3 text-sm sm:text-base font-semibold text-white shadow-lg shadow-blue-500/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/30">
                    <svg class="h-5 w-5 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Live Session
                </a>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 shadow-sm animate-[fadeIn_.4s_ease-out]">
        <div class="flex items-start gap-3">
            <div class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100">
                <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-sm sm:text-base">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm animate-[fadeIn_.4s_ease-out]">
        <div class="flex items-start gap-3">
            <div class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-100">
                <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <p class="text-sm sm:text-base">{{ session('error') }}</p>
        </div>
    </div>
    @endif
    @php
    $totalSessions = $sessions->count();
    $liveSessions = $sessions->where('status', 'live')->count();
    $scheduledSessions = $sessions->where('status', 'scheduled')->count();
    $endedSessions = $sessions->where('status', 'ended')->count();
    @endphp

    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <div class="group relative overflow-hidden rounded-3xl bg-white/75 backdrop-blur-xl border border-white/40 p-4 sm:p-5 shadow-[0_10px_40px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(15,23,42,0.10)]">
            <div class="absolute top-0 right-0 h-24 w-24 rounded-full bg-blue-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Total Sessions</p>
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900">{{ $totalSessions }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-3xl bg-white/75 backdrop-blur-xl border border-white/40 p-4 sm:p-5 shadow-[0_10px_40px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(15,23,42,0.10)]">
            <div class="absolute top-0 right-0 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Live Now</p>
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-emerald-600">{{ $liveSessions }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <span class="relative flex h-4 w-4">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-3xl bg-white/75 backdrop-blur-xl border border-white/40 p-4 sm:p-5 shadow-[0_10px_40px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(15,23,42,0.10)]">
            <div class="absolute top-0 right-0 h-24 w-24 rounded-full bg-amber-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Scheduled</p>
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-amber-600">{{ $scheduledSessions }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-3xl bg-white/75 backdrop-blur-xl border border-white/40 p-4 sm:p-5 shadow-[0_10px_40px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(15,23,42,0.10)]">
            <div class="absolute top-0 right-0 h-24 w-24 rounded-full bg-rose-500/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Ended</p>
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-rose-600">{{ $endedSessions }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden lg:block overflow-hidden rounded-3xl bg-white/75 backdrop-blur-xl border border-white/40 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-900/[0.03]">
                    <tr class="text-slate-700">
                        <th class="px-6 py-4 text-left text-sm font-bold">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Room</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Schedule</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/70">
                    @forelse($sessions as $session)
                    <tr class="group transition-all duration-300 hover:bg-slate-50/70">
                        <td class="px-6 py-5">
                            <div class="font-bold text-slate-900">{{ $session->title }}</div>
                            <div class="text-xs text-slate-500 mt-1">Session ID #{{ $session->id }}</div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700">
                                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 11h12M9 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                </svg>
                                {{ $session->room_name }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            @if($session->status === 'live')
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                </span>
                                Live
                            </span>
                            @elseif($session->status === 'scheduled')
                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-sm font-semibold text-amber-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Scheduled
                            </span>
                            @elseif($session->status === 'ended')
                            <span class="inline-flex items-center gap-2 rounded-full bg-rose-100 px-3 py-1.5 text-sm font-semibold text-rose-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Ended
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-700">
                                {{ ucfirst($session->status) }}
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <div class="text-sm font-semibold text-slate-800">
                                {{ optional($session->scheduled_at)->format('Y-m-d') ?: '-' }}
                            </div>
                            <div class="text-xs text-slate-500 mt-1">
                                {{ optional($session->scheduled_at)->format('H:i') ?: 'No schedule' }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex flex-wrap items-center gap-2">

                                <a href="{{ route('courses.live.show', [$course, $session]) }}"
                                    class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:text-blue-600">
                                    View
                                </a>

                                <a href="{{ route('courses.live.edit', [$course, $session]) }}"
                                    class="inline-flex items-center rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                                    Edit
                                </a>

                                @if($session->status !== 'live')
                                <form action="{{ route('courses.live.start', [$course, $session]) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center rounded-xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-md shadow-emerald-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-emerald-700">
                                        Start
                                    </button>
                                </form>
                                @endif

                                @if($session->status === 'live')
                                <a href="{{ route('courses.live.join', [$course, $session]) }}"
                                    class="inline-flex items-center rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-700">
                                    Join
                                </a>

                                <form action="{{ route('courses.live.end', [$course, $session]) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center rounded-xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-md shadow-rose-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-rose-700">
                                        End
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('courses.live.destroy', [$course, $session]) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Delete this session?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-red-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-slate-400">
                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800">No live sessions found</h3>
                                <p class="mt-2 text-slate-500">Create your first live session to start teaching in real time.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile / Tablet Cards --}}
    <div class="lg:hidden space-y-4">
        @forelse($sessions as $session)
        <div class="group relative overflow-hidden rounded-3xl bg-white/80 backdrop-blur-xl border border-white/40 shadow-[0_12px_40px_rgba(15,23,42,0.08)] p-4 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-0 right-0 h-24 w-24 rounded-full bg-indigo-500/10 blur-2xl"></div>

            <div class="relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h3 class="text-lg font-black text-slate-900 truncate">{{ $session->title }}</h3>
                        <p class="mt-1 text-sm text-slate-500 break-all">{{ $session->room_name }}</p>
                    </div>

                    <div class="shrink-0">
                        @if($session->status === 'live')
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                            </span>
                            Live
                        </span>
                        @elseif($session->status === 'scheduled')
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">
                            Scheduled
                        </span>
                        @elseif($session->status === 'ended')
                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700">
                            Ended
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">
                            {{ ucfirst($session->status) }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Schedule Date</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ optional($session->scheduled_at)->format('Y-m-d') ?: '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Schedule Time</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ optional($session->scheduled_at)->format('H:i') ?: 'No schedule' }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('courses.live.show', [$course, $session]) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm">
                        View
                    </a>

                    <a href="{{ route('courses.live.edit', [$course, $session]) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 shadow-sm">
                        Edit
                    </a>

                    @if($session->status !== 'live')
                    <form action="{{ route('courses.live.start', [$course, $session]) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-md">
                            Start
                        </button>
                    </form>
                    @endif

                    @if($session->status === 'live')
                    <a href="{{ route('courses.live.join', [$course, $session]) }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-md">
                        Join
                    </a>

                    <form action="{{ route('courses.live.end', [$course, $session]) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-md">
                            End
                        </button>
                    </form>
                    @endif

                    <form action="{{ route('courses.live.destroy', [$course, $session]) }}"
                        method="POST"
                        class="inline"
                        onsubmit="return confirm('Delete this session?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-700 shadow-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="rounded-3xl bg-white/80 backdrop-blur-xl border border-white/40 shadow-[0_12px_40px_rgba(15,23,42,0.08)] p-8 text-center">
            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-slate-400">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800">No live sessions found</h3>
            <p class="mt-2 text-slate-500">Create your first live session to get started.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-16">
        {{ $sessions->links() }}
    </div>

</div>
@endsection