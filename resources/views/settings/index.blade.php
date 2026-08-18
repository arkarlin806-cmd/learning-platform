<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {

            width: 1px;
            height: 4px;

        }

        ::-webkit-scrollbar-track {

            background: #eef2ff;
            border-radius: 20px;

        }

        ::-webkit-scrollbar-thumb {

            background: linear-gradient(180deg,
                    #3b82f6,
                    #6366f1,
                    #10b981);

            border-radius: 20px;

        }

        ::-webkit-scrollbar-thumb:hover {

            background: linear-gradient(180deg,
                    #2563eb,
                    #4f46e5,
                    #059669);

        }
    </style>

</head>

<body class="overflow-x-hidden">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>

        <!-- Sidebar -->
        @if(auth()->user()->role == 1)
        @include('sharedata.admin_side')


        @elseif(auth()->user()->role == 0)
        @include('sharedata.user_side')

        @else
        @include('sharedata.ins_side')
        @endif

        <!-- mani content  -->
        <div class="h-screen flex-1 overflow-y-auto">

            <!-- Topbar -->
            <header
                class="h-20 bg-white shadow-sm
                        flex items-center justify-between
                        px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-3xl">

                        ☰

                    </button>
                    <div class="">
                        <h1 class="text-slate-700 text-2xl font-extrabold">
                            Settings
                        </h1>
                        <p class="text-slate-500 text-sm">Edit Profile and Password</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">

                    <button class="relative">

                        <i class="ri-notification-2-line text-lg"></i>

                        <span
                            class="absolute -top-2 -right-2
            bg-red-500 text-white
            text-[10px]
            px-1.5 rounded-full">

                            3

                        </span>

                    </button>

                    <div class="relative">

                        <button id="profileBtn"
                            class="flex items-center gap-3">

                            <img
                                src="{{ asset('uploads/group/man-suit-with-shirt-that-says-word-it_833755-19054.avif') }}"
                                class="w-10 h-10 rounded-full">

                        </button>

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-3
            w-52 bg-white rounded-2xl
            shadow-xl overflow-hidden">

                            <a href="#"
                                class="block px-4 py-3 hover:bg-gray-100">
                                Profile
                            </a>

                            <a href="#"
                                class="block px-4 py-3 hover:bg-gray-100">
                                Settings
                            </a><a href="#"
                                class="block px-4 py-3 hover:bg-red-50 text-red-500">
                                Logout
                            </a>

                        </div>

                    </div>

                </div>

            </header>
            <main class="flex-1 p-12 min-h-screen overflow-y-auto bg-gradient-to-r from-sky-100 via-white to-indigo-100 dark:from-slate-900 dark:via-blue-900 dark:to-slate-900">


                <!-- Language Section -->

                <section class="space-y-6">

                    <div class="grid md:grid-cols-2 gap-8 grid-cols-1">
                        <!-- Card -->
                        <div class="w-full max-w-xl  bg-white/20 dark:bg-slate-900 rounded-3xl shadow-md p-6 sm:p-10 animate-[fadeIn_0.6s_ease-out]">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <div class="mx-auto mb-4 w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-500 to-purple-600
                            flex items-center justify-center  shadow-lg  animate-pulse">
                                    <svg class="w-8 h-8 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                    </svg>

                                </div>


                                <h2 class="text-2xl sm:text-3xl font-bold dark:text-white">
                                    Edit Profile
                                </h2>
                                <p class="text-gray-300 mt-2 text-sm dark:text-white">
                                    Update your personal information securely
                                </p>
                            </div>


                            <form method="POST" action="{{route('profile.update')}}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Name -->

                                <div class="group">
                                    <label class="text-sm text-gray-200 font-medium dark:text-white">
                                        Full Name
                                    </label>
                                    <div class="relative mt-2">
                                        <input
                                            type="text"
                                            name="name"
                                            value="{{old('name',auth()->user()->name)}}"
                                            class=" w-full rounded-2xl bg-slate-200 border border-slate-300 dark:text-white placeholder-gray-400 px-5 py-4
                                outline-none transition-all duration-300 focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 group-hover:border-blue-300"
                                            placeholder="Enter your name">
                                    </div>
                                    @error('name')
                                    <p class="text-red-400 text-sm mt-2">
                                        {{$message}}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="group">
                                    <label class="text-sm text-gray-200 font-medium">
                                        Email Address
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{old('email',auth()->user()->email)}}"
                                        class=" mt-2 w-full rounded-2xl bg-slate-200 border border-slate-300 dark:text-white  placeholder-gray-400 px-5 py-4
                                outline-none transition-all duration-300 focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 group-hover:border-blue-300"
                                        placeholder="example@gmail.com">
                                    @error('email')
                                    <p class="text-red-400 text-sm mt-2">
                                        {{$message}}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="rounded-2xl  p-5 bg-red-500/10 border border-red-400/20">
                                    <label class="text-sm text-red-200 font-semibold">
                                        Confirm Password
                                    </label>
                                    <p class="text-xs text-gray-300 mt-1 dark:text-white">
                                        Enter current password to save changes
                                    </p>

                                    <input
                                        type="password"
                                        name="password"
                                        class="mt-3 w-full rounded-2xl bg-black/20 border border-red-300/20 text-white px-5 py-4 outline-none transition-all duration-300 focus:ring-4 focus:ring-red-500/20 focus:border-red-400"
                                        placeholder="Current password">
                                    @error('password')
                                    <p class="text-red-400 text-sm mt-2">
                                        {{$message}}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Button -->
                                <button
                                    class="w-full relative overflow-hidden rounded-2xl py-4 font-semibold text-white bg-gradient-to-r from-blue-600 via-purple-600
                    to-pink-600 shadow-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-purple-500/30 active:scale-95
                    ">
                                    <span class="relative z-10">
                                        Update Profile
                                    </span>
                                </button>
                            </form>
                        </div>

                        <div class="w-full max-w-xl flex-1">
                            <div class="min-h-screen rounded-3xl bg-white/20 dark:bg-slate-900 flex items-center justify-center px-4">
                                <div class="w-full max-w-md">
                                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
                                        <h2 class="text-3xl font-bold text-white text-center mb-8 dark:text-white">
                                            Change Password
                                        </h2>

                                        <form method="POST"
                                            action="{{route('password.update')}}">
                                            @csrf
                                            <div class="space-y-5">
                                                <input
                                                    type="password"
                                                    name="current_password"
                                                    placeholder="Current Password"
                                                    class="w-full rounded-2xl bg-slate-200 border border-slate-300 dark:text-white px-5 py-4 outline-none focus:ring-4 focus:ring-blue-500/30">
                                                @error('current_password')
                                                <p class="text-red-400 text-sm">
                                                    {{$message}}
                                                </p>
                                                @enderror
                                                <input
                                                    type="password"
                                                    name="new_password"
                                                    placeholder="New Password"
                                                    class="w-full rounded-2xl bg-slate-200 border border-slate-300 dark:text-white px-5 py-4 outline-none focus:ring-4 focus:ring-green-500/30 ">
                                                <input
                                                    type="password"
                                                    name="new_password_confirmation"
                                                    placeholder="Confirm New Password"
                                                    class="w-full rounded-2xl bg-slate-200 border border-slate-300 dark:text-white px-5 py-4 outline-none focus:ring-4 focus:ring-green-500/30">

                                                <button
                                                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:scale-105 transition ">
                                                    Update Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: "{{session('success')}}",
                                    confirmButtonColor: '#2563eb'
                                });
                            </script>
                            @endif
                            @if(session('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed',
                                    text: "{{session('error')}}",
                                    confirmButtonColor: '#dc2626'
                                });
                            </script>
                            @endif

                        </div>
                    </div>



                    @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "{{session('success')}}",
                            confirmButtonColor: '#2563eb'
                        });
                    </script>
                    @endif

                    @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: "{{session('error')}}",
                            confirmButtonColor: '#dc2626'
                        });
                    </script>
                    @endif


                    <div class="bg-white/80 dark:bg-slate-100/8 dark:border-slate-700  rounded-3xl shadow-xl p-8 border border-gray-100 transition hover:shadow-2xl ">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-3xl">
                                    🌐
                                </div>
                                <div>
                                    <h2 data-en="Language"
                                        data-mm="ဘာသာစကား" class="text-2xl font-bold dark:text-white">
                                        Language
                                    </h2>
                                    <p data-en="Choose your platform language"
                                        data-mm="ဘာသာစကားရွေးချယ်ပါ" class="text-gray-500 dark:text-white/70">
                                        Choose your platform language
                                    </p>
                                </div>
                            </div>
                            <select onchange="setLanguage(this.value)" class="py-3 px-14 rounded-md bg-slate-200  border border-slate-300">

                                <option value="en" class="text-slate-700 dark:text-white">
                                    English
                                </option>


                                <option value="mm" class="text-slate-700 dark:text-white">
                                    မြန်မာ
                                </option>


                            </select>
                        </div>

                    </div>

                    <!-- Theme Section -->
                    <section class="mt-8">
                        <div class="bg-white/80 dark:bg-slate-100/8 dark:border-slate-700 rounded-3xl shadow-xl p-8 border border-gray-100 transition hover:shadow-2xl ">
                            <div class="flex justify-between gap-4 mb-6">
                                <div class="">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-3xl">
                                        🎨
                                    </div>
                                    <div>
                                        <h2 data-en="Theme"
                                            data-mm="အသွင်အပြင်" class="text-xl font-bold dark:text-white">
                                            Theme
                                        </h2>
                                        <p data-en="Customize your learning experience"
                                            data-mm="သင်ကြိုက်နှစ်သက်ရာ အသွင်ပြင်ရွေးပါ" class="text-gray-500 mt-1 dark:text-white">
                                            Customize your learning experience
                                        </p>
                                    </div>
                                </div>
                                <button
                                    id="themeToggle"
                                    class=" w-12 h-12 rounded-full bg-indigo-600 text-white dark:text-slate-800 shadow-xl hover:scale-110 transition duration-300">
                                    🌙
                                </button>
                            </div>

                        </div>
                    </section>
                </section>

                <script>
                    const userId = "{{ auth()->id() ?? 'guest' }}";


                    function setLanguage(lang) {

                        localStorage.setItem(
                            "user_" + userId + "_language",
                            lang
                        );


                        applyLanguage(lang);

                    }



                    function loadLanguage() {

                        let lang =
                            localStorage.getItem(
                                "user_" + userId + "_language"
                            );


                        if (!lang) {

                            lang = "en";

                        }


                        applyLanguage(lang);

                    }



                    function applyLanguage(lang) {

                        document.documentElement
                            .setAttribute(
                                "lang",
                                lang
                            );


                        document
                            .querySelectorAll("[data-en]")
                            .forEach(el => {


                                if (lang === "mm") {

                                    el.innerHTML =
                                        el.dataset.mm;

                                } else {

                                    el.innerHTML =
                                        el.dataset.en;

                                }


                            });

                    }



                    loadLanguage();
                </script>

            </main>

        </div>
    </div>


    <script>
        function toggleSidebarDropdown(id, button) {

            const menu = document.getElementById(id);

            const icon = button.querySelector(".ri-arrow-down-s-line");

            const opened =
                menu.classList.contains("grid-rows-[1fr]");

            document.querySelectorAll("[id$='Menu']").forEach(el => {
                el.classList.remove("grid-rows-[1fr]");
                el.classList.add("grid-rows-[0fr]");
            });

            document.querySelectorAll(".ri-arrow-down-s-line").forEach(el => {
                el.classList.remove("rotate-180");
            });

            if (!opened) {

                menu.classList.remove("grid-rows-[0fr]");
                menu.classList.add("grid-rows-[1fr]");

                icon.classList.add("rotate-180");

            }

        }
    </script>
</body>

</html>