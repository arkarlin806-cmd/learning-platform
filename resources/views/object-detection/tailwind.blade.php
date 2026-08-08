@extends('layout.ai')

@section('content')

<div class="app-shell w-full flex-1">

    <!-- Header -->
    <header class="top-fade header-glass">
        <div class="max-w-6xl mx-auto px-3 md:px-2 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <button id="openSidebar"
                    class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                    ☰
                </button>
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                    T
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        Tailwind CSS ( fronted language )
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Learn frontend Tailwind CSS language. Useful for UI/UX design.
                    </p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="status-pill text-xs px-3 py-1.5 rounded-full">
                    Smart Chat
                </span>
            </div>
        </div>
    </header>

    <div class="flex justify-between overflow-y-auto">
        <style>
            textarea {
                tab-size: 4;
            }

            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-thumb {
                background: #94a3b8;
                border-radius: 999px;
            }

            .glass {
                backdrop-filter: blur(18px);
                background: rgba(255, 255, 255, .75);
            }

            .animate-card {
                transition: .35s;
            }

            .animate-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 30px 60px rgba(0, 0, 0, .12);
            }

            .fullscreen-editor {

                position: fixed;

                inset: 0;

                z-index: 9999;

                background: #020617;

                border-radius: 0;

            }

            .previewWrapper {
                transition: all .35s ease;
            }

            .previewCard {
                transition: all .35s cubic-bezier(.22, 1, .36, 1);
            }

            .previewWrapper.show {
                display: flex;
                animation: fadeIn .35s ease forwards;
            }

            .previewWrapper.show .previewCard {
                opacity: 1;
                transform: scale(1);
            }

            .previewWrapper.hide .previewCard {
                opacity: 0;
                transform: scale(.75);
            }

            @keyframes fadeIn {

                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }

            }
        </style>


        @php

        $sections=[
        [
        'id'=>'intro',

        'title'=>'Tailwind CSS Introduction',

        'description'=>'Tailwind CSS သည် Utility-first CSS Framework ဖြစ်ပြီး HTML Class များကို အသုံးပြုပြီး Modern UI Design များကို လျင်မြန်စွာ တည်ဆောက်နိုင်သည်။',

        'points'=>[
        'Tailwind CSS ဆိုတာဘာလဲ',
        'Utility Classes',
        'Responsive Design',
        'Class Based Styling',
        'CDN Setup'
        ],

        'code'=><<<HTML
            <!DOCTYPE html>
            <html>

            <head>

                <script src="https://cdn.tailwindcss.com"></script>

            </head>


            <body class="bg-slate-100 p-10">


                <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl p-8">


                    <h1 class="text-3xl font-bold text-blue-600">

                        Hello Tailwind CSS

                    </h1>


                    <p class="mt-4 text-gray-600">

                        Build modern UI using utility classes.

                    </p>


                    <button
                        class=" mt-6
                                px-5
                                py-3
                                bg-blue-600
                                text-white
                                rounded-xl
                                hover:bg-blue-700
                                transition">

                        Get Started

                    </button>


                </div>


            </body>

            </html>
            HTML
            ]
            ,[
            'id'=>'colors',

            'title'=>'Tailwind Colors',

            'description'=>'Tailwind CSS တွင် အသင့်အသုံးပြုနိုင်သော Color Utility Classes များဖြင့် Text, Background နှင့် Border များကို Design ပြုလုပ်နိုင်သည်။',

            'points'=>[
            'Text Color',
            'Background Color',
            'Border Color',
            'Gradient',
            'Opacity'
            ],

            'code'=><<<HTML
                <!DOCTYPE html>
                <html>

                <head>

                    <script src="https://cdn.tailwindcss.com"></script>

                </head>


                <body class="bg-slate-100 p-10">


                    <div class="space-y-5">


                        <div class="bg-blue-600 text-white p-5 rounded-xl">

                            Blue Background

                        </div>


                        <div class="bg-green-500 text-white p-5 rounded-xl">

                            Success Color

                        </div>


                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-5 rounded-xl">

                            Gradient Background

                        </div>


                        <div class="border-4 border-red-500 p-5 rounded-xl text-red-600">

                            Border Color

                        </div>


                    </div>


                </body>

                </html>
                HTML
                ]
                ,[
                'id'=>'spacing',

                'title'=>'Tailwind Spacing',

                'description'=>'Tailwind CSS တွင် Margin, Padding, Width, Height များကို Utility Classes များဖြင့် ထိန်းချုပ်နိုင်သည်။',

                'points'=>[
                'Padding (p)',
                'Margin (m)',
                'Width',
                'Height',
                'Space Between'
                ],

                'code'=><<<HTML
                    <!DOCTYPE html>
                    <html>

                    <head>

                        <script src="https://cdn.tailwindcss.com"></script>

                    </head>


                    <body class="bg-gray-100 p-10">


                        <div class="max-w-lg mx-auto">


                            <div class="bg-white
                                        p-10
                                        m-5
                                        rounded-2xl
                                        shadow-lg">


                                <h2 class="text-2xl font-bold">

                                    Box Model

                                </h2>


                                <p class="mt-4">

                                    Padding, Margin and Size control.

                                </p>


                            </div>


                            <div class="flex gap-5">


                                <div class="w-32 h-32 bg-blue-500 rounded-xl">

                                </div>


                                <div class="w-32 h-32 bg-green-500 rounded-xl">

                                </div>


                            </div>


                        </div>


                    </body>

                    </html>
                    HTML
                    ]
                    ,[
                    'id'=>'flexbox',

                    'title'=>'Tailwind Flexbox',

                    'description'=>'Tailwind Flex Utility များကို အသုံးပြုပြီး Responsive Layout များကို လွယ်ကူစွာ ဖန်တီးနိုင်သည်။',

                    'points'=>[
                    'flex',
                    'flex-row',
                    'flex-col',
                    'justify-content',
                    'align-items',
                    'gap'
                    ],

                    'code'=><<<HTML
                        <!DOCTYPE html>
                        <html>

                        <head>

                            <script src="https://cdn.tailwindcss.com"></script>

                        </head>


                        <body class="p-10 bg-slate-100">


                            <div class="flex flex-col md:flex-row gap-5">


                                <div class="flex-1
                                        bg-blue-600
                                        text-white
                                        p-8
                                        rounded-xl">


                                    Card One

                                </div>



                                <div class="flex-1
                                            bg-green-600
                                            text-white
                                            p-8
                                            rounded-xl">


                                    Card Two

                                </div>



                                <div class="flex-1
                                    bg-purple-600
                                    text-white
                                    p-8
                                    rounded-xl">


                                    Card Three

                                </div>


                            </div>


                        </body>

                        </html>
                        HTML
                        ]
                        ,[
                        'id'=>'responsive',

                        'title'=>'Tailwind Responsive Design',

                        'description'=>'Tailwind CSS တွင် Mobile First Approach ဖြင့် Screen Size အလိုက် Design ပြောင်းလဲနိုင်သည်။',

                        'points'=>[
                        'sm',
                        'md',
                        'lg',
                        'xl',
                        'Responsive Grid',
                        'Mobile First'
                        ],

                        'code'=><<<HTML
                            <!DOCTYPE html>
                            <html>

                            <head>

                                <script src="https://cdn.tailwindcss.com"></script>

                            </head>


                            <body class="bg-slate-100 p-10">


                                <div class="grid

                                        grid-cols-1

                                        sm:grid-cols-2

                                        lg:grid-cols-4

                                        gap-5

                                        ">


                                    <div class="bg-white p-6 rounded-xl shadow">

                                        Mobile

                                    </div>


                                    <div class="bg-white p-6 rounded-xl shadow">

                                        Tablet

                                    </div>


                                    <div class="bg-white p-6 rounded-xl shadow">

                                        Laptop

                                    </div>


                                    <div class="bg-white p-6 rounded-xl shadow">

                                        Desktop

                                    </div>


                                </div>


                            </body>

                            </html>
                            HTML
                            ]
                            ,[
                            'id'=>'typography',

                            'title'=>'Tailwind Typography',

                            'description'=>'Tailwind Typography Utility များကို အသုံးပြုပြီး Text Size, Font Weight, Alignment, Line Height နှင့် Letter Spacing များကို ထိန်းချုပ်နိုင်သည်။',

                            'points'=>[
                            'text-size',
                            'font-weight',
                            'text-align',
                            'leading',
                            'tracking',
                            'italic'
                            ],

                            'code'=><<<HTML
                                <!DOCTYPE html>
                                <html>

                                <head>

                                    <script src="https://cdn.tailwindcss.com"></script>

                                </head>


                                <body class="bg-slate-100 p-10">


                                    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow">


                                        <h1 class="
                                        text-4xl
                                        font-black
                                        text-blue-600
                                        text-center">

                                            Tailwind Typography

                                        </h1>


                                        <p class="
                                            mt-5
                                            text-lg
                                            text-gray-600
                                            leading-8
                                            tracking-wide">


                                            Tailwind CSS provides utility classes
                                            to control text appearance easily.


                                        </p>


                                        <p class="
                                                mt-4
                                                font-bold
                                                italic
                                                text-purple-600">

                                            Modern Web Design

                                        </p>


                                    </div>


                                </body>

                                </html>
                                HTML
                                ]
                                ,[
                                'id'=>'forms',

                                'title'=>'Tailwind Forms',

                                'description'=>'Tailwind CSS ဖြင့် Form Input, Button နှင့် Validation UI များကို Modern Design ဖြင့် တည်ဆောက်နိုင်သည်။',

                                'points'=>[
                                'Input Styling',
                                'Focus State',
                                'Placeholder',
                                'Button Design',
                                'Form Layout'
                                ],

                                'code'=><<<HTML
                                    <!DOCTYPE html>
                                    <html>

                                    <head>

                                        <script src="https://cdn.tailwindcss.com"></script>

                                    </head>


                                    <body class="bg-slate-100 p-10">


                                        <form class="
                                            max-w-md
                                            mx-auto
                                            bg-white
                                            p-8
                                            rounded-2xl
                                            shadow">


                                            <h2 class="
                                                text-2xl
                                                font-bold
                                                mb-6">

                                                Register

                                            </h2>


                                            <input

                                                class="
                                                    w-full
                                                    p-3
                                                    border
                                                    rounded-xl
                                                    focus:ring-2
                                                    focus:ring-blue-500"

                                                placeholder="Name">


                                            <input

                                                class="
                                                    w-full
                                                    p-3
                                                    mt-4
                                                    border
                                                    rounded-xl
                                                    focus:ring-2
                                                    focus:ring-blue-500"

                                                placeholder="Email">


                                            <textarea

                                                class="
                                                    w-full
                                                    p-3
                                                    mt-4
                                                    border
                                                    rounded-xl"

                                                placeholder="Message">
                                            </textarea>


                                            <button

                                                class="
                                                mt-5
                                                w-full
                                                bg-blue-600
                                                text-white
                                                py-3
                                                rounded-xl
                                                hover:bg-blue-700
                                                transition">

                                                Submit

                                            </button>


                                        </form>


                                    </body>

                                    </html>
                                    HTML
                                    ]
                                    ,[
                                    'id'=>'components',

                                    'title'=>'Tailwind Components',

                                    'description'=>'Tailwind CSS Utility များကို ပေါင်းစပ်ပြီး Button, Card, Navbar စသော Reusable Components များ ဖန်တီးနိုင်သည်။',

                                    'points'=>[
                                    'Card Component',
                                    'Button Component',
                                    'Navbar',
                                    'Badge',
                                    'Reusable UI'
                                    ],

                                    'code'=><<<HTML
                                        <!DOCTYPE html>
                                        <html>

                                        <head>

                                            <script src="https://cdn.tailwindcss.com"></script>

                                        </head>


                                        <body class="bg-slate-100">


                                            <nav class="
                                                    bg-white
                                                    shadow
                                                    p-5
                                                    flex
                                                    justify-between">


                                                <h2 class="
                                                        font-bold
                                                        text-xl
                                                        text-blue-600">

                                                    Learning

                                                </h2>


                                                <button class="
                                                            bg-blue-600
                                                            text-white
                                                            px-5
                                                            py-2
                                                            rounded-xl">

                                                    Login

                                                </button>


                                            </nav>



                                            <div class="p-10">


                                                <div class="
                                                        max-w-sm
                                                        bg-white
                                                        rounded-2xl
                                                        shadow-xl
                                                        p-6">


                                                    <span class="
                                                            bg-green-100
                                                            text-green-700
                                                            px-3
                                                            py-1
                                                            rounded-full
                                                            text-sm">

                                                        Active

                                                    </span>


                                                    <h2 class="
                                                            text-2xl
                                                            font-bold
                                                            mt-5">

                                                        Course Card

                                                    </h2>


                                                    <p class="
                                                            text-gray-600
                                                            mt-3">

                                                        Modern Tailwind Component

                                                    </p>


                                                </div>


                                            </div>


                                        </body>

                                        </html>
                                        HTML
                                        ]
                                        ,[
                                        'id'=>'animation',

                                        'title'=>'Tailwind Animation',

                                        'description'=>'Tailwind Animation Utility များဖြင့် Loading, Hover, Transition နှင့် Interactive Effects များ ဖန်တီးနိုင်သည်။',

                                        'points'=>[
                                        'animate-spin',
                                        'animate-pulse',
                                        'animate-bounce',
                                        'transition',
                                        'transform'
                                        ],

                                        'code'=><<<HTML
                                            <!DOCTYPE html>
                                            <html>

                                            <head>

                                                <script src="https://cdn.tailwindcss.com"></script>

                                            </head>


                                            <body class="bg-slate-100 p-20">


                                                <div class="flex gap-10">


                                                    <div class="
                                                            w-20
                                                            h-20
                                                            bg-blue-600
                                                            rounded-full
                                                            animate-bounce">

                                                    </div>



                                                    <div class="
                                                            w-20
                                                            h-20
                                                            bg-green-600
                                                            rounded-full
                                                            animate-pulse">

                                                    </div>



                                                    <div class="
                                                            w-20
                                                            h-20
                                                            border-8
                                                            border-purple-600
                                                            border-t-transparent
                                                            rounded-full
                                                            animate-spin">

                                                    </div>


                                                </div>


                                                <button class="

                                                            mt-10

                                                            px-6

                                                            py-3

                                                            bg-blue-600

                                                            text-white

                                                            rounded-xl

                                                            transition

                                                            hover:scale-110">

                                                    Hover Animation

                                                </button>


                                            </body>

                                            </html>
                                            HTML
                                            ]
                                            ,[
                                            'id'=>'dark-mode',

                                            'title'=>'Tailwind Dark Mode',

                                            'description'=>'Tailwind Dark Mode ကို အသုံးပြုပြီး User Preference အလိုက် Light/Dark Theme UI များ ဖန်တီးနိုင်သည်။',

                                            'points'=>[
                                            'dark class',
                                            'Theme Switching',
                                            'Dark Background',
                                            'Dark Text',
                                            'Modern UI Theme'
                                            ],

                                            'code'=><<<HTML
                                                <!DOCTYPE html>
                                                <html>

                                                <head>

                                                    <script src="https://cdn.tailwindcss.com"></script>

                                                    <script>
                                                        tailwind.config = {

                                                            darkMode: 'class'

                                                        }
                                                    </script>

                                                </head>


                                                <body class="bg-slate-100 dark:bg-slate-900 p-10">


                                                    <div class="
                                                            max-w-md
                                                            mx-auto
                                                            bg-white
                                                            dark:bg-slate-800
                                                            p-8
                                                            rounded-2xl
                                                            shadow">


                                                        <h1 class="
                                                                text-3xl
                                                                font-bold
                                                                text-slate-900
                                                                dark:text-white">

                                                            Dark Mode

                                                        </h1>


                                                        <p class="
                                                                mt-4
                                                                text-gray-600
                                                                dark:text-gray-300">

                                                            Tailwind Theme System

                                                        </p>


                                                        <button
                                                            onclick="
                                                                    document.documentElement.classList.toggle('dark')
                                                                    "

                                                            class="
                                                                        mt-5
                                                                        bg-blue-600
                                                                        text-white
                                                                        px-5
                                                                        py-3
                                                                        rounded-xl">

                                                            Toggle Theme

                                                        </button>


                                                    </div>


                                                </body>

                                                </html>
                                                HTML
                                                ]
                                                ,[
                                                'id'=>'dashboard',

                                                'title'=>'Tailwind Dashboard UI',

                                                'description'=>'Tailwind CSS ကို အသုံးပြုပြီး Admin Dashboard, Analytics Dashboard နှင့် SaaS UI များ ဖန်တီးနိုင်သည်။',

                                                'points'=>[
                                                'Sidebar Layout',
                                                'Stats Cards',
                                                'Grid Dashboard',
                                                'Responsive Design',
                                                'Modern SaaS UI'
                                                ],

                                                'code'=><<<HTML
                                                    <!DOCTYPE html>
                                                    <html>

                                                    <head>

                                                        <script src="https://cdn.tailwindcss.com"></script>

                                                    </head>


                                                    <body class="bg-slate-100 p-6">


                                                        <div class="grid md:grid-cols-4 gap-5">


                                                            <div class="
                                                                                bg-white
                                                                                    p-6
                                                                                    rounded-2xl
                                                                                    shadow">

                                                                <h3>
                                                                    Users
                                                                </h3>

                                                                <p class="
                                                                                    text-3xl
                                                                                    font-bold
                                                                                    text-blue-600">

                                                                    1200

                                                                </p>

                                                            </div>



                                                            <div class="
                                                                                bg-white
                                                                                p-6
                                                                                rounded-2xl
                                                                                shadow">

                                                                <h3>
                                                                    Courses
                                                                </h3>

                                                                <p class="
                                                                                    text-3xl
                                                                                    font-bold
                                                                                    text-green-600">

                                                                    85

                                                                </p>

                                                            </div>



                                                            <div class="
                                                                                bg-white
                                                                                p-6
                                                                                rounded-2xl
                                                                                shadow">

                                                                <h3>
                                                                    Revenue
                                                                </h3>

                                                                <p class="
                                                                                text-3xl
                                                                                font-bold
                                                                                text-purple-600">

                                                                    $5000

                                                                </p>

                                                            </div>



                                                            <div class="
                                                                                    bg-white
                                                                                    p-6
                                                                                    rounded-2xl
                                                                                    shadow">

                                                                <h3>
                                                                    Orders
                                                                </h3>

                                                                <p class="
                                                                                    text-3xl
                                                                                    font-bold
                                                                                    text-red-600">

                                                                    320

                                                                </p>

                                                            </div>


                                                        </div>


                                                    </body>

                                                    </html>
                                                    HTML
                                                    ]
                                                    , [
                                                    'id'=>'advanced-responsive',

                                                    'title'=>'Tailwind Advanced Responsive Design',

                                                    'description'=>'Tailwind Responsive System ဖြင့် Mobile, Tablet, Desktop အားလုံးအတွက် Modern Layout များ ဖန်တီးနိုင်သည်။',

                                                    'points'=>[
                                                    'Mobile First',
                                                    'Breakpoint System',
                                                    'Responsive Grid',
                                                    'Responsive Flex',
                                                    'Adaptive UI'
                                                    ],

                                                    'code'=><<<HTML
                                                        <!DOCTYPE html>
                                                        <html>

                                                        <head>

                                                            <script src="https://cdn.tailwindcss.com"></script>

                                                        </head>


                                                        <body class="bg-slate-100 p-10">


                                                            <div class="

                                                                                    flex

                                                                                    flex-col

                                                                                    lg:flex-row

                                                                                    gap-8">


                                                                <div class="

                                                                                    w-full

                                                                                    lg:w-1/3

                                                                                    bg-white

                                                                                    p-8

                                                                                    rounded-2xl

                                                                                    shadow">


                                                                    <h2 class="text-2xl font-bold">

                                                                        Profile

                                                                    </h2>


                                                                    <p class="mt-3">

                                                                        Responsive Card

                                                                    </p>


                                                                </div>



                                                                <div class="

                                                                                        w-full

                                                                                        lg:w-2/3

                                                                                        grid

                                                                                        grid-cols-1

                                                                                        sm:grid-cols-2

                                                                                        xl:grid-cols-3

                                                                                        gap-5">


                                                                    <div class="bg-blue-600 text-white p-8 rounded-xl">

                                                                        Card 1

                                                                    </div>


                                                                    <div class="bg-green-600 text-white p-8 rounded-xl">

                                                                        Card 2

                                                                    </div>


                                                                    <div class="bg-purple-600 text-white p-8 rounded-xl">

                                                                        Card 3

                                                                    </div>


                                                                </div>


                                                            </div>


                                                        </body>

                                                        </html>
                                                        HTML
                                                        ]
                                                        ];

                                                        @endphp

                                                        <div class="flex justify-between gap-2">

                                                            <!-- left site -->
                                                            <div id="content" class="overflow-y-auto h-screen pl-8 max-w-5xl py-10 pr-4">

                                                                @foreach($sections as $section)

                                                                <section id="{{ $section['id'] }}" class="animate-card mb-14 relative">
                                                                    <div class="glass rounded-3xl overflow-hidden border border-white/60 shadow-xl">

                                                                        <!-- Header -->
                                                                        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-7">
                                                                            <div class="flex items-center justify-between">
                                                                                <div>
                                                                                    <h2 class="text-3xl  font-black text-white">
                                                                                        {{ $section['title'] }}
                                                                                    </h2>
                                                                                    <p class="text-blue-100 mt-2">
                                                                                        Learn · Practice · Live Preview
                                                                                    </p>
                                                                                </div>
                                                                                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                                                                                    💻
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="grid lg:grid-cols-2">

                                                                            <!-- LEFT -->

                                                                            <div class="p-8">
                                                                                <h3 class="font-bold text-xl">
                                                                                    Explanation
                                                                                </h3>
                                                                                <p class="mt-4 text-slate-600 leading-8">
                                                                                    {{ $section['description'] }}
                                                                                </p>
                                                                                <div class="space-y-4 mt-8">

                                                                                    @foreach($section['points'] as $point)
                                                                                    <div class="rounded-2xl bg-slate-50 p-4 flex gap-3 items-center hover:bg-blue-50 duration-300">
                                                                                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                                                                            ✓
                                                                                        </div>
                                                                                        <div>
                                                                                            {!! $point !!}
                                                                                        </div>
                                                                                    </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>

                                                                            <!-- RIGHT -->

                                                                            <div class="bg-slate-950 ">
                                                                                <!-- Toolbar -->
                                                                                <div class="editorToolbar flex flex-wrap items-center justify-between gap-3 px-5 py-3 bg-[#1e1e1e] border-b border-slate-800">

                                                                                    <div class="flex items-center gap-2">

                                                                                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                                                                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                                                                                        <span class="w-3 h-3 rounded-full bg-green-500"></span>

                                                                                        <span class="ml-4 text-slate-400 text-sm">
                                                                                            index.html
                                                                                        </span>

                                                                                    </div>

                                                                                    <div class="flex flex-wrap gap-2">

                                                                                        <button class="fontMinus px-3 py-2 rounded-lg bg-slate-700 text-white">
                                                                                            A-
                                                                                        </button>

                                                                                        <button class="fontPlus px-3 py-2 rounded-lg bg-slate-700 text-white">
                                                                                            A+
                                                                                        </button>

                                                                                        <button class="wrapBtn px-3 py-2 rounded-lg bg-slate-700 text-white">
                                                                                            Wrap
                                                                                        </button>

                                                                                        <button class="fullscreenBtn px-3 py-2 rounded-lg bg-indigo-600 text-white">
                                                                                            Fullscreen
                                                                                        </button>

                                                                                        <button class="runBtn px-4 py-2 rounded-lg bg-green-600 text-white">
                                                                                            ▶ Run
                                                                                        </button>

                                                                                        <button class="copyBtn px-4 py-2 rounded-lg bg-sky-600 text-white">
                                                                                            Copy
                                                                                        </button>

                                                                                        <button class="resetBtn px-4 py-2 rounded-lg bg-amber-500 text-white">
                                                                                            Reset
                                                                                        </button>

                                                                                        <button class="downloadBtn px-4 py-2 rounded-lg bg-purple-600 text-white">
                                                                                            Download
                                                                                        </button>

                                                                                    </div>

                                                                                </div>
                                                                                <!-- HTML Editor -->

                                                                                <textarea class="editor w-full h-full bg-slate-950 text-green-400 font-mono text-sm p-5 outline-none resize-y"
                                                                                    spellcheck="false">{{ trim($section['code']) }}
                                                                                </textarea>

                                                                                <div class="previewWrapper absolute inset-0 hidden items-center justify-center bg-black/60 backdrop-blur-sm z-30">

                                                                                    <div class="previewCard w-[90%] max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden scale-75 opacity-0">

                                                                                        <!-- Header -->
                                                                                        <div class="flex items-center justify-between px-6 py-4 bg-slate-900">

                                                                                            <div>
                                                                                                <h3 class="text-white text-xl font-bold">
                                                                                                    Live Preview
                                                                                                </h3>
                                                                                                <p class="text-green-400 text-xs">
                                                                                                    HTML Output
                                                                                                </p>
                                                                                            </div>

                                                                                            <button
                                                                                                class="closePreview w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 text-white transition">
                                                                                                ✕
                                                                                            </button>

                                                                                        </div>

                                                                                        <iframe
                                                                                            class="preview w-full h-[600px] bg-white">
                                                                                        </iframe>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </section>

                                                                @endforeach
                                                            </div>
                                                            <!-- right site  -->
                                                            <div class="w-70 h-screen bg-gradient-to-br from-indigo-200 via-white to-purple-300 pt-1 pl-5 hidden md:flex">

                                                                <ul class="space-y-3">

                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-blue-600">
                                                                                <a href="#" onclick="goToSection('intro')">
                                                                                    introduction
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-green-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-green-600">
                                                                                <a href="#" onclick="goToSection('colors')">
                                                                                    Colors
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-purple-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-purple-600">
                                                                                <a href="#" onclick="goToSection('spacing')">
                                                                                    Spacing
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-orange-600">
                                                                                <a href="#" onclick="goToSection('flexbox')">
                                                                                    Flexbox
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                                                                                <a href="#" onclick="goToSection('responsive')">
                                                                                    Responsive
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('typography')">
                                                                                    Typography
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('forms')">
                                                                                    Forms
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('components')">
                                                                                    Components
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('animation')">
                                                                                    Animation
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('dark-mode')">
                                                                                    Dark mode
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('dashboard')">
                                                                                    Dashboard
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                                                                        <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                                                                        <div>
                                                                            <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                                                                                <a href="#" onclick="goToSection('advanced-responsive')">
                                                                                    Advanced
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
    </div>

    <script>
        function goToSection(id) {
            const container = document.getElementById('content');
            const target = document.getElementById(id);

            container.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        }
        document
            .querySelectorAll("section")
            .forEach(section => {

                const editor =
                    section.querySelector(".editor");

                const preview =
                    section.querySelector(".preview");

                const runBtn =
                    section.querySelector(".runBtn");

                const copyBtn =
                    section.querySelector(".copyBtn");

                const resetBtn =
                    section.querySelector(".resetBtn");

                const downloadBtn =
                    section.querySelector(".downloadBtn");
                const previewWrapper = section.querySelector(".previewWrapper");
                const closePreview = section.querySelector(".closePreview");

                const defaultCode =
                    editor.value;

                const previewCard = section.querySelector(".previewCard");


                function render() {

                    preview.srcdoc = editor.value;

                }

                // Run
                runBtn.onclick = () => {

                    render();

                    previewWrapper.classList.remove("hidden", "hide");

                    previewWrapper.classList.add("show");

                    runBtn.innerHTML = "✓ Running";

                    showToast("Running");

                    setTimeout(() => {

                        runBtn.innerHTML = "▶ Run";

                    }, 1000);

                };


                // Close
                closePreview.onclick = () => {

                    previewWrapper.classList.remove("show");

                    previewWrapper.classList.add("hide");

                    setTimeout(() => {

                        previewWrapper.classList.add("hidden");

                        preview.srcdoc = "";

                    }, 300);

                };

                // ======================
                // Copy
                // ======================

                copyBtn.onclick = async () => {

                    await navigator
                        .clipboard
                        .writeText(
                            editor.value
                        );

                    copyBtn.innerHTML = "✓ Copied";

                    setTimeout(() => {

                        copyBtn.innerHTML = "Copy";

                    }, 1500);

                };

                // ======================
                // Reset
                // ======================

                resetBtn.onclick = () => {

                    editor.value =
                        defaultCode;

                    render();

                };

                // ======================
                // Download
                // ======================

                downloadBtn.onclick = () => {

                    const blob =
                        new Blob(

                            [editor.value],

                            {
                                type: "text/html"
                            }

                        );

                    const url =
                        URL.createObjectURL(
                            blob
                        );

                    const a =
                        document.createElement("a");

                    a.href = url;

                    a.download = "index.html";

                    a.click();

                    URL.revokeObjectURL(url);

                };

            });
        document.querySelectorAll("section").forEach(section => {

            const editor = section.querySelector(".editor");

            const runBtn = section.querySelector(".runBtn");

            const copyBtn = section.querySelector(".copyBtn");

            const resetBtn = section.querySelector(".resetBtn");

            const downloadBtn = section.querySelector(".downloadBtn");

            const wrapBtn = section.querySelector(".wrapBtn");

            const plus = section.querySelector(".fontPlus");

            const minus = section.querySelector(".fontMinus");

            const fullscreen = section.querySelector(".fullscreenBtn");

            let size = 14;

            plus.onclick = () => {

                size++;

                editor.style.fontSize = size + "px";

            };

            minus.onclick = () => {

                if (size > 10) {

                    size--;

                    editor.style.fontSize = size + "px";

                }

            };

            let wrap = true;

            wrapBtn.onclick = () => {

                wrap = !wrap;

                editor.style.whiteSpace = wrap ? "pre-wrap" : "pre";

                showToast("Word Wrap");

            };

            fullscreen.onclick = () => {

                const panel = editor.parentElement;

                panel.classList.toggle("fullscreen-editor");

                fullscreen.innerHTML =

                    panel.classList.contains("fullscreen-editor")

                    ?
                    "Exit"

                    :
                    "Fullscreen";

            };

            copyBtn.addEventListener("click", () => {

                showToast("Copied");

            });

            resetBtn.addEventListener("click", () => {

                showToast("Reset");

            });

            downloadBtn.addEventListener("click", () => {

                showToast("Downloaded");

            });

            runBtn.addEventListener("click", () => {

                showToast("Running");

            });

            // editor.addEventListener("keydown", (e) => {

            //     if (e.ctrlKey && e.key === "Enter") {

            //         e.preventDefault();

            //         runBtn.click();

            //     }

            //     if (e.ctrlKey && e.key === "s") {

            //         e.preventDefault();

            //         downloadBtn.click();

            //     }

            // });
            // Keyboard Shortcut
            editor.addEventListener("keydown", (e) => {

                if (e.ctrlKey && e.key === "Enter") {

                    e.preventDefault();

                    runBtn.click();

                }

                if (e.ctrlKey && e.key.toLowerCase() === "s") {

                    e.preventDefault();

                    downloadBtn.click();

                }

            });

        });
    </script>

</div>

@endsection