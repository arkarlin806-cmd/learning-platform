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
                    H
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        HTML ( fronted language )
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Learn frontend html language. Useful for UI/UX design.
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
        'id'=>'lists',
        'title'=>'HTML Lists',
        'description'=>'Ordered နှင့် Unordered List များ ဖန်တီးနိုင်သည်။',

        'points'=>[
        '<ul> Unordered List',
            '<ol> Ordered List',
                '<li> List Item',
                    'Nested List'
                    ],

                    'code'=><<<HTML
                        <!DOCTYPE html>
                        <html>

                        <body style="font-size: 20px;">

                            <h2>Programming Languages</h2>

                            <ul>

                                <li>HTML</li>

                                <li>CSS</li>

                                <li>JavaScript</li>

                            </ul>

                            <ol>

                                <li>Learn HTML</li>

                                <li>Learn CSS</li>

                                <li>Learn JavaScript</li>

                            </ol>

                        </body>

                        </html>
                        HTML
                        ]
                        ,
                        [
                        'id'=>'images',
                        'title'=>'HTML Images',
                        'description'=>'Image များကို Web Page ပေါ်တွင် ဖော်ပြရန် အသုံးပြုသည်။',

                        'points'=>[
                        '<img> Tag',
                        'src Attribute',
                        'alt Attribute',
                        'width & height'
                        ],

                        'code'=><<<HTML
                            <!DOCTYPE html>
                            <html>

                            <body style="font-size: 20px;">

                                <h2>Image Example</h2>

                                <img
                                    src="https://picsum.photos/300"
                                    alt="Random Image"
                                    width="300">

                            </body>

                            </html>
                            HTML
                            ],
                            [
                            'id'=>'input-types',

                            'title'=>'HTML Input Types',

                            'description'=>'HTML တွင် Input Type များစွာရှိပြီး User ထံမှ Data အမျိုးမျိုးကို လက်ခံနိုင်သည်။',

                            'points'=>[
                            'text, email, password',
                            'number, date, time',
                            'color, range',
                            'file, url',
                            'search, tel'
                            ],

                            'code'=><<<HTML
                                <!DOCTYPE html>
                                <html>

                                <head>

                                    <style>
                                        body {
                                            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                                            padding: 30px;
                                            background: #f8fafc;
                                            font-size: 20px;
                                        }

                                        .container {
                                            max-width: 500px;
                                            margin: auto;
                                        }

                                        label {
                                            display: block;
                                            margin-top: 15px;
                                            font-weight: bold;
                                        }

                                        input {
                                            width: 100%;
                                            padding: 10px;
                                            margin-top: 6px;
                                            border: 1px solid #ccc;
                                            border-radius: 8px;
                                        }

                                        button {
                                            margin-top: 20px;
                                            padding: 12px 18px;
                                            background: #2563eb;
                                            color: white;
                                            border: none;
                                            border-radius: 8px;
                                            cursor: pointer;
                                        }
                                    </style>

                                </head>

                                <body>

                                    <div class="container">

                                        <h2>HTML Input Types</h2>

                                        <form>

                                            <label>Full Name</label>
                                            <input type="text">

                                            <label>Email</label>
                                            <input type="email">

                                            <label>Password</label>
                                            <input type="password">

                                            <label>Age</label>
                                            <input type="number">

                                            <label>Birthday</label>
                                            <input type="date">

                                            <label>Favorite Color</label>
                                            <input type="color">

                                            <label>Skill Level</label>
                                            <input type="range" min="0" max="100">

                                            <label>Upload Resume</label>
                                            <input type="file">

                                            <label>Website</label>
                                            <input type="url">

                                            <label>Phone</label>
                                            <input type="tel">

                                            <button>

                                                Submit

                                            </button>

                                        </form>

                                    </div>

                                </body>

                                </html>
                                HTML
                                ],
                                [
                                'id'=>'multimedia',

                                'title'=>'HTML Multimedia',

                                'description'=>'HTML5 တွင် Audio နှင့် Video များကို Plugin မလိုဘဲ Web Page ပေါ်တွင် တိုက်ရိုက်ဖွင့်နိုင်သည်။',

                                'points'=>[
                                '<audio> Audio Player',
                                    '<video> Video Player',
                                        'controls Attribute',
                                        'autoplay, loop, muted',
                                        'poster Attribute'
                                        ],

                                        'code'=><<<HTML
                                            <!DOCTYPE html>
                                            <html>

                                            <head>

                                                <style>
                                                    body {
                                                        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                                                        padding: 30px;
                                                        background: #f8fafc;
                                                        font-size: 20px;
                                                    }

                                                    .container {
                                                        max-width: 700px;
                                                        margin: auto;
                                                    }

                                                    video,
                                                    audio {
                                                        width: 100%;
                                                        margin-top: 15px;
                                                    }
                                                </style>

                                            </head>

                                            <body>

                                                <div class="container">

                                                    <h2>HTML Multimedia</h2>

                                                    <p>HTML5 Audio Example</p>

                                                    <audio controls>

                                                        <source src="sample.mp3" type="audio/mpeg">

                                                        Your browser does not support audio.

                                                    </audio>

                                                    <br><br>

                                                    <p>HTML5 Video Example</p>

                                                    <video
                                                        controls
                                                        poster="https://picsum.photos/700/350">

                                                        <source src="sample.mp4" type="video/mp4">

                                                        Your browser does not support video.

                                                    </video>

                                                </div>

                                            </body>

                                            </html>
                                            HTML
                                            ],[
                                            'id'=>'semantic',

                                            'title'=>'HTML Semantic Elements',

                                            'description'=>'Semantic Elements များသည် Web Page Structure ကို Meaningful ဖြစ်စေပြီး SEO နှင့် Accessibility ကို ကောင်းမွန်စေသည်။',

                                            'points'=>[
                                            'header',
                                            'nav',
                                            'main',
                                            'section',
                                            'article',
                                            'aside',
                                            'footer'
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
                                                            margin: 0;
                                                            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                                                            font-size: 20px;
                                                        }

                                                        header {
                                                            background: #2563eb;
                                                            color: white;
                                                            padding: 20px;
                                                        }

                                                        nav {
                                                            background: #1e40af;
                                                            padding: 15px;
                                                        }

                                                        nav a {
                                                            color: white;
                                                            margin-right: 15px;
                                                            text-decoration: none;
                                                        }

                                                        main {
                                                            display: flex;
                                                            gap: 20px;
                                                            padding: 20px;
                                                        }

                                                        section {
                                                            flex: 3;
                                                            background: #f8fafc;
                                                            padding: 20px;
                                                        }

                                                        aside {
                                                            flex: 1;
                                                            background: #e2e8f0;
                                                            padding: 20px;
                                                        }

                                                        footer {
                                                            background: #0f172a;
                                                            color: white;
                                                            padding: 20px;
                                                            text-align: center;
                                                        }
                                                    </style>

                                                </head>

                                                <body>

                                                    <header>

                                                        <h1>Learning Platform</h1>

                                                    </header>

                                                    <nav>

                                                        <a href="#">Home</a>

                                                        <a href="#">Courses</a>

                                                        <a href="#">Contact</a>

                                                    </nav>

                                                    <main>

                                                        <section>

                                                            <h2>HTML Course</h2>

                                                            <p>Learn HTML from beginner to advanced.</p>

                                                        </section>

                                                        <aside>

                                                            <h3>Related Courses</h3>

                                                            <ul>

                                                                <li>CSS</li>

                                                                <li>JavaScript</li>

                                                                <li>Laravel</li>

                                                            </ul>

                                                        </aside>

                                                    </main>

                                                    <footer>

                                                        Copyright 2026

                                                    </footer>

                                                </body>

                                                </html>
                                                HTML
                                                ],
                                                [
                                                'id'=>'advanced-forms',

                                                'title'=>'HTML Forms Advanced',

                                                'description'=>'HTML Form တွင် Input Types အမျိုးမျိုးကို အသုံးပြု၍ User Data လက်ခံနိုင်သည်။',

                                                'points'=>[
                                                'text',
                                                'email',
                                                'password',
                                                'date',
                                                'radio',
                                                'checkbox',
                                                'select',
                                                'textarea'
                                                ],

                                                'code'=><<<HTML
                                                    <!DOCTYPE html>
                                                    <html>

                                                    <head>

                                                        <style>
                                                            body {

                                                                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                                                                font-size: 20px;
                                                                padding: 30px;

                                                            }

                                                            input,
                                                            select,
                                                            textarea {

                                                                width: 100%;

                                                                padding: 12px;

                                                                margin-top: 6px;

                                                                margin-bottom: 15px;

                                                            }

                                                            button {

                                                                padding: 12px 18px;

                                                                background: #2563eb;

                                                                color: white;

                                                                border: none;

                                                                border-radius: 8px;

                                                                cursor: pointer;

                                                            }
                                                        </style>

                                                    </head>

                                                    <body>

                                                        <h2>Student Registration</h2>

                                                        <form>

                                                            <label>Name</label>

                                                            <input type="text">

                                                            <label>Email</label>

                                                            <input type="email">

                                                            <label>Password</label>

                                                            <input type="password">

                                                            <label>Birthday</label>

                                                            <input type="date">

                                                            <label>Gender</label>

                                                            <input type="radio" name="g"> Male

                                                            <input type="radio" name="g"> Female

                                                            <br><br>

                                                            <label>Skills</label>

                                                            <input type="checkbox"> HTML

                                                            <input type="checkbox"> CSS

                                                            <input type="checkbox"> JavaScript

                                                            <br><br>

                                                            <label>Country</label>

                                                            <select>

                                                                <option>Myanmar</option>

                                                                <option>Thailand</option>

                                                                <option>Japan</option>

                                                            </select>

                                                            <label>About You</label>

                                                            <textarea rows="5"></textarea>

                                                            <button>

                                                                Register

                                                            </button>

                                                        </form>

                                                    </body>

                                                    </html>
                                                    HTML
                                                    ],
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

                                                                                    <button class="wrapBtn hidden px-3 py-2 rounded-lg bg-slate-700 text-white">
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