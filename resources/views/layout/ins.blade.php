<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Learning Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">


</head>

<body>

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>

        @include('sharedata.ins_side')

        <div class="flex-1 min-h-screen overflow-y-auto bg-[radial-gradient(circle_at_top_left,_rgba(99,102,241,0.08),_transparent_24%),radial-gradient(circle_at_top_right,_rgba(236,72,153,0.08),_transparent_24%),linear-gradient(135deg,#f8fbff,#eef5ff_48%,#fdfbff)]">

            <!-- Topbar -->
            <header class="sticky top-0 z-30 border-b border-white/60 bg-white/75 backdrop-blur-xl shadow-sm">
                <div class="h-20 px-4 md:px-6 flex items-center justify-between">
                    <div class="flex items-center gap-4 min-w-0">
                        <button id="openSidebar"
                            class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                            ☰
                        </button>

                        <div class="min-w-0">
                            <h1 class="font-bold text-2xl text-slate-800 truncate">
                                @yield('title')
                            </h1>
                            <p class="text-sm text-slate-500 hidden sm:block">
                                @yield('page')
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-5">



                        <div class="relative">

                            <button id="profileBtn"
                                class="flex items-center gap-3">

                                <img
                                    src="{{ auth()->user()->avatar
                                            ? asset('images/avatars/' . auth()->user()->avatar)
                                            : asset('images/avatars/avatar1.png') }}"
                                    class="w-10 h-10 rounded-full">

                            </button>

                            <div id="profileMenu"
                                class="hidden absolute right-0 mt-3
            w-52 bg-white rounded-2xl
            shadow-xl overflow-hidden">

                                <div onclick="openAvatarModal()"
                                    class="block px-4 py-3 hover:bg-gray-100">
                                    Profile
                                </div>

                                <a href="{{ route('settings.index') }}"
                                    class="block px-4 py-3 hover:bg-gray-100">
                                    Settings
                                </a>
                                <div onclick="confirmLogout()"
                                    class="block px-4 py-3 hover:bg-red-50 text-red-500">
                                    Logout
                                </div>
                                <form
                                    id="logoutForm"
                                    method="POST"
                                    action="{{ route('logout') }}"
                                    class="hidden">
                                    @csrf
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </header>

            <div class="bg-gradient-to-r from-sky-100 via-white to-indigo-100 px-1 lg:px-12 min-h-screen">
                @yield('content')
            </div>

        </div>

    </div>
    @include('layout.profile_edit')
    <script>
        function confirmLogout() {
            Swal.fire({

                title: 'Are you sure?',

                text: 'You will be logged out from your account.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Logout',

                cancelButtonText: 'Cancel',

                reverseButtons: true,

                buttonsStyling: false,

                customClass: {

                    popup: 'rounded-3xl',

                    title: 'text-xl font-bold text-slate-900',

                    htmlContainer: 'text-slate-500',

                    confirmButton: 'px-5 py-2.5 rounded-xl bg-red-600 text-white font-semibold mx-2 hover:bg-red-700',

                    cancelButton: 'px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-semibold mx-2 hover:bg-slate-200'

                }

            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('logoutForm').submit();

                }

            });
        }
    </script>
</body>

</html>