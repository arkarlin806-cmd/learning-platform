<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/side_bar.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Instructor Dashboard</title>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sidebar-animation {
            animation: slideIn .5s ease;
        }

        .content-animation {
            animation: fadeIn .8s ease;
        }
    </style>

</head>

<body class="bg-slate-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>

        <!-- Sidebar -->
        @include('sharedata.user_side')

        <div class="h-screen overflow-y-auto custom-scroll  relative flex-1">

            <header
                class="h-20 bg-white shadow-sm dark:bg-slate-900
                flex items-center justify-between
                px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-3xl">

                        ☰

                    </button>
                    <div class="">
                        <h1 class="font-bold text-2xl text-slate-600 dark:text-white font-semibold">
                            @yield('title')
                        </h1>
                        <p class="text-sm text-slate-500 dark:text-white/70">@yield('page')</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <!-- <div class="relative">

                        <button id="profileBtn"
                            class="flex items-center gap-3">

                            <img
                                src="#"
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

                    </div> -->

                </div>

            </header>
            <div class="bg-gradient-to-r from-sky-100 via-white to-indigo-100 p-12 min-h-screen
            dark:from-slate-800 dark:via-indigo-950 dark:to-slate-800">
                @yield('content')
            </div>

        </div>

    </div>

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





</body>

</html>