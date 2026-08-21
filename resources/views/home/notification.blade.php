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
                class="h-20 bg-white dark:bg-slate-900 shadow-sm
                        flex items-center justify-between
                        px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-3xl">

                        ☰

                    </button>
                    <div class="">
                        <h1 class="text-slate-700 text-2xl dark:text-white font-extrabold">
                            Notification
                        </h1>
                        <p class="text-slate-500 text-sm dark:text-white">My notifications</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">



                    <div class="relative">

                        <button id="profileBtn"
                            class="flex items-center gap-3">

                            <img
                                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                class="w-10 h-10 rounded-full">

                        </button>

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-3  w-52 bg-white rounded-2xl shadow-xl overflow-hidden">

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
                <div class="space-y-2">

                    @forelse(
                    auth()->user()->notifications
                    ->take(10)
                    as $notification
                    )

                    <div
                        class="flex gap-3
                                    p-4
                                    rounded-2xl text-white
                                    {{ $notification->read_at
                                            ? 'bg-white'
                                            : 'bg-indigo-400' }}
                                    hover:bg-slate-50 hover:text-slate-700
                                    transition">

                        {{-- ICON --}}

                        <div
                            class="shrink-0
                                        w-10 h-10
                                        rounded-xl
                                        flex
                                        items-center
                                        justify-center
                                        {{ ($notification->data['type'] ?? '') === 'account_banned'
                                                ? 'bg-red-100 text-red-600'
                                                : 'bg-indigo-100 text-indigo-600' }}">

                            @if(
                            ($notification->data['type'] ?? '')
                            === 'account_banned'
                            )

                            🚫

                            @else

                            🔔

                            @endif

                        </div>


                        {{-- CONTENT --}}

                        <div class="min-w-0">

                            <p class="font-bold text-sm">

                                {{ $notification->data['title'] ?? 'Notification' }}

                            </p>

                            <p class="text-xs mt-1">

                                {{ $notification->data['message'] ?? '' }}

                            </p>

                            <p class="text-[10px] mt-2">

                                {{ $notification->created_at->diffForHumans() }}

                            </p>

                        </div>

                    </div>

                    @empty

                    <div class="text-center py-10">

                        <div class="text-4xl mb-3">
                            🔔
                        </div>

                        <p class="font-semibold ">
                            No notifications
                        </p>

                        <p class="text-xs mt-1">
                            You're all caught up.
                        </p>

                    </div>

                    @endforelse

                </div>

            </main>
        </div>
    </div>



</body>

</html>