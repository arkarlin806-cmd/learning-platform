<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>Object Detection</title>

</head>

<body class="bg-slate-100">

    <nav class="bg-indigo-700">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">

            <h1 class="text-white font-bold text-xl">

                AI Object Detection

            </h1>

            <span class="text-white">

                {{ auth()->user()->name }}

            </span>

        </div>

    </nav>

    <main class="max-w-7xl mx-auto p-6">

        @yield('content')

    </main>

</body>

</html>