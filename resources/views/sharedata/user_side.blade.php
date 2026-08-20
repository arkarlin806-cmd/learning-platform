<aside id="sidebar"
    class="fixed lg:relative z-50
        w-72 h-screen
         backdrop-blur-lg bg-white/95 dark:bg-slate-900
        shadow-2xl
        transition-all duration-300
        -translate-x-full lg:translate-x-0
        sidebar-animation">

    <!-- Logo -->
    <div
        class="h-20 flex items-center justify-between px-6 border-b">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                    bg-blue-700 dark:text-blue-800 dark:bg-white
                    text-white
                    flex items-center justify-center
                    font-bold text-xl">
                L
            </div>

            <div id="logoText">

                <h2 data-en="Learner"
                    data-mm="သင်ကြားးသူ" class="font-bold text-lg dark:text-white">
                    Learner
                </h2>

                <p class="text-xs text-gray-500 dark:text-white/70">
                    <a href="{{ route('home.index') }}">Learning Platform</a>
                </p>

            </div>

        </div>

        <button id="collapseBtn"
            class="hidden lg:block text-xl dark:text-white">
            ◀
        </button>

        <button id="closeSidebar"
            class="lg:hidden text-2xl">
            ✕
        </button>

    </div>
    <!-- Menu -->
    <nav class="p-4 space-y-2">

        <a href="{{ route('profile.index') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-home-4-line text-lg"></i>
            <span data-en="Dashboard"
                data-mm="မူလစာမျက်နှာ" class="menu-text">Dashboard</span>

        </a>


        <hr class="text-indigo-200">


        <a href="{{ route('profile.schedule') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-calendar-check-line text-lg"></i>
            <span data-en="Schedule"
                data-mm="အချိန်ဇယား" class="menu-text">Schedule</span>

        </a>
        <hr class="text-indigo-200">

        <a href="{{ route('profile.request') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-list-ordered text-lg"></i>
            <span data-en="Request"
                data-mm="တောင်းဆိုမှု့များ" class="menu-text">Request</span>

        </a>
        <hr class="text-indigo-200">

        <a href="{{ route('learner.roadmaps.index') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-road-map-line text-lg"></i>
            <span data-en="Roadmap"
                data-mm="ရည်ရွယ်ချက်" class="menu-text">Roadmap</span>

        </a>
        <hr class="text-indigo-200">

        <a href="{{ route('contact.inbox') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-contacts-line text-lg"></i>
            <span data-en="Contact"
                data-mm="ဆက်သွယ်ရန်" class="menu-text">Contact</span>

        </a>
        <hr class="text-indigo-200">
        <a href="{{ route('notification') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-contacts-line text-lg"></i>
            <span data-en="Notification"
                data-mm="သတိပေးစာများ" class="menu-text">Notification</span>
            @php
            $unreadNotifications = auth()->user()
            ->unreadNotifications;
            @endphp
            <span
                id="notificationCount"
                class="
                       
                        min-w-[18px]
                        h-[18px]
                        px-1
                        rounded-full
                        bg-red-500
                        text-white
                        text-[10px]
                        font-bold
                        flex
                        items-center
                        justify-center">
                {{ $unreadNotifications->count() }}
            </span>

        </a>
        <hr class="text-indigo-200">


        <a href="{{ route('settings.index') }}"
            class="menu-item flex items-center gap-4 dark:text-white
                px-4 py-3 rounded-2xl
                hover:bg-indigo-100 hover:text-blue-800
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-settings-3-line text-lg"></i>
            <span data-en="Settings"
                data-mm="စက်တင်" class="menu-text">Settings</span>

        </a>
    </nav>



</aside>