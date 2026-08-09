<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Reset Password</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-purple-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            Reset Password
        </h1>

        <form action="{{ route('password.update') }}"
            method="POST"
            class="space-y-5">

            @csrf

            <input type="hidden"
                name="token"
                value="{{ $token }}">

            <div>

                <label class="block mb-2 font-medium text-gray-700">
                    Email
                </label>

                <input type="email"
                    name="email"
                    required
                    class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-200">

            </div>

            <div>

                <label class="block mb-2 font-medium text-gray-700">
                    New Password
                </label>

                <input type="password"
                    name="password"
                    required
                    class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-200">

            </div>

            <div>

                <label class="block mb-2 font-medium text-gray-700">
                    Confirm Password
                </label>

                <input type="password"
                    name="password_confirmation"
                    required
                    class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-200">

            </div>

            <button
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-2xl font-bold">

                Reset Password

            </button>

        </form>

    </div>

</body>

</html>