<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    {{-- Tailwind Css --}}
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-purple-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2">

        <!-- Left Side -->
        <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-indigo-600 to-purple-600 text-white p-12 relative overflow-hidden">

            <div class="absolute w-72 h-72 bg-white/10 rounded-full -top-10 -left-10"></div>
            <div class="absolute w-96 h-96 bg-white/10 rounded-full -bottom-20 -right-20"></div>

            <h1 class="text-5xl font-extrabold mb-6 leading-tight z-10">
                Welcome Back
            </h1>

            <p class="text-lg text-indigo-100 z-10">
                Create your account and start your amazing journey with us.
            </p>

            <div class="mt-10 z-10">
                <img
                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                    class="w-72 mx-auto animate-bounce">
            </div>

        </div>

        <!-- Right Side -->
        <div class="p-8 md:p-14">

            <div class="mb-8 text-center">
                <h2 class="text-4xl font-bold text-gray-800">
                    Create Account
                </h2>

                <p class="text-gray-500 mt-2">
                    Register to continue
                </p>
            </div>

            <!-- Google Button -->

            <a href="{{ route('google.login') }}"
                class="flex items-center justify-center gap-3 border border-gray-300 rounded-2xl py-3 font-semibold hover:bg-gray-100 transition duration-300 group">

                <svg class="w-6 h-6 group-hover:scale-110 transition"
                    viewBox="0 0 48 48">

                    <path fill="#FFC107"
                        d="M43.6 20.5H42V20H24v8h11.3C33.7 32.7 29.3 36 24 36c-6.6 0-12-5.4-12-12S17.4 12 24 12c3 0 5.7 1.1 7.8 3l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z" />

                    <path fill="#FF3D00"
                        d="M6.3 14.7l6.6 4.8C14.7 16 19 12 24 12c3 0 5.7 1.1 7.8 3l5.7-5.7C34.1 6.1 29.3 4 24 4c-7.7 0-14.3 4.3-17.7 10.7z" />

                    <path fill="#4CAF50"
                        d="M24 44c5.2 0 10-2 13.5-5.3l-6.2-5.2C29.2 35.2 26.7 36 24 36c-5.2 0-9.6-3.3-11.2-8l-6.5 5C9.6 39.5 16.3 44 24 44z" />

                    <path fill="#1976D2"
                        d="M43.6 20.5H42V20H24v8h11.3c-1.1 3.1-3.3 5.5-6 7.1l6.2 5.2C39.6 36.5 44 30.8 44 24c0-1.3-.1-2.7-.4-3.5z" />
                </svg>

                Continue with Google
            </a>

            <div class="flex items-center my-6">
                <div class="flex-1 border-t"></div>
                <span class="px-4 text-gray-400 text-sm">OR</span>
                <div class="flex-1 border-t"></div>
            </div>

            <!-- Form -->

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">

                @csrf

                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Full Name
                    </label>

                    <input type="text" maxlength="30"
                        name="name"
                        placeholder="Enter your name"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Email Address
                    </label>

                    <input type="email" maxlength="35"
                        name="email"
                        placeholder="Enter your email"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">
                </div>
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Password
                    </label>

                    <input type="password" minlength="6" maxlength="10"
                        name="password"
                        placeholder="Enter password"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Confirm Password
                    </label>

                    <input type="password" minlength="6" maxlength="15"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">
                </div>
                <p class="text-center text-gray-500 mt-6">
                    <input type="checkbox" required>
                    Our platform privacy. Agree

                    <a href="{{ route('privacy') }}"
                        class="text-indigo-600 font-semibold hover:underline">
                        pricacy
                    </a>
                </p>

                <button
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] hover:shadow-xl transition duration-300">

                    Create Account

                </button>

            </form>

            <p class="text-center text-gray-500 mt-6">
                Already have an account?

                <a href="{{ route('login') }}"
                    class="text-indigo-600 font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Swal.fire({
                icon: 'error',
                title: 'Wrong',
                text: `@json(session('error'))`,
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc2626',
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'font-bold',
                    confirmButton: 'rounded-xl px-6 py-2'
                }
            });

        });
    </script>
    @endif
</body>

</html>