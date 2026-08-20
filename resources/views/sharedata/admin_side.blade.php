<aside id="sidebar"
    class="fixed lg:relative z-50
        w-72 h-screen
        bg-white
        backdrop-blur-lg
        overflow-y-auto
        transition-all duration-300
        -translate-x-full lg:translate-x-0
        sidebar-animation">

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
                    Admin
                </h2>

                <p class="text-xs text-gray-500">
                    AI Power Learning Platform
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
    <nav class="p-4 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-home-4-line text-lg"></i>
            <span class="menu-text">Dashboard</span>

        </a>
        <hr class="text-sky-200">

        <a href="{{ route('admin.users') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-team-line text-lg"></i>
            <span class="menu-text">Users</span>

        </a>
        <hr class="text-sky-200">


        <div onclick="toggleSidebarDropdown('courseMenu',this)"
            class="menu-item flex items-center gap-4
                px-4 py-2 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2 flex justify-between
                transition-all duration-300">
            <div class="">

                <i class="ri-group-line text-lg"></i>
                <span class="menu-text">Instructor</span>
            </div>
            <i class="ri-arrow-down-s-line text-xl transition-transform duration-300 font-bold text-blue-800"></i>
        </div>


        <div
            id="courseMenu"
            class="grid grid-rows-[0fr] transition-all duration-500 overflow-hidden">

            <div class="overflow-hidden">

                <div class="ml-4 mt-2 space-y-2 border-l border-slate-200 pl-4">

                    <a href="{{ route('admin.instructors') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                        <i class="ri-group-line text-blue-700"></i>

                        <span>Instructors</span>

                    </a>

                    <a href="{{ route('instructor.requests.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                        <i class="ri-git-pr-draft-line text-blue-700"></i>
                        <span>Request</span>

                    </a>
                    <a href="{{ route('admin.withdraw.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                        <i class="ri-hand-coin-line text-blue-700"></i>

                        <span>Withdraw</span>

                    </a>


                </div>

            </div>

        </div>

        <hr class="text-sky-200">

        <a href="{{ route('admin.earnings') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-cash-line text-lg"></i>
            <span class="menu-text">Earnings</span>

        </a>
        <hr class="text-sky-200">
        <a href="{{ route('admin.roadmaps.index') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-road-map-line text-lg"></i>
            <span class="menu-text">Roadmap</span>

        </a>
        <hr class="text-sky-200">

        <a href="{{ route('course.order') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-shopping-cart-line text-lg"></i>
            <span class="menu-text">Course Orders</span>

        </a>
        <hr class="text-sky-200">
        <a href="{{ route('admin.certificate.frames.index') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-trophy-line text-lg"></i>
            <span class="menu-text">Certificates</span>

        </a>
        <hr class="text-sky-200">
        <a href="{{ route('admin.certificates.learners') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-trophy-line text-lg"></i>
            <span class="menu-text">Certificate Learners</span>

        </a>
        <hr class="text-sky-200">



        <a href="{{ route('contact.inbox') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-mail-check-line text-lg"></i>
            <span class="menu-text">Contacts</span>

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
        <hr class="text-sky-200">

        <a href="{{ route('settings.index') }}"
            class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

            <i class="ri-settings-4-line text-lg"></i>
            <span class="menu-text">Settings</span>

        </a>

    </nav>

</aside>