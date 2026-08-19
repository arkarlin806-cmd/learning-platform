<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">

    <title>learning</title>
    <style>
        ::-webkit-scrollbar {

            width: 4px;
            height: 8px;

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

<body class="bg-slate-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>
        @if(auth()->user()->role == 1)
        @include('sharedata.admin_side')
        @else
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:relative z-50
        w-72 h-screen
        bg-white/95 backdrop-blur-lg
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
                    bg-indigo-600
                    text-white
                    flex items-center justify-center
                    font-bold text-xl">
                        @if(auth()->user()->role == 2)
                        I
                        @else
                        L
                        @endif
                    </div>

                    <div id="logoText">

                        <h2 class="font-bold text-lg">
                            @if(auth()->user()->role == 2)
                            Instructor
                            @else
                            Learner
                            @endif
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
            <nav class="px-4 py-2 space-y-1">

                <a @if(auth()->user()->role == 2) href="{{ route('instructor.index') }}" @else href="{{ route('profile.index') }}" @endif
                    class="menu-item flex items-center gap-4
                    px-4 py-3 rounded-2xl
                    hover:bg-indigo-50
                    hover:translate-x-2
                    transition-all duration-300">

                    <i class="ri-home-4-line text-xl"></i>
                    <span class="menu-text">Home</span>

                </a>
                <hr class="text-sky-200">
                <a href="{{ route('instructor.single_course', $course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-book-3-line text-xl"></i>
                    <span class="menu-text">Course Info</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('instructor.learners', $course->id) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-group-line text-xl"></i>
                    <span class="menu-text">Learner</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('lesson.show', $course->id) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-video-upload-line text-xl"></i>
                    <span class="menu-text">Lessons</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('quiz.quiz_all', $course->id) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-questionnaire-line text-xl"></i>
                    <span class="menu-text">Assignment</span>

                </a>
                <hr class="text-sky-200">

                @if(auth()->user()->role == 2)
                <a href="{{ route('courses.live.index', $course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-phone-line text-xl"></i>
                    <span class="menu-text">Live Room</span>

                </a>
                @else
                <a href="{{ route('learner.index', $course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-phone-line text-xl"></i>
                    <span class="menu-text">Live Room</span>

                </a>
                @endif
                <hr class="text-sky-200">

                <a href="{{ route('learner.chat',$course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">


                    <i class="ri-slack-line text-xl"></i>
                    <span class="menu-text">Chat</span>



                </a>
                <hr class="text-sky-200">
                @if(auth()->user()->role == 2)
                <a href="{{ route('instructor.certificates.index',$course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-bard-line text-xl"></i>
                    <span class="menu-text">Certificates</span>

                </a>
                @else
                <a href="{{ route('learner.certificate', $course->id) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-bard-line text-xl"></i>
                    <span class="menu-text">Certificates</span>

                </a>
                @endif
            </nav>



        </aside>
        @endif
        <!-- mani content  -->
        <div class="bg-slate-200 h-screen flex-1 overflow-y-auto">

            <!-- Topbar -->
            <header
                class="h-14 md:h-20 bg-white shadow-sm
            flex items-center justify-between
            px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-3xl">

                        ☰

                    </button>
                    <div class="">
                        <h1 class="font-bold text-slate-700 text-md md:text-xl">
                            @yield('title')
                        </h1>
                        <p class="text-sm text-slate-400">@yield('page')</p>
                    </div>
                </div>



            </header>
            <div class="bg-gradient-to-r from-sky-100 via-white to-indigo-100 px-1 lg:px-12 py-8 min-h-screen overflow-y-auto">
                @yield('content')
            </div>
        </div>

    </div>


</body>

</html>