<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/side_bar.js'])
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
        @include('sharedata.admin_side')

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
                            @yield('page_title')
                        </h1>
                        <p class="text-slate-500 text-sm">@yield('page')</p>
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
            <main class="flex-1 p-12 min-h-screen overflow-y-auto bg-gradient-to-r from-sky-100 via-white to-indigo-100">


                @yield('content')

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


        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        document.getElementById('openSidebar')
            .addEventListener('click', () => {

                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');

            });

        document.getElementById('closeSidebar')
            .addEventListener('click', closeSidebar);

        overlay.addEventListener('click', closeSidebar);

        function closeSidebar() {

            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');

        }

        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');

        profileBtn.addEventListener('click', () => {

            profileMenu.classList.toggle('hidden');

        });

        const collapseBtn = document.getElementById('collapseBtn');

        collapseBtn.addEventListener('click', () => {

            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-24');

            document.querySelectorAll('.menu-text')
                .forEach(el => el.classList.toggle('hidden'));

            document.getElementById('logoText')
                .classList.toggle('hidden');

        });
    </script>
</body>

</html>