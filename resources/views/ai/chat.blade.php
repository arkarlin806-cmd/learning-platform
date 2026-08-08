@extends('layout.ai')

@section('content')

<div class="app-shell w-full flex-1">

    <!-- Header -->
    <header class="top-fade header-glass">
        <div class="max-w-6xl mx-auto px-3 md:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <button id="openSidebar"
                    class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                    ☰
                </button>
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                    AI
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        AI Assistant
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Ask anything, get clean answers instantly
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

    <!-- Chat Area -->
    <main id="chat-box"
        class="chat-scroll flex-1 overflow-y-auto px-3 md:px-6 py-5 md:py-7 mobile-pad">
    </main>

    <!-- Connection Error -->
    <div id="connection-error"
        class="hidden mx-auto mb-3 w-[calc(100%-24px)] max-w-3xl rounded-2xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm shadow-sm">
        Connection failed. Please check your internet and try again.
    </div>

    <!-- Input -->
    <div class="bottom-sticky px-3 md:px-6 pb-3 md:pb-5 composer-wrap">
        <div class="max-w-4xl mx-auto">
            <div class="composer-glass rounded-[28px] p-2 md:p-3">
                <div class="flex items-end gap-2">
                    <textarea
                        id="message"
                        rows="1"
                        placeholder="Ask anything..."
                        class="chat-input fade-ring flex-1 rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400"></textarea>

                    <button
                        id="send-btn"
                        class="send-btn text-white h-[52px] px-5 rounded-2xl font-medium shrink-0">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    const conversationId = '{{ $conversation->id }}';
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message');
    let polling = null;

    function scrollBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }

    function autoResizeTextarea(el) {
        el.style.height = 'auto';
        el.style.height = Math.min(el.scrollHeight, 140) + 'px';
    }

    function userBubble(text) {
        return `<div class = "max-w-5xl mx-auto mb-6 message-enter" >
                <div class = "flex justify-end" >
                <div class = "mobile-bubble max-w-[85%] user-bubble px-4 py-1 bubble-shadow" >
                <div class = "py-3 break-words text-[15px] leading-7">
                ${ escapeHtml(text) } 
                </div> </div> </div> </div> `;
    }

    function aiBubble(text) {
        return `<div class = "max-w-5xl mx-auto mb-8 message-enter" >
                <div class = "flex gap-3 items-start" >
                <div class = "w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-sm font-semibold shadow-md shrink-0" >
                AI </div>

                <div class = "flex-1 min-w-0" >
                <div class = "assistant-card glass bubble-shadow px-4 md:px-5 py-4" >
                <div class = "markdown" >
                ${
                    marked.parse(text)
                } </div> </div>

                <div class = "ai-actions mt-3 flex items-center gap-4 pl-1" >
                <button
            onclick = "copyMessage(this)"
            class = "text-xs md:text-sm text-slate-500 hover:text-slate-900" >
            Copy
                </button>

                <button
            onclick = "regenerateMessage()"
            class = "text-xs md:text-sm text-slate-500 hover:text-slate-900" >
            Regenerate
                </button> </div> </div> </div> </div>`;
    }

    function typingBubble() {
        return `<div id = "typing"
            class = "max-w-5xl mx-auto mb-8 message-enter" >
            <div class = "flex gap-3 items-start" >
            <div class = "w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-sm font-semibold shadow-md shrink-0" >
            AI
                </div>

                <div class = "glass bubble-shadow rounded-3xl px-4 py-4" >
                <div class = "flex items-center gap-2" >
                <span class = "typing-dot" > </span> <span class = "typing-dot" > </span> 
                <span class = "typing-dot" > </span> </div> </div> </div> </div>`;
    }

    function removeTyping() {
        const typing = document.getElementById('typing');
        if (typing) typing.remove();
    }

    function copyMessage(button) {
        let text = button.parentElement.previousElementSibling.innerText;
        navigator.clipboard.writeText(text);
        const oldText = button.innerText;
        button.innerText = 'Copied';
        setTimeout(() => {
            button.innerText = oldText;
        }, 1500);
    }

    async function regenerateMessage() {
        try {
            await fetch('/chat/regenerate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    conversation_id: conversationId
                })
            });
            chatBox.innerHTML += typingBubble();
            scrollBottom();
            startPolling();
        } catch (e) {
            showConnectionError();
        }
    }

    async function loadMessages() {
        let response = await fetch(`{{ route('chat.messages') }}`);
        let messages = await response.json();

        chatBox.innerHTML = '';

        messages.forEach(msg => {
            if (msg.role === 'user') {
                chatBox.innerHTML += userBubble(msg.content);
            } else {
                chatBox.innerHTML += aiBubble(msg.content);
            }
        });

        setTimeout(() => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        }, 100);

        scrollBottom();
    }

    function startPolling() {

        if (polling) clearInterval(polling);

        polling = setInterval(async () => {

            try {

                let response = await fetch(`{{ route('chat.messages') }}`);

                let messages = await response.json();

                let last = messages[messages.length - 1];

                if (last && last.role === 'assistant') {

                    clearInterval(polling);
                    polling = null;

                    removeTyping();

                    const wrappers = chatBox.querySelectorAll(".assistant-card");

                    if (wrappers.length > 0) {

                        wrappers[wrappers.length - 1].parentElement.parentElement.parentElement.remove();

                    }

                    chatBox.insertAdjacentHTML("beforeend", aiBubble(""));

                    const markdowns = chatBox.querySelectorAll(".markdown");

                    const target = markdowns[markdowns.length - 1];

                    await typeWriter(target, last.content);

                }

            } catch (e) {

                clearInterval(polling);

                polling = null;

                removeTyping();

                showConnectionError();

            }

        }, 1500);

    }
    async function typeWriter(element, text, speed = 15) {

        let current = "";

        for (let i = 0; i < text.length; i++) {

            current += text[i];

            element.innerHTML = marked.parse(current);

            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });

            scrollBottom();

            await new Promise(resolve => setTimeout(resolve, speed));
        }
    }

    // function startPolling() {
    //     if (polling) clearInterval(polling);

    //     polling = setInterval(async () => {
    //         try {
    //             let response = await fetch(`{{ route('chat.messages') }}`);
    //             let messages = await response.json();
    //             let last = messages[messages.length - 1];

    //             if (last && last.role === 'assistant') {
    //                 clearInterval(polling);
    //                 polling = null;
    //                 removeTyping();
    //                 loadMessages();
    //             }
    //         } catch (e) {
    //             clearInterval(polling);
    //             polling = null;
    //             removeTyping();
    //             showConnectionError();
    //         }
    //     }, 1500);
    // }

    function showConnectionError() {
        const errorBox = document.getElementById('connection-error');
        errorBox.classList.remove('hidden');
        setTimeout(() => {
            errorBox.classList.add('hidden');
        }, 3000);
    }

    async function sendMessage() {
        let text = messageInput.value.trim();
        if (!text) return;

        chatBox.innerHTML += userBubble(text);
        chatBox.innerHTML += typingBubble();
        scrollBottom();

        messageInput.value = '';
        autoResizeTextarea(messageInput);

        try {
            let response = await fetch(`{{ route('chat.send') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: text,
                    conversation_id: conversationId
                })
            });

            if (!response.ok) throw new Error('Send failed');

            startPolling();
        } catch (error) {
            removeTyping();
            showConnectionError();
        }
    }

    document.getElementById('send-btn').addEventListener('click', sendMessage);

    messageInput.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    loadMessages();
    autoResizeTextarea(messageInput);
</script>

@endsection