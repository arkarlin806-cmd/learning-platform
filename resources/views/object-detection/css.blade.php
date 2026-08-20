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
                    C
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        CSS ( fronted language )
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Learn frontend CSS language. Useful for UI/UX design.
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

    <div class="flex justify-between gap-2 overflow-y-auto p-12">
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
        'id' => 'css-introduction',

        'title' => 'CSS Introduction',

        'description' => 'CSS (Cascading Style Sheets) သည် HTML Element များကို အရောင်၊ အရွယ်အစား၊ နေရာချထားမှုနှင့် Animation များ ထည့်သွင်းရန် အသုံးပြုသည်။ CSS ကို အသုံးပြုခြင်းဖြင့် Web Page များကို လှပပြီး Responsive ဖြစ်အောင် ပြုလုပ်နိုင်သည်။',

        'points' => [

        'CSS ဆိုတာဘာလဲ?',

        'Inline CSS (style Attribute)',



        'External CSS (.css File)',

        'CSS Syntax (Selector, Property, Value)',

        'Comments (/* Comment */)',

        'Best Practice - External CSS အသုံးပြုခြင်း'

        ],

        'code'=><<<HTML

            <!DOCTYPE html>
            <html>

            <head>
                <style>
                    body {

                        font-family: Arial, sans-serif;
                        background: #f1f5f9;
                        padding: 40px;

                    }

                    .card {

                        background: white;
                        padding: 30px;
                        border-radius: 16px;
                        box-shadow: 0 10px 25px rgba(0, 0, 0, .15);

                    }

                    h1 {

                        color: #2563eb;
                        margin-bottom: 10px;

                    }

                    p {

                        color: #475569;
                        line-height: 1.8;

                    }

                    button {

                        background: #2563eb;
                        color: white;
                        border: none;
                        padding: 12px 20px;
                        border-radius: 10px;
                        cursor: pointer;
                        transition: .3s;

                    }

                    button:hover {

                        background: #1d4ed8;
                        transform: translateY(-2px);

                    }
                </style>

            </head>

            <body>
                <div class="card">
                    <h1>Welcome to CSS</h1>
                    <p>

                        CSS makes your website beautiful and responsive.

                    </p>

                    <button>

                        Get Started

                    </button>

                </div>

            </body>

            </html>
            HTML
            ],
            [
            'id' => 'css-colors',

            'title' => 'CSS Colors',

            'description' => 'CSS Colors ကို Website ၏ စာသား၊ Background၊ Border နှင့် အခြား Element များ၏ အရောင်များ သတ်မှတ်ရန် အသုံးပြုသည်။ CSS တွင် Color Name, HEX, RGB, RGBA, HSL နှင့် HSLA စသည့် Color Format များကို အသုံးပြုနိုင်သည်။',

            'points' => [

            'color - Text Color သတ်မှတ်ခြင်း',

            'background-color - Background Color',

            'border-color - Border Color',

            'HEX Color (#2563eb)',

            'RGB & RGBA Color',

            'HSL & HSLA Color',

            'Opacity (Transparency)'

            ],

            'code' => <<<HTML
                <!DOCTYPE html>
                <html>

                <head>

                    <style>
                        body {

                            font-family: Arial, sans-serif;
                            background: #f1f5f9;
                            padding: 40px;

                        }

                        .container {

                            max-width: 900px;
                            margin: auto;

                        }

                        .card {

                            background: white;
                            padding: 30px;
                            border-radius: 18px;
                            box-shadow: 0 15px 35px rgba(0, 0, 0, .12);

                        }

                        h1 {

                            color: #2563eb;

                        }

                        .primary {

                            color: #2563eb;

                        }

                        .hex {

                            background: #2563eb;
                            color: white;
                            padding: 12px;
                            border-radius: 10px;
                            margin-top: 15px;

                        }

                        .rgb {

                            background: rgb(16, 185, 129);
                            color: white;
                            padding: 12px;
                            border-radius: 10px;
                            margin-top: 15px;

                        }

                        .rgba {

                            background: rgba(239, 68, 68, .75);
                            color: white;
                            padding: 12px;
                            border-radius: 10px;
                            margin-top: 15px;

                        }

                        .hsl {

                            background: hsl(280, 80%, 55%);
                            color: white;
                            padding: 12px;
                            border-radius: 10px;
                            margin-top: 15px;

                        }

                        button {

                            margin-top: 25px;
                            padding: 12px 20px;
                            border: none;
                            border-radius: 10px;
                            background: #0f172a;
                            color: white;
                            cursor: pointer;
                            transition: .3s;

                        }

                        button:hover {

                            background: #2563eb;
                            transform: translateY(-3px);

                        }
                    </style>

                </head>

                <body>

                    <div class="container">

                        <div class="card">

                            <h1>CSS Colors</h1>

                            <p class="primary">

                                This text uses the color property.

                            </p>

                            <div class="hex">

                                HEX Color : #2563eb

                            </div>

                            <div class="rgb">

                                RGB Color : rgb(16,185,129)

                            </div>

                            <div class="rgba">

                                RGBA Color : rgba(239,68,68,.75)

                            </div>

                            <div class="hsl">

                                HSL Color : hsl(280,80%,55%)

                            </div>

                            <button>

                                Hover Me

                            </button>

                        </div>

                    </div>

                </body>

                </html>
                HTML
                ],
                [
                'id'=>'css-selectors',

                'title'=>'CSS Selectors',

                'description'=>'CSS Selector များသည် HTML Element များကို ရွေးချယ်ပြီး Style ထည့်ရန် အသုံးပြုသည်။ Element, Class, ID နှင့် Pseudo Selector များကို အသုံးများသည်။',

                'points'=>[
                'Element Selector (tag name)',
                'Class Selector (.class)',
                'ID Selector (#id)',
                'Universal Selector (*)',
                'Pseudo Class (:hover)'
                ],

                'code'=><<<HTML
                    <!DOCTYPE html>
                    <html>

                    <head>

                        <style>
                            * {

                                box-sizing: border-box;

                            }

                            body {

                                font-family: Arial;
                                padding: 40px;
                                background: #f1f5f9;

                            }


                            /* Element Selector */

                            h1 {

                                color: #2563eb;

                            }


                            /* Class Selector */

                            .card {

                                background: white;
                                padding: 25px;
                                border-radius: 15px;
                                box-shadow: 0 10px 25px rgba(0, 0, 0, .15);

                            }


                            /* ID Selector */

                            #special {

                                color: #dc2626;
                                font-weight: bold;

                            }


                            /* Hover Selector */

                            button:hover {

                                background: #1d4ed8;

                            }


                            button {

                                background: #2563eb;
                                color: white;
                                padding: 12px 20px;
                                border: none;
                                border-radius: 8px;

                            }
                        </style>

                    </head>


                    <body>


                        <div class="card">


                            <h1>

                                CSS Selectors

                            </h1>


                            <p>

                                Normal Element Selector

                            </p>


                            <p id="special">

                                ID Selector Example

                            </p>


                            <button>

                                Hover Me

                            </button>


                        </div>


                    </body>

                    </html>
                    HTML
                    ],
                    [
                    'id'=>'css-text-fonts',

                    'title'=>'CSS Text & Fonts',

                    'description'=>'CSS Text နှင့် Fonts ကို အသုံးပြုပြီး စာသားပုံစံ၊ အရွယ်အစား၊ အကွာအဝေးနှင့် Font Style များကို ပြင်ဆင်နိုင်သည်။',

                    'points'=>[
                    'font-family',
                    'font-size',
                    'font-weight',
                    'text-align',
                    'line-height',
                    'letter-spacing'
                    ],

                    'code'=><<<HTML
                        <!DOCTYPE html>
                        <html>

                        <head>

                            <style>
                                body {

                                    font-family: Arial;
                                    padding: 40px;
                                    background: #f8fafc;

                                }


                                .card {

                                    background: white;
                                    padding: 30px;
                                    border-radius: 20px;

                                }


                                h1 {

                                    font-size: 40px;
                                    font-weight: 900;
                                    text-align: center;
                                    color: #2563eb;

                                }


                                .text {

                                    font-size: 20px;
                                    line-height: 1.8;
                                    letter-spacing: 1px;
                                    text-align: justify;

                                }


                                .bold {

                                    font-weight: bold;

                                }


                                .italic {

                                    font-style: italic;

                                }
                            </style>

                        </head>


                        <body>


                            <div class="card">


                                <h1>

                                    CSS Typography

                                </h1>


                                <p class="text">

                                    CSS allows developers to control text appearance.
                                    You can change font size, weight, spacing and alignment.

                                </p>


                                <p class="bold">

                                    Bold Text Example

                                </p>


                                <p class="italic">

                                    Italic Text Example

                                </p>


                            </div>


                        </body>

                        </html>
                        HTML
                        ],
                        [
                        'id'=>'css-box-model',

                        'title'=>'CSS Box Model',

                        'description'=>'CSS Box Model သည် HTML Element တစ်ခု၏ Content, Padding, Border နှင့် Margin ကို ထိန်းချုပ်ရန် အသုံးပြုသည်။',

                        'points'=>[
                        'Content',
                        'Padding',
                        'Border',
                        'Margin',
                        'Box Shadow',
                        'Border Radius'
                        ],

                        'code'=><<<HTML
                            <!DOCTYPE html>
                            <html>

                            <head>

                                <style>
                                    body {

                                        font-family: Arial;
                                        background: #f1f5f9;
                                        padding: 40px;

                                    }


                                    .box {


                                        width: 350px;

                                        background: #2563eb;

                                        color: white;


                                        /* Content */

                                        padding: 30px;


                                        /* Border */

                                        border: 8px solid #1e40af;


                                        /* Margin */

                                        margin: auto;


                                        /* Rounded Corner */

                                        border-radius: 20px;


                                        /* Shadow */

                                        box-shadow:
                                            0 20px 40px rgba(0, 0, 0, .25);


                                    }


                                    .inner {


                                        background: white;

                                        color: #0f172a;

                                        padding: 20px;

                                        border-radius: 12px;


                                    }
                                </style>


                            </head>


                            <body>


                                <div class="box">


                                    <div class="inner">


                                        <h2>

                                            CSS Box Model

                                        </h2>


                                        <p>

                                            Content + Padding + Border + Margin

                                        </p>


                                    </div>


                                </div>


                            </body>

                            </html>
                            HTML
                            ],
                            [
                            'id'=>'css-position',

                            'title'=>'CSS Position',

                            'description'=>'CSS Position သည် HTML Element များကို Page အတွင်း နေရာချထားရန် အသုံးပြုသည်။ Static, Relative, Absolute, Fixed နှင့် Sticky Position များရှိသည်။',

                            'points'=>[
                            'position: static',
                            'position: relative',
                            'position: absolute',
                            'position: fixed',
                            'position: sticky',
                            'top, left, right, bottom'
                            ],

                            'code'=><<<HTML
                                <!DOCTYPE html>
                                <html>

                                <head>

                                    <style>
                                        body {

                                            font-family: Arial;
                                            height: 1500px;
                                            padding: 30px;
                                            background: #f1f5f9;

                                        }


                                        .container {

                                            position: relative;

                                            height: 400px;

                                            background: white;

                                            padding: 30px;

                                            border-radius: 20px;

                                        }


                                        .relative {

                                            position: relative;

                                            left: 30px;

                                            background: #2563eb;

                                            color: white;

                                            padding: 15px;

                                        }


                                        .absolute {

                                            position: absolute;

                                            right: 30px;

                                            top: 100px;

                                            background: #16a34a;

                                            color: white;

                                            padding: 15px;

                                            border-radius: 10px;

                                        }


                                        .fixed {

                                            position: fixed;

                                            bottom: 30px;

                                            right: 30px;

                                            background: #dc2626;

                                            color: white;

                                            padding: 15px;

                                            border-radius: 50px;

                                        }


                                        .sticky {

                                            position: sticky;

                                            top: 10px;

                                            background: #9333ea;

                                            color: white;

                                            padding: 15px;

                                        }
                                    </style>

                                </head>


                                <body>


                                    <div class="sticky">

                                        Sticky Header

                                    </div>


                                    <div class="container">


                                        <h2>

                                            CSS Position

                                        </h2>


                                        <div class="relative">

                                            Relative

                                        </div>


                                        <div class="absolute">

                                            Absolute

                                        </div>


                                    </div>


                                    <button class="fixed">

                                        Fixed

                                    </button>


                                </body>

                                </html>
                                HTML
                                ],

                                [
                                'id'=>'css-animation',

                                'title'=>'CSS Animation',

                                'description'=>'CSS Animation ကို အသုံးပြုပြီး Element များကို Movement, Color Change နှင့် Effect များ ထည့်နိုင်သည်။',

                                'points'=>[
                                '@keyframes',
                                'animation-name',
                                'animation-duration',
                                'animation-delay',
                                'animation-iteration-count',
                                'animation-direction'
                                ],

                                'code'=><<<HTML
                                    <!DOCTYPE html>
                                    <html>

                                    <head>

                                        <style>
                                            body {

                                                font-family: Arial;
                                                padding: 50px;
                                                background: #f8fafc;

                                            }


                                            .box {

                                                width: 120px;

                                                height: 120px;

                                                background: #2563eb;

                                                border-radius: 20px;

                                                animation:

                                                    move 3s infinite alternate;


                                            }


                                            @keyframes move {


                                                0% {

                                                    transform: translateX(0);

                                                    background: #2563eb;

                                                }


                                                50% {

                                                    transform: translateX(250px);

                                                    background: #16a34a;

                                                }


                                                100% {

                                                    transform: translateX(500px);

                                                    background: #dc2626;

                                                }


                                            }
                                        </style>

                                    </head>


                                    <body>


                                        <h2>

                                            CSS Animation

                                        </h2>


                                        <div class="box">

                                        </div>


                                    </body>

                                    </html>
                                    HTML
                                    ],
                                    [
                                    'id'=>'css-media-query',

                                    'title'=>'CSS Media Queries',

                                    'description'=>'Media Query ကို အသုံးပြုပြီး Device Screen Size အလိုက် Responsive Design ပြုလုပ်နိုင်သည်။',

                                    'points'=>[
                                    '@media rule',
                                    'Mobile Design',
                                    'Tablet Design',
                                    'Desktop Design',
                                    'Responsive Layout'
                                    ],

                                    'code'=><<<HTML
                                        <!DOCTYPE html>
                                        <html>

                                        <head>

                                            <style>
                                                body {

                                                    font-family: Arial;
                                                    padding: 30px;

                                                }


                                                .container {

                                                    display: flex;

                                                    gap: 20px;

                                                }


                                                .card {

                                                    flex: 1;

                                                    padding: 30px;

                                                    background: #2563eb;

                                                    color: white;

                                                    border-radius: 15px;

                                                }


                                                /* Mobile */

                                                @media(max-width:600px) {


                                                    .container {

                                                        flex-direction: column;

                                                    }


                                                    .card {

                                                        background: #16a34a;

                                                    }


                                                }


                                                /* Tablet */

                                                @media(min-width:601px) and (max-width:900px) {


                                                    .card {

                                                        background: #9333ea;

                                                    }


                                                }
                                            </style>

                                        </head>


                                        <body>


                                            <h2>

                                                Responsive Design

                                            </h2>


                                            <div class="container">


                                                <div class="card">

                                                    Card One

                                                </div>


                                                <div class="card">

                                                    Card Two

                                                </div>


                                            </div>


                                        </body>

                                        </html>
                                        HTML
                                        ],
                                        [
                                        'id'=>'css-modern-layout',

                                        'title'=>'CSS Modern Layout Techniques',

                                        'description'=>'Modern Website များတွင် Flexbox, Grid, Variables နှင့် Responsive Techniques များကို ပေါင်းစပ်အသုံးပြုကြသည်။',

                                        'points'=>[
                                        'CSS Variables',
                                        'Flexbox',
                                        'Grid Layout',
                                        'Responsive Cards',
                                        'Modern UI Design'
                                        ],

                                        'code'=><<<HTML
                                            <!DOCTYPE html>
                                            <html>

                                            <head>

                                                <style>
                                                    :root {

                                                        --primary: #2563eb;

                                                        --radius: 20px;

                                                        --shadow:
                                                            0 20px 40px rgba(0, 0, 0, .15);

                                                    }


                                                    body {

                                                        font-family: Arial;

                                                        padding: 40px;

                                                        background: #f1f5f9;

                                                    }


                                                    .wrapper {


                                                        display: grid;

                                                        grid-template-columns:

                                                            repeat(auto-fit, minmax(250px, 1fr));

                                                        gap: 25px;


                                                    }


                                                    .card {


                                                        background: white;

                                                        padding: 30px;

                                                        border-radius: var(--radius);

                                                        box-shadow: var(--shadow);

                                                        transition: .3s;


                                                    }


                                                    .card:hover {


                                                        transform: translateY(-10px);


                                                    }


                                                    .title {

                                                        color: var(--primary);

                                                        font-size: 25px;

                                                        font-weight: bold;


                                                    }
                                                </style>

                                            </head>


                                            <body>


                                                <h1>

                                                    Modern CSS Layout

                                                </h1>


                                                <div class="wrapper">


                                                    <div class="card">

                                                        <div class="title">

                                                            Flexbox

                                                        </div>

                                                        <p>

                                                            Modern alignment system

                                                        </p>

                                                    </div>


                                                    <div class="card">

                                                        <div class="title">

                                                            Grid

                                                        </div>

                                                        <p>

                                                            Responsive columns

                                                        </p>

                                                    </div>


                                                    <div class="card">

                                                        <div class="title">

                                                            Variables

                                                        </div>

                                                        <p>

                                                            Reusable styles

                                                        </p>

                                                    </div>


                                                </div>


                                            </body>

                                            </html>
                                            HTML
                                            ]
                                            ];

                                            @endphp

                                            <div class="grid grid-cols-1">
                                                @foreach($sections as $section)

                                                <section id="{{ $section['id'] }}" class="animate-card mb-14 relative">
                                                    <div class="glass rounded-3xl overflow-hidden border border-white/60 shadow-xl">

                                                        <!-- Header -->
                                                        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-7">
                                                            <div class="flex items-center justify-between">
                                                                <div>
                                                                    <h2 class="text-xl md:text-3xl  font-black text-white">
                                                                        {{ $section['title'] }}
                                                                    </h2>
                                                                    <p class="text-blue-100 mt-2 md:text-md text-xs">
                                                                        Learn · Practice · Live Preview
                                                                    </p>
                                                                </div>
                                                                <div class="md:w-16 md:h-16 w-8 h-8 rounded-lg md:rounded-2xl bg-white/20 flex items-center justify-center text-lg md:text-3xl">
                                                                    💻
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="grid lg:grid-cols-2">

                                                            <!-- LEFT -->

                                                            <div class="p-8">
                                                                <h3 class="font-bold text-md md:text-xl">
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
    </div>

    <script>
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