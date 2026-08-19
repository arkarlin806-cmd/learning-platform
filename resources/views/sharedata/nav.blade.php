<!-- NAVBAR -->
<nav class="bg-white dark:bg-slate-900 backdrop-blur-lg shadow-md sticky top-0 z-50 border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex justify-between items-center h-16 relative">

            <div class="absolute top-0 left-0 h-full w-[380px] pointer-events-none -z-0">
                <svg class="w-full h-full" viewBox="0 0 380 70" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Light outer wave -->
                    <path d="M 0 0 L 220 0 C 240 0, 250 70, 310 70 L 0 70 Z" fill="url(#wave-light)" />
                    <!-- Darker inner wave -->
                    <path d="M 0 0 L 170 0 C 210 0, 210 70, 250 70 L 0 70 Z" fill="url(#wave-main)" />

                    <defs>
                        <linearGradient id="wave-light" x1="0" y1="0" x2="100" y2="70" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.6" />
                            <stop offset="1" stop-color="#ff00ff" stop-opacity="1" />
                        </linearGradient>
                        <linearGradient id="wave-main" x1="0" y1="0" x2="" y2="70" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="1" />
                            <!-- D8B4FE -->
                            <stop offset="1" stop-color="white" stop-opacity="0.65" />
                            <!-- C4B5FD -->
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <!-- 1. Logo Section -->
            <div class="flex items-center space-x-3.5 z-10 pl-2">
                <!-- EnviroStruct Wave Logo SVG -->
                <div class="flex items-center gap-3 cursor-pointer group">

                    <div class="w-11 h-11 rounded-2xl bg-blue-600 flex items-center justify-center
                                group-hover:rotate-12 transition duration-500">

                        <i class="ri-graduation-cap-fill text-white text-2xl"></i>

                    </div>

                    <div>
                        <h1 class="text-2xl font-black text-gray-800">
                            LearnX
                        </h1>

                        <p class="text-xs text-gray-500 -mt-1">
                            Modern Learning Platform
                        </p>
                    </div>

                </div>
            </div>
            <!-- DESKTOP MENU -->
            <div class="hidden lg:flex items-center gap-10">

                <a href="{{ route('home.index') }}"
                    data-en="Home"
                    data-mm="ပင်မစာမျက်နှာ"
                    class="text-gray-700 dark:text-white hover:text-blue-600
                    transition duration-300 relative after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[2px] after:bg-blue-600 hover:after:w-full
                    after:transition-all after:duration-300">
                    Home
                </a>

                <a href="{{ route('courses.index') }}"
                    data-en="Courses"
                    data-mm="သင်ခန်းစာများ"
                    class="text-gray-700 dark:text-white hover:text-blue-600
                              transition duration-300 relative after:absolute after:left-0 after:-bottom-1
                              after:w-0 after:h-[2px] after:bg-blue-600 hover:after:w-full
                              after:transition-all after:duration-300">
                    Courses
                </a>

                <a href="{{ route('instructors.all_ins') }}"
                    data-en="Instructors"
                    data-mm="ဆရာများ"
                    class="text-gray-700 dark:text-white hover:text-blue-600
                              transition duration-300 relative after:absolute after:left-0 after:-bottom-1
                              after:w-0 after:h-[2px] after:bg-blue-600 hover:after:w-full
                              after:transition-all after:duration-300">
                    Instructors
                </a>

                <a href="{{ route('about') }}"
                    data-en="About"
                    data-mm="အကြောင်းအရာ"
                    class="text-gray-700 dark:text-white hover:text-blue-600
                              transition duration-300 relative after:absolute after:left-0 after:-bottom-1
                              after:w-0 after:h-[2px] after:bg-blue-600 hover:after:w-full
                              after:transition-all after:duration-300">
                    About
                </a>
                <a href="{{ route('chat.index') }}"
                    data-en="Free Course"
                    data-mm="Free Course"
                    class="text-gray-700 dark:text-white hover:text-blue-600
                              transition duration-300 relative after:absolute after:left-0 after:-bottom-1
                              after:w-0 after:h-[2px] after:bg-blue-600 hover:after:w-full
                              after:transition-all after:duration-300">
                    Free Course
                </a>

            </div>

            <!-- RIGHT BUTTONS -->
            <div class="hidden lg:flex items-center gap-4">
                <div class="flex items-center gap-5 text-slate-700 dark:text-white">

                    <select onchange="setLanguage(this.value)">

                        <option value="en" class="text-slate-700 dark:text-white">
                            English
                        </option>


                        <option value="mm" class="text-slate-700 dark:text-white">
                            မြန်မာ
                        </option>


                    </select>
                    <div class="relative">

                        <button
                            class="flex items-center gap-3">
                        </button>
                        <a href="{{ route('profile.index') }}">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="" class="rounded-full h-11 w-11 bg-blue-500 text-white">
                        </a>

                    </div>

                </div>


            </div>
            <!-- MOBILE BUTTON -->
            <button id="menu-btn"
                class="lg:hidden text-3xl text-gray-700">

                <i class="ri-menu-3-line"></i>

            </button>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu"
        class="hidden lg:hidden bg-white dark:bg-slate-900 border-t border-gray-200">

        <div class="flex flex-col px-6 py-5 gap-5">

            <a href="{{ route('home.index') }}"
                data-en="Home"
                data-mm="ပင်မစာမျက်နှာ"
                class="text-gray-700 dark:text-white hover:text-blue-600 transition">
                Home
            </a>

            <a href="{{ route('courses.index') }}"
                data-en="Courses"
                data-mm="သင်ခန်းစာများ"
                class="text-gray-700 dark:text-white hover:text-blue-600 transition">
                Courses
            </a>

            <a href="{{ route('instructors.all_ins') }}"
                data-en="Instructors"
                data-mm="ဆရာများ"
                class="text-gray-700 dark:text-white hover:text-blue-600 transition">
                Instructors
            </a>

            <a href="{{ route('about') }}"
                data-en="About"
                data-mm="အကြောင်းအရာ"
                class="text-gray-700 dark:text-white hover:text-blue-600 transition">
                About
            </a>
            <a href="{{ route('chat.index') }}"
                data-en="Free Courses"
                data-mm="Free Courses"
                class="text-gray-700 dark:text-white hover:text-blue-600 transition">
                Free Courses
            </a>

            <a href="{{ route('profile.index') }}">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="" class="rounded-full h-11 w-11 bg-blue-500 text-white">
            </a>
        </div>

    </div>

</nav>



<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {

        mobileMenu.classList.toggle('hidden');

    });
</script>