@php
$side = [
['name' => 'Dashboard', 'route' => 'instructor.index', 'icon' => 'ri-home-4-line','mya' =>' မူလ' ],
['name' => 'Create Course', 'route' => 'course.create', 'icon' => 'ri-add-line','mya' => 'ဘာသာရပ် ဖန်တီးရန်' ],
['name' => 'Schedule', 'route' => 'instructor.schedule', 'icon' => 'ri-calendar-check-line','mya' => 'အချိန်ဇယား' ],
['name' => 'Earnings', 'route' => 'instructor.earnings', 'icon' => 'ri-cash-line','mya' => 'ဝင်ငွေ' ],
['name' => 'Withdraw', 'route' => 'instructor.withdraw', 'icon' => 'ri-git-pull-request-line','mya' => 'ငွေထုပ်မှတ်တမ်း' ],
['name' => 'Contact', 'route' => 'contact.inbox', 'icon' => 'ri-contacts-line','mya' => 'ဆက်သွယ်ရန်' ],
['name' => 'Setting', 'route' => 'settings.index', 'icon' => 'ri-settings-3-line','mya' => 'စက်တင်' ],

];
@endphp
<!-- Sidebar -->
<aside id="sidebar"
    class="fixed lg:relative z-50 w-72 h-screen  bg-white/95 backdrop-blur-lg shadow-2xl transition-all duration-300
                  -translate-x-full lg:translate-x-0 sidebar-animation">

    <!-- Logo -->
    <div
        class="h-20 flex items-center justify-between px-6 border-b">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                    bg-indigo-600
                    text-white
                    flex items-center justify-center
                    font-bold text-xl">
                I
            </div>

            <div id="logoText">

                <h2 class="font-bold text-lg">
                    Instructor
                </h2>

                <p class="text-xs text-gray-500">
                    Learning Platform
                </p>

            </div>

        </div>

        <button id="collapseBtn"
            class="hidden lg:block text-xl">
            ◀
        </button>

        <button id="closeSidebar"
            class="lg:hidden text-2xl">
            ✕
        </button>

    </div>

    <!-- Menu -->
    <nav class="p-4 space-y-1">

        @foreach ($side as $s)

        <a href="{{ route($s['route']) }}"
            class="menu-item flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-indigo-50 hover:translate-x-2 transition-all duration-300">
            <i class="{{ $s['icon'] }} text-xl text-slate-700"></i>
            <span class="menu-text text-slate-700" data-en="{{ $s['name'] }}" data-mm="{{ $s['mya'] }}">{{ $s['name'] }}</span>

        </a>

        <hr class="text-sky-200">
        @endforeach
    </nav>

</aside>