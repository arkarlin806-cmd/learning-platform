<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Assistant</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --bg-1: #f8fbff;
            --bg-2: #eef6ff;
            --bg-3: #f6f1ff;
            --line: #e5e7eb;
            --line-soft: #edf2f7;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #2563eb;
            --primary-2: #4f46e5;
            --surface: #ffffff;
            --surface-soft: rgba(255, 255, 255, .72);
            --surface-strong: rgba(255, 255, 255, .9);
            --shadow: 0 10px 35px rgba(15, 23, 42, .08);
            --shadow-soft: 0 8px 24px rgba(15, 23, 42, .06);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            color: var(--text);
            background:
                radial-gradient(circle at top left, #e0f2fe 0%, transparent 30%),
                radial-gradient(circle at top right, #ede9fe 0%, transparent 28%),
                linear-gradient(135deg, var(--bg-1), var(--bg-2) 45%, var(--bg-3));
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .app-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glass {
            background: var(--surface-soft);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, .65);
            box-shadow: var(--shadow-soft);
        }

        .header-glass {
            background: rgba(255, 255, 255, .72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, .9);
        }

        .composer-glass {
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(226, 232, 240, .85);
            box-shadow: 0 12px 40px rgba(59, 130, 246, .10);
        }

        .chat-scroll {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        .message-enter {
            animation: messageIn .28s ease;
        }

        @keyframes messageIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            display: inline-block;
            background: #64748b;
            animation: bounce 1.2s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: .15s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: .3s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: translateY(0);
                opacity: .45;
            }

            40% {
                transform: translateY(-6px);
                opacity: 1;
            }
        }

        /* Markdown styling */
        .markdown {
            color: #0f172a;
            line-height: 1.75;
            font-size: 15px;
            word-break: break-word;
        }

        .markdown>*:first-child {
            margin-top: 0 !important;
        }

        .markdown>*:last-child {
            margin-bottom: 0 !important;
        }

        .markdown h1,
        .markdown h2,
        .markdown h3,
        .markdown h4 {
            color: #0f172a;
            font-weight: 700;
            margin-top: 1rem;
            margin-bottom: .65rem;
            line-height: 1.3;
        }

        .markdown h1 {
            font-size: 1.5rem;
        }

        .markdown h2 {
            font-size: 1.3rem;
        }

        .markdown h3 {
            font-size: 1.15rem;
        }

        .markdown h4 {
            font-size: 1rem;
        }

        .markdown p {
            margin: .8rem 0;
            color: #1e293b;
        }

        .markdown ul,
        .markdown ol {
            margin: .8rem 0;
            padding-left: 1.25rem;
        }

        .markdown ul {
            list-style: disc;
        }

        .markdown ol {
            list-style: decimal;
        }

        .markdown li {
            margin: .3rem 0;
            color: #1e293b;
        }

        .markdown blockquote {
            margin: 1rem 0;
            padding: .9rem 1rem;
            border-left: 4px solid #93c5fd;
            background: #eff6ff;
            border-radius: 14px;
            color: #1e3a8a;
        }

        .markdown a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .markdown a:hover {
            text-decoration: underline;
        }

        .markdown hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 1rem 0;
        }

        .markdown code {
            background: #eff6ff;
            color: #1e40af;
            padding: .2rem .45rem;
            border-radius: 8px;
            font-size: .92em;
            border: 1px solid #dbeafe;
        }

        .markdown pre {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 1rem;
            overflow: auto;
            margin: 1rem 0;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .7);
        }

        .markdown pre code {
            background: transparent;
            border: none;
            padding: 0;
            color: inherit;
        }

        .markdown table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        .markdown th,
        .markdown td {
            border: 1px solid #e2e8f0;
            padding: .75rem;
            text-align: left;
        }

        .markdown th {
            background: #f8fafc;
            font-weight: 700;
        }

        .bubble-shadow {
            box-shadow: var(--shadow);
        }

        .ai-actions button {
            transition: all .2s ease;
        }

        .ai-actions button:hover {
            color: #0f172a;
            transform: translateY(-1px);
        }

        .send-btn {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            box-shadow: 0 10px 25px rgba(79, 70, 229, .25);
            transition: all .2s ease;
        }

        .send-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(79, 70, 229, .28);
        }

        .send-btn:active {
            transform: scale(.98);
        }

        .chat-input {
            min-height: 52px;
            max-height: 140px;
            resize: none;
        }

        .fade-ring:focus {
            outline: none;
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, .12),
                0 10px 24px rgba(59, 130, 246, .08);
            border-color: #93c5fd;
        }

        .status-pill {
            background: linear-gradient(135deg, #dbeafe, #ede9fe);
            color: #334155;
            border: 1px solid #dbeafe;
        }

        .user-bubble {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            border-radius: 24px 24px 8px 24px;
        }

        .assistant-card {
            border-radius: 24px;
        }

        .top-fade {
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .bottom-sticky {
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .markdown {
                font-size: 14px;
                line-height: 1.7;
            }

            .mobile-pad {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .mobile-bubble {
                max-width: 92% !important;
            }

            .composer-wrap {
                padding: 12px;
            }

            .send-btn {
                min-width: 64px;
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        .code-box {
            background: #0f172a;
            color: #e2e8f0;
            padding: 16px;
            border-radius: 12px;
            font-size: 13px;
            overflow-x: auto;
        }

        .keyword {
            color: #60a5fa;
        }

        .func {
            color: #34d399;
        }

        .string {
            color: #fbbf24;
        }

        .comment {
            color: #94a3b8;
        }

        .fade {
            animation: fadeIn .5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body>
    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:relative z-50
                w-72 h-screen
                bg-white/95 backdrop-blur-lg
                shadow-2xl
                transition-all duration-300
                -translate-x-full lg:translate-x-0
                sidebar-animation">

            <!-- Logo -->
            <div
                class="h-20 flex items-center justify-between px-6 border-b">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-2xl
                                bg-gradient-to-br from-blue-500 to-indigo-600 text-white
                                flex items-center justify-center
                                font-bold text-xl">
                        AI
                    </div>

                    <div id="logoText">

                        <h2 class="font-bold text-lg">
                            <a href="{{ route('home.index') }}">AI Chatbot</a>
                        </h2>

                        <p class="text-xs text-gray-500">
                            Learning Platform
                        </p>

                    </div>

                </div>

                <button id="collapseBtn"
                    class="hidden lg:block text-xl">
                    ◀
                </button>

                <button id="closeSidebar"
                    class="lg:hidden text-2xl">
                    ✕
                </button>

            </div>

            <!-- Menu -->
            <nav class="p-4 md:space-y-2">

                <a href="{{ route('chat.index') }}"
                    class="menu-item flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-indigo-50 hover:translate-x-2 transition-all duration-300">

                    <i class="ri-bard-fill text-xl"></i>
                    <span class="menu-text">AI Chatbot</span>

                </a>
                <hr class="text-slate-300">


                <a href="{{ route('ai-images.img') }}"
                    class="menu-item flex items-center gap-4
                        px-4 py-1 md:py-3 rounded-2xl
                        hover:bg-indigo-50
                        hover:translate-x-2
                        transition-all duration-300">

                    <i class="ri-image-ai-line text-xl"></i>
                    <span class="menu-text">Image Generator</span>

                </a>
                <hr class="text-slate-300">
                <a href="{{ route('object-detection') }}"
                    class="menu-item flex items-center gap-4
                            px-4 py-1 md:py-3 rounded-2xl
                            hover:bg-indigo-50
                            hover:translate-x-2
                            transition-all duration-300">

                    <i class="ri-robot-2-line text-xl"></i>
                    <span class="menu-text">Computer Vision</span>

                </a>
                <hr class="text-slate-300">
                <a href="{{ route('sql-editor') }}"
                    class="menu-item flex items-center gap-4
                            px-4 py-1 md:py-3 rounded-2xl
                            hover:bg-indigo-50
                            hover:translate-x-2
                            transition-all duration-300">

                    <i class="ri-database-2-fill text-xl"></i>
                    <span class="menu-text">Database</span>

                </a>

                <hr class="text-slate-300">
                <div onclick="toggleSidebarDropdown('courseMenu',this)"
                    class="menu-item flex items-center gap-4
                px-4 py-1 md:py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2 flex justify-between
                transition-all duration-300">
                    <div class="">

                        <span>🛒</span>
                        <span class="menu-text">Frontend</span>
                    </div>
                    <i class="ri-arrow-down-s-line text-xl transition-transform duration-300 font-bold text-blue-800"></i>
                </div>


                <div
                    id="courseMenu"
                    class="grid grid-rows-[0fr] transition-all duration-500 overflow-hidden">

                    <div class="overflow-hidden">

                        <div class="ml-4 mt-2 space-y-2 border-l border-slate-200 pl-4">

                            <a href="{{ route('frontend.html') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                                <i class="ri-html5-line text-xl"></i>

                                <span>HTML</span>

                            </a>

                            <a href="{{ route('frontend.css') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                                <i class="ri-css3-line text-xl"></i>

                                <span>CSS</span>

                            </a>
                            <a href="{{ route('frontend.js') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                                <i class="ri-javascript-line text-2xl"></i>
                                <span>Javascript</span>

                            </a>
                            <a href="{{ route('frontend.tailwind') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-violet-50">

                                <i class="ri-tailwind-css-fill text-xl"></i>

                                <span>Tailwind CSS</span>

                            </a>


                        </div>

                    </div>

                </div>

                <hr class="text-slate-300">

                <a href="{{ route('comparison.index') }}"
                    class="menu-item flex items-center gap-4
                            px-4 py-1 md:py-3 rounded-2xl
                            hover:bg-indigo-50
                            hover:translate-x-2
                            transition-all duration-300 flex justify-between">

                    <span>
                        <i class="ri-code-ai-fill text-xl"></i>
                        <span class="menu-text pl-4">IT Course
                        </span>
                    </span>
                    <span class="text-green-600 text-semibold justify-end">(free)</span>

                </a>

            </nav>



        </aside>



        @yield('content')


    </div>


    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        document.getElementById('openSidebar')
            .addEventListener('click', () => {

                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');

            });

        document.getElementById('closeSidebar')
            .addEventListener('click', closeSidebar);

        overlay.addEventListener('click', closeSidebar);

        function closeSidebar() {

            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');

        }

        // const profileBtn = document.getElementById('profileBtn');
        // const profileMenu = document.getElementById('profileMenu');

        // profileBtn.addEventListener('click', () => {

        //     profileMenu.classList.toggle('hidden');

        // });

        const collapseBtn = document.getElementById('collapseBtn');

        collapseBtn.addEventListener('click', () => {

            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-24');

            document.querySelectorAll('.menu-text')
                .forEach(el => el.classList.toggle('hidden'));

            document.getElementById('logoText')
                .classList.toggle('hidden');

        });

        function toggleSidebarDropdown(id, button) {

            const menu = document.getElementById(id);

            const icon = button.querySelector(".ri-arrow-down-s-line");

            const opened =
                menu.classList.contains("grid-rows-[1fr]");

            document.querySelectorAll("[id$='Menu']").forEach(el => {
                el.classList.remove("grid-rows-[1fr]");
                el.classList.add("grid-rows-[0fr]");
            });

            document.querySelectorAll(".ri-arrow-down-s-line").forEach(el => {
                el.classList.remove("rotate-180");
            });

            if (!opened) {

                menu.classList.remove("grid-rows-[0fr]");
                menu.classList.add("grid-rows-[1fr]");

                icon.classList.add("rotate-180");

            }

        }
    </script>
</body>

</html>