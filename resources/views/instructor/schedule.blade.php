@extends('layout.ins')
@section('title','Schedule')
@section('page','Instructor Today and Weak Schedule Analysis.')
@section('content')


<div class="p-4 md:p-8">

    <!-- Hero Header -->
    <div class="mb-8">
        <div class="rounded-[28px] border border-white/70 bg-white/70 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] p-5 md:p-7">
            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">

                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 mb-4">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Teaching Dashboard
                    </div>

                    <h2 class="text-2xl md:text-4xl font-extrabold tracking-tight text-slate-800 leading-tight">
                        Teaching Schedule
                    </h2>
                    <p class="text-slate-500 mt-3 max-w-2xl text-sm md:text-base">
                        Manage your weekly classes, keep track of live sessions, and monitor upcoming lessons in one elegant dashboard.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full xl:w-auto">
                    <!-- Current Week -->
                    <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                            Current Week
                        </p>
                        <h4 class="font-bold text-slate-800 mt-2">
                            {{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M Y') }}
                        </h4>
                        <p class="text-xs text-slate-500 mt-1">
                            Weekly teaching overview
                        </p>
                    </div>

                    <!-- Total Classes -->
                    <div class="rounded-3xl bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">
                            Total Classes
                        </p>
                        <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                            {{ $schedules->count() }}
                        </h4>
                        <p class="text-xs text-slate-500 mt-1">
                            Classes in your schedule
                        </p>
                    </div>
                    <!-- Total Classes -->
                    <div class="rounded-3xl bg-gradient-to-br from-yellow-50 to-orange-50 border border-emerald-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300">
                        <p class="text-xs font-semibold uppercase tracking-wide text-pink-600">
                            Live
                        </p>
                        <h4 class="font-bold text-slate-800 mt-2 text-2xl">
                            {{ $data['ongoing_classes'] }}
                        </h4>
                        <p class="text-xs text-slate-500 mt-1">
                            Live Class Now
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Quick Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="group rounded-[26px] border border-white/70 bg-white/75 backdrop-blur-xl p-5 shadow-[0_10px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Today Upcoming Classes</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ $data['upcoming_classes'] }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-100 to-yellow-50 flex items-center justify-center text-2xl shadow-inner">
                    ⏳
                </div>
            </div>
            <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-amber-400 to-yellow-400 w-[70%] group-hover:w-[82%] transition-all duration-700"></div>
            </div>
        </div>
        <div class="group rounded-[26px] border border-white/70 bg-white/75 backdrop-blur-xl p-5 shadow-[0_10px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Today Completed</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ $data['completed_classes'] }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center text-2xl shadow-inner">
                    ✅
                </div>
            </div>
            <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-slate-400 to-slate-500 w-[55%] group-hover:w-[72%] transition-all duration-700"></div>
            </div>
        </div>

        <div class="group rounded-[26px] border border-white/70 bg-white/75 backdrop-blur-xl p-5 shadow-[0_10px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Weekly Load</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ $schedules->count() }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-100 to-fuchsia-50 flex items-center justify-center text-2xl shadow-inner">
                    📘
                </div>
            </div>
            <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-violet-400 to-fuchsia-400 w-[64%] group-hover:w-[88%] transition-all duration-700"></div>
            </div>
        </div>
    </div>

    @php
    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    $groupedSchedules = collect($days)->mapWithKeys(function ($day) use ($schedules) {
    return [$day => $schedules->where('day', $day)->values()];
    });

    $activeDay = collect($days)->first(function ($day) use ($groupedSchedules) {
    return $groupedSchedules[$day]->count() > 0;
    }) ?? 'Sunday';
    @endphp

    <div class="mt-8 rounded-[30px] border border-white/70 bg-white/75 backdrop-blur-xl shadow-[0_10px_40px_rgba(15,23,42,0.06)] overflow-hidden">
        <!-- Header -->
        <div class="px-5 md:px-7 py-5 border-b border-slate-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="font-bold text-xl md:text-2xl text-slate-800">
                        Weekly
                        <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                            Schedule
                        </span>
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Browse your classes day by day from Sunday to Saturday
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 px-3 py-1.5 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Live
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 text-amber-700 border border-amber-100 px-3 py-1.5 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Upcoming
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 text-slate-700 border border-slate-200 px-3 py-1.5 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        Completed
                    </span>
                </div>
            </div>
        </div>

        <!-- Day Nav -->
        <div class="px-4 md:px-6 pt-4 md:pt-5">
            <div class="overflow-x-auto pb-2">
                <div class="flex gap-2 min-w-max" id="scheduleDayTabs">
                    @foreach($days as $day)
                    @php $count = $groupedSchedules[$day]->count(); @endphp
                    <button
                        type="button"
                        class="schedule-tab group relative rounded-2xl border px-4 py-3 text-left transition-all duration-300
                            {{ $activeDay === $day
                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-transparent shadow-lg shadow-blue-200'
                                : 'bg-white text-slate-700 border-slate-200 hover:border-blue-200 hover:bg-blue-50/60' }}"
                        data-day="{{ $day }}">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">{{ $day }}</span>
                                <span class="text-[11px] {{ $activeDay === $day ? 'text-blue-100' : 'text-slate-500' }}">
                                    {{ $count }} class{{ $count == 1 ? '' : 'es' }}
                                </span>
                            </div>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Day Panels -->
        <div class="p-4 md:p-6">
            @foreach($days as $day)
            @php $daySchedules = $groupedSchedules[$day]; @endphp

            <div
                class="schedule-panel {{ $activeDay === $day ? '' : 'hidden' }}"
                data-day-panel="{{ $day }}">
                <!-- Day top summary -->
                <div class="mb-5 rounded-[24px] border border-slate-100 bg-gradient-to-r from-slate-50 to-white p-4 md:p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">
                                {{ $day }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $daySchedules->count() }} class{{ $daySchedules->count() == 1 ? '' : 'es' }} scheduled
                            </p>
                        </div>

                        <div class="inline-flex items-center gap-2 rounded-2xl bg-white border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 w-fit">
                            <span>📚</span>
                            {{ $daySchedules->count() }} Total
                        </div>
                    </div>
                </div>

                @if($daySchedules->count())
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 md:gap-5">
                    @foreach($daySchedules as $schedule)

                    <div class="group rounded-[26px] border border-slate-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">
                        <!-- top accent -->
                        <div class="h-1.5
                                    @if($schedule->end_time >= now()->timezone('Asia/Yangon')->format('H:i:s') && $schedule->start_time <= now()->timezone('Asia/Yangon')->format('H:i:s')) 
                                    bg-gradient-to-r from-green-400 to-teal-500
                                    @elseif($schedule->end_time > now()->timezone('Asia/Yangon')->format('H:i:s'))
                                     bg-gradient-to-r from-amber-400 to-orange-400
                                    @else
                                    bg-gradient-to-r from-slate-300 to-slate-400
                                    @endif
                                    ">
                        </div>

                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h4 class="text-lg md:text-xl font-bold text-slate-800 leading-snug">
                                        {{ $schedule->course->title }}
                                    </h4>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Teaching session
                                    </p>
                                </div>

                                @if($schedule->end_time >= now()->timezone('Asia/Yangon')->format('H:i:s') && $schedule->start_time <= now()->timezone('Asia/Yangon')->format('H:i:s'))
                                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Live
                                    </span>
                                    @elseif($schedule->start_time > now()->timezone('Asia/Yangon')->format('H:i:s'))
                                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-amber-50 border border-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Upcoming
                                    </span>
                                    @else
                                    <span class="shrink-0 inline-flex items-center gap-2 rounded-full bg-slate-100 border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-700">
                                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                        Completed
                                    </span>
                                    @endif
                            </div>

                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                                    <p class="text-[11px] uppercase tracking-wider text-slate-500 font-semibold">
                                        Time
                                    </p>
                                    <p class="text-sm md:text-base font-bold text-slate-800 mt-1">
                                        {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                    </p>
                                </div>

                                <!-- <div class="rounded-2xl bg-blue-50 border border-blue-100 px-4 py-3">
                                    <p class="text-[11px] uppercase tracking-wider text-blue-500 font-semibold">
                                        Room
                                    </p>
                                    <p class="text-sm md:text-base font-bold text-blue-700 mt-1 break-words">
                                        {{ $schedule->room_name }}
                                    </p>
                                </div> -->
                            </div>

                            <div class="mt-5 flex flex-wrap items-center gap-3">
                                <div class="inline-flex items-center gap-2 rounded-2xl bg-violet-50 border border-violet-100 px-3 py-2 text-sm font-medium text-violet-700">
                                    <span>📅</span>
                                    {{ $schedule->day }}
                                </div>

                                <div class="inline-flex items-center gap-2 rounded-2xl bg-slate-50 border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700">
                                    <span>🎓</span>
                                    Class Schedule
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50/70 p-8 md:p-12 text-center">
                    <div class="w-16 h-16 mx-auto rounded-3xl bg-white border border-slate-200 flex items-center justify-center text-3xl shadow-sm mb-4">
                        📅
                    </div>
                    <h4 class="text-lg md:text-xl font-bold text-slate-800">
                        No classes on {{ $day }}
                    </h4>
                    <p class="text-slate-500 mt-2 text-sm md:text-base">
                        There are no scheduled teaching sessions for this day.
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }


    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }

    // Weekly schedule day tabs
    const scheduleTabs = document.querySelectorAll('.schedule-tab');
    const schedulePanels = document.querySelectorAll('.schedule-panel');

    scheduleTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const day = this.dataset.day;

            // reset all tabs
            scheduleTabs.forEach(btn => {
                btn.classList.remove(
                    'bg-gradient-to-r',
                    'from-blue-600',
                    'to-indigo-600',
                    'text-white',
                    'border-transparent',
                    'shadow-lg',
                    'shadow-blue-200'
                );
                btn.classList.add(
                    'bg-white',
                    'text-slate-700',
                    'border-slate-200'
                );

                const sub = btn.querySelector('span.text-\\[11px\\]');
                if (sub) {
                    sub.classList.remove('text-blue-100');
                    sub.classList.add('text-slate-500');
                }
            });

            // active tab style
            this.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
            this.classList.add(
                'bg-gradient-to-r',
                'from-blue-600',
                'to-indigo-600',
                'text-white',
                'border-transparent',
                'shadow-lg',
                'shadow-blue-200'
            );

            const currentSub = this.querySelector('span.text-\\[11px\\]');
            if (currentSub) {
                currentSub.classList.remove('text-slate-500');
                currentSub.classList.add('text-blue-100');
            }

            // switch panel
            schedulePanels.forEach(panel => {
                panel.classList.add('hidden');
                if (panel.dataset.dayPanel === day) {
                    panel.classList.remove('hidden');
                }
            });
        });
    });
</script>
@endsection