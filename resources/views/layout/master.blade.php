<!DOCTYPE html>
<html lang="en" id="appTheme">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .gradient-text {
            background: linear-gradient(to right, #6366f1, #a855f7);
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    @include('sharedata.nav')
    <div class=" min-h-screen bg-gradient-to-r from-sky-100 via-white to-indigo-100 
    dark:from-slate-800 dark:via-indigo-950 dark:to-slate-800">
        @yield('content')
    </div>
    @include('sharedata.footer')
    @yield('scripts')

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