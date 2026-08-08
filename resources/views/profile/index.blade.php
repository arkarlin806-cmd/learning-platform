@extends('layout.user')

@section('title','Profile')
@section('page','Learner Profile And Analysis Learning.')
@section('content')

<div class="relative z-10 space-y-8">

    <!-- HERO GLASS -->
    <div class="backdrop-blur-xl bg-white/40 dark:bg-slate-100/5 border border-white/30 dark:border-slate-700 rounded-3xl p-6 md:p-10 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <!-- AVATAR -->
            <div class="w-20 h-20 md:w-24 md:h-24 rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-2xl font-bold shadow-lg">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl md:text-4xl font-bold text-gray-800 dark:text-white">
                    {{ $user->name }}
                </h1>
                <p class="text-gray-600 text-sm mt-1 dark:text-white/70">
                    Learner Learning Dashboard •
                </p>
                <!-- XP BAR -->
                <div class="w-56 md:w-80 h-2 bg-white/40 rounded-full mt-3 overflow-hidden border border-white/30">
                    <div class="h-2 bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-700"></div>
                </div>

            </div>

        </div>

        <button class="px-6 py-3 rounded-2xl bg-white/60 backdrop-blur-xl border border-white/40 text-blue-600 font-semibold hover:scale-105 transition shadow-md">
            Continue Learning
        </button>

    </div>


    <!-- statics  -->
    <div class="grid md:grid-cols-4 gap-5 mt-8">
        <div class="stat-card opacity-0 animate-stat-in rounded-3xl bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100
                dark:from-slate-100/8 dark:to-slate-100/8 dark:border-slate-700
                px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300"
            style="animation-delay:0ms">
            <div class=" flex justify-between">
                <div class="">
                    <p data-en="Courses" data-mm="ဘာသာရပ်များ"
                        class="text-xs font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-300">
                        Courses
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl dark:text-white">
                        {{ $enrolledCourses }}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center">

                    <i class="ri-book-3-line text-xl"></i>

                </div>
            </div>
            <p data-en="Total Courses" data-mm="စုစုပေါင်း ဘာသာရပ်များ" class="text-xs text-slate-500 mt-1 dark:text-white/70">
                Total Courses
            </p>
        </div>
        <div class="stat-card opacity-0 animate-stat-in rounded-3xl bg-gradient-to-br from-yellow-50 to-orange-50 border 
                dark:from-slate-100/8 dark:to-slate-100/8 dark:border-slate-700
                border-yellow-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300"
            style="animation-delay:150ms">
            <div class="flex justify-between">
                <div class="">
                    <p data-en="Completed" data-mm="ပြီးမြောက်မှု့" class="text-xs font-semibold uppercase tracking-wide text-orange-600">
                        Completed
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl dark:text-white">
                        {{$completedCourses}}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center">

                    <i class="ri-check-double-fill text-xl"></i>
                </div>
            </div>
            <p data-en="Total Completed" data-mm="စုစုပေါင်း ပြီးမြောက်မှု့" class="text-xs text-slate-500 mt-1 dark:text-white/70">
                Total Completed
            </p>
        </div>
        <div class="stat-card opacity-0 animate-stat-in rounded-3xl bg-gradient-to-br from-pink-200 to-red-100 border 
                    dark:from-slate-100/8 dark:to-slate-100/8 dark:border-slate-700
                    border-pink-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300"
            style="animation-delay:300ms">
            <div class="flex justify-between">
                <div class="">
                    <p data-en="Class" data-mm="သင်တန်း" class="text-xs font-semibold uppercase tracking-wide text-pink-600">
                        Class
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl dark:text-white">
                        {{ $scheduleCount }}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-pink-500 text-white flex items-center justify-center">

                    <i class="ri-24-hours-line text-xl"></i>

                </div>
            </div>
            <p data-en="Total Class (weekly)" data-mm="စုစုပေါင်း သင်တန်း" class="text-xs text-slate-500 mt-1 dark:text-white/70">
                Total Class (weekly)
            </p>
        </div>
        <div class="stat-card opacity-0 animate-stat-in rounded-3xl bg-gradient-to-br from-slate-200 to-slate-100 border 
                    dark:from-slate-100/8 dark:to-slate-100/8 dark:border-slate-700
                    border-slate-100 px-5 py-4 shadow-sm hover:-translate-y-1 transition duration-300"
            style="animation-delay:450ms">
            <div class="flex justify-between">
                <div class="">
                    <p data-en="Certificates" data-mm="လက်မှတ်" class="text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-white">
                        Certificates
                    </p>
                    <h4 class="font-bold text-slate-800 mt-2 text-2xl dark:text-white">
                        {{$certificates ?? 0}}
                    </h4>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-slate-500 text-white flex items-center justify-center">

                    <i class="ri-sparkling-2-line text-xl"></i>

                </div>
            </div>
            <p data-en="My Certificates" data-mm="စုစုပေါင်း လက်မှတ်" class="text-xs text-slate-500 mt-1 dark:text-white/70">
                My Certificates
            </p>
        </div>
    </div>


    <div class="grid lg:grid-cols-3 gap-6">

        <!-- CONTINUE LEARNING -->
        <div class="lg:col-span-2 backdrop-blur-xl bg-white/40 dark:bg-slate-100/8 dark:border-slate-700 border border-white/30 rounded-3xl p-6 shadow-md stat-card opacity-0 animate-stat-in" style="animation-delay:600ms">

            <h2 data-en="Continue Learning" data-mm="ဆက်လက်သင်ကြားရန်" class="text-lg font-bold text-slate-700 mb-5 dark:text-white">
                Continue Learning
            </h2>

            <div class="space-y-4">

                @foreach($Courses as $c)

                <div class="flex items-center gap-4 p-4 rounded-3xl bg-white/30 border border-slate-300  dark:bg-slate-100/20 dark:border-slate-500
                    hover:border-indigo-200 hover:shadow-lg transition duration-300">

                    <img src="{{ asset('storage/' . $c->course->thumbnail) }}"
                        class="w-20 h-16 object-cover rounded-xl shadow-md">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 dark:text-white">
                            {{ $c->course->title }}
                        </h3>
                    </div>
                    <a href="{{ route('instructor.single_course', $c->course->id) }}"
                        class="px-4 py-2 rounded-xl bg-white/60 border border-white/40 text-blue-600 text-sm font-semibold hover:scale-105 transition">
                        learn
                    </a>

                </div>

                @endforeach

            </div>

        </div>


        <!-- RIGHT SIDEBAR -->
        <div class="space-y-6">

            <!-- STREAK GLASS -->
            <div class="backdrop-blur-xl bg-white/40 dark:bg-white/20 border border-white/30 dark:bg-slate-100/50 dark:border-slate-700 rounded-3xl p-6 text-center shadow-xl stat-card opacity-0 animate-stat-in" style="animation-delay:750ms">
                <div class="text-5xl">🔥</div>
                <h2 class="text-3xl font-bold text-gray-800 mt-2 dark:text-white">{{ $streak }}</h2>
                <p class="text-gray-600 text-sm dark:text-white/80">Day Streak</p>
            </div>





            <!-- UPGRADE CARD -->
            <div class="backdrop-blur-xl bg-gradient-to-br from-blue-500/80 to-indigo-600/80 rounded-3xl p-6 text-white shadow-xl">
                <h3 class="font-bold text-lg" data-en="Edit Notification" data-mm="သတိပေးစာများပို့ခြင်း ပြင်ရန်">Edit Notification</h3>
                <p class="text-white/80 text-sm mt-1" data-en="Your email send Notification before 3 Minutes class schedule" data-mm="သင့်ရဲ့ မေးလ် ဆီသို့သင်တန်းချိန် ၃ မိနစ် မတိုင်မှီ သတိပေးစာပို့မည်။">
                    Your email send Notification before 3 Minutes class schedule
                </p>
                <div class="flex mt-3 gap-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            id="notifyToggle"
                            class="sr-only peer"
                            {{ auth()->user()->email_schedule_notification ? 'checked' : '' }}>

                        <div class="w-14 h-8 rounded-full bg-slate-800 peer-checked:bg-blue-800 transition"></div>

                        <div class="absolute w-6 h-6 bg-white rounded-full mt-1 ml-1 peer-checked:translate-x-6 transition"></div>
                    </label>

                    <span id="notifyText" class="mt-1">
                        {{ auth()->user()->email_schedule_notification
        ? 'Reminder Enabled'
        : 'Reminder Disabled' }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>


<script>
    const toggle = document.getElementById("notifyToggle");

    toggle.addEventListener("change", function() {

        fetch("{{ route('notification.toggle') }}", {

                method: "POST",

                headers: {

                    "Content-Type": "application/json",

                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .content

                },

                body: JSON.stringify({

                    status: toggle.checked ? 1 : 0

                })

            })
            .then(res => res.json())
            .then(data => {

                document.getElementById("notifyText").innerHTML =
                    data.status ?
                    "Reminder Enabled" :
                    "Reminder Disabled";

            });

    });
</script>
@endsection