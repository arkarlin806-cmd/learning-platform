<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-purple-100 flex items-center justify-center p-4">

    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2">

        <!-- Left Side -->

        <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-indigo-600 to-purple-700 p-14 text-white relative overflow-hidden">

            <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full -translate-x-20 -translate-y-20"></div>

            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full translate-x-20 translate-y-20"></div>

            <div class="relative z-10">

                <h1 class="text-5xl font-extrabold leading-tight mb-6">
                    Welcome Back 👋
                </h1>

                <p class="text-indigo-100 text-lg leading-relaxed">
                    Login to continue your learning journey and access your dashboard anytime.
                </p>

                <img
                    src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
                    class="w-80 mt-12 mx-auto animate-pulse">

            </div>

        </div>

        <!-- Right Side -->

        <div class="p-8 md:p-14 flex flex-col justify-center">

            <div class="mb-8">

                <h2 class="text-4xl font-bold text-gray-800">
                    Sign In
                </h2>

                <p class="text-gray-500 mt-2">
                    Login to your account
                </p>

            </div>

            <!-- Google Button -->

            <a href="{{ route('google.login') }}"
                class="w-full border border-gray-300 rounded-2xl py-4 flex items-center justify-center gap-3 hover:bg-gray-100 transition duration-300 group">

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

                <span class="font-semibold text-gray-700">
                    Continue with Google
                </span>

            </a>

            <!-- Divider -->

            <div class="flex items-center my-7">

                <div class="flex-1 border-t"></div>

                <span class="px-4 text-gray-400 text-sm">
                    OR
                </span>

                <div class="flex-1 border-t"></div>

            </div>

            <!-- Form -->

            <form action="{{ route('login.post') }}"
                method="POST"
                class="space-y-5">

                @csrf

                <!-- Email -->

                <div>

                    <label class="block mb-2 font-medium text-gray-700">
                        Email Address
                    </label>

                    <input type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">

                </div>

                <!-- Password -->

                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Password
                    </label>

                    <input type="password" minlength="6" maxlength="15"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition">

                </div>

                <!-- Remember + Forgot -->

                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2 text-gray-600 hidden">

                        <input type="checkbox"
                            name="remember"
                            class="rounded hidden border-gray-300 text-indigo-600 focus:ring-indigo-500">

                        Remember me

                    </label>

                    <a href="{{ route('forgot.password') }}"
                        class="text-indigo-600 font-semibold hover:underline">

                        Forgot Password?

                    </a>

                </div>

                <!-- Login Button -->

                <button
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] hover:shadow-xl transition duration-300">

                    Sign In

                </button>

            </form>

            <!-- Register -->

            <p class="text-center text-gray-500 mt-8">

                Don’t have an account?

                <a href="{{ route('register') }}"
                    class="text-indigo-600 font-semibold hover:underline">

                    Register

                </a>

            </p>

        </div>

    </div>


</body>

</html>