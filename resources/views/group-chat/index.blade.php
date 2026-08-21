<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Learning Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link
        href="https://unpkg.com/aos@2.3.4/dist/aos.css"
        rel="stylesheet">
    <style>
        ::-webkit-scrollbar {

            width: 8px;
            height: 8px;

        }

        ::-webkit-scrollbar-track {

            background: #eef2ff;
            border-radius: 20px;

        }

        ::-webkit-scrollbar-thumb {

            background: linear-gradient(180deg,
                    #3b82f6,
                    #6366f1,
                    #10b981);

            border-radius: 20px;

        }

        ::-webkit-scrollbar-thumb:hover {

            background: linear-gradient(180deg,
                    #2563eb,
                    #4f46e5,
                    #059669);

        }

        /* Chat Layout */
        .chat-area {
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .messages {
            flex: 1;
            overflow-y: auto;

        }

        /* Chat Row & Profile Icon Styles */
        .chat-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 18px;
            gap: 10px;
            width: 100%;
        }

        .chat-row.row-me {
            flex-direction: row-reverse;
        }

        .course-item a {
            text-decoration: none;
            color: black;
        }

        .chat-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #6f42c1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chat-row.row-me .chat-avatar {
            background: #20c997;
        }

        .msg-wrapper {
            max-width: 65%;
            display: flex;
            flex-direction: column;
        }

        .chat-row.row-me .msg-wrapper {
            align-items: flex-end;
        }

        .chat-row.row-other .msg-wrapper {
            align-items: flex-start;
        }

        .user-name {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
            padding: 0 5px;
        }

        /* Message Box Style */
        .message-box {
            padding: 14px 14px;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.07);
            cursor: pointer;
            transition: transform 0.1s ease;
            user-select: none;
            display: inline-block;
        }

        .message-box:active {
            transform: scale(0.98);
        }

        .row-me .message-box {
            background: #6f42c1;
            color: white;
            border-bottom-right-radius: 2px;
            text-align: left;
        }

        .row-other .message-box {
            background: white;
            color: #333;
            border-bottom-left-radius: 2px;
        }

        /* Image No Extra Space Style */
        .msg-image-only {
            padding: 0 !important;
            overflow: hidden;
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        .msg-image-only img {
            max-width: 280px;
            border-radius: 14px;
            display: block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        /* Reply Container inside Message */
        .telegram-reply-box {
            border-left: 3px solid #3897f0;
            background: rgba(0, 0, 0, 0.05);
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .row-me .telegram-reply-box {
            border-left-color: #24cdff;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .telegram-reply-user {
            font-weight: bold;
            color: #3897f0;
            display: block;
            font-size: 11px;
        }

        .row-me .telegram-reply-user {
            color: #24cdff;
        }

        /* Custom Action Dropdown Context Menu */
        .msg-dropdown-menu {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            z-index: 1000;
            padding: 5px 0;
            min-width: 110px;
        }

        .msg-dropdown-menu button {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 8px 14px;
            font-size: 13px;
            color: #333;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .msg-dropdown-menu button:hover {
            background: #f1f3f5;
        }

        .msg-dropdown-menu button.text-danger:hover {
            background: #fff5f5;
        }

        /* Input Area Styles */
        .chat-input {
            background: white;
            border-top: 1px solid #ddd;
            padding: 20px;
        }

        .telegram-reply-preview {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border-left: 4px solid #3897f0;
            padding: 6px 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.02);
        }

        .reply-preview-icon {
            font-size: 14px;
            color: #3897f0;
            margin-right: 12px;
        }

        .reply-preview-title {
            font-size: 12px;
            font-weight: bold;
            color: #3897f0;
            margin-bottom: 2px;
        }

        .reply-preview-text {
            font-size: 13px;
            color: #555555;
        }
    </style>

</head>

<body class="bg-slate-100">

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
                    bg-indigo-600
                    text-white
                    flex items-center justify-center
                    font-bold text-xl">
                        @if($isInstructor)
                        I
                        @else
                        L
                        @endif
                    </div>

                    <div id="logoText">

                        <h5 class="font-bold text-lg">
                            @if($isInstructor)
                            Instructor
                            @else
                            Learner
                            @endif
                        </h5>

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
            <nav class="px-4 py-2 space-y-1">

                <a @if(auth()->user()->role == 2) href="{{ route('instructor.index') }}" @else href="{{ route('profile.index') }}" @endif
                    class="menu-item flex items-center gap-4
                    px-4 py-3 rounded-2xl
                    hover:bg-indigo-50
                    hover:translate-x-2
                    transition-all duration-300">

                    <i class="ri-home-4-line text-xl"></i>
                    <span class="menu-text">Home</span>

                </a>
                <hr class="text-sky-200">
                <a href="{{ route('instructor.single_course', $course->id) }}"
                    class="menu-item flex items-center gap-4
                    px-4 py-3 rounded-2xl
                    hover:bg-indigo-50
                    hover:translate-x-2
                    transition-all duration-300">

                    <i class="ri-book-3-line text-xl"></i>
                    <span class="menu-text">Course Info</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('instructor.learners', $course->id) }}"
                    class="menu-item flex items-center gap-4
                        px-4 py-3 rounded-2xl
                        hover:bg-indigo-50
                        hover:translate-x-2
                        transition-all duration-300">

                    <i class="ri-group-line text-xl"></i>
                    <span class="menu-text">Learner</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('lesson.show', $course->id) }}"
                    class="menu-item flex items-center gap-4
                        px-4 py-3 rounded-2xl
                        hover:bg-indigo-50
                        hover:translate-x-2
                        transition-all duration-300">

                    <i class="ri-video-upload-line text-xl"></i>
                    <span class="menu-text">Lessons</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('quiz.quiz_all', $course->id) }}"
                    class="menu-item flex items-center gap-4
                            px-4 py-3 rounded-2xl
                            hover:bg-indigo-50
                            hover:translate-x-2
                            transition-all duration-300">

                    <i class="ri-questionnaire-line text-xl"></i>
                    <span class="menu-text">Assignment</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('courses.live.index', $course) }}"
                    class="menu-item flex items-center gap-4
                    px-4 py-3 rounded-2xl
                    hover:bg-indigo-50
                    hover:translate-x-2
                    transition-all duration-300">

                    <i class="ri-phone-line text-xl"></i>
                    <span class="menu-text">Live Room</span>

                </a>
                <hr class="text-sky-200">

                <a href="{{ route('learner.chat',$course) }}"
                    class="menu-item flex items-center gap-4
                    px-4 py-3 rounded-2xl
                    hover:bg-indigo-50
                    hover:translate-x-2
                    transition-all duration-300">

                    <i class="ri-slack-line text-xl"></i>
                    <span class="menu-text">Chat</span>

                </a>
                <hr class="text-sky-200">

                @if(auth()->user()->role == 2)
                <a href="{{ route('instructor.certificates.index',$course) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-bard-line text-xl"></i>
                    <span class="menu-text">Certificates</span>

                </a>
                @else
                <a href="{{ route('learner.certificate', $course->id) }}"
                    class="menu-item flex items-center gap-4
                px-4 py-3 rounded-2xl
                hover:bg-indigo-50
                hover:translate-x-2
                transition-all duration-300">

                    <i class="ri-bard-line text-xl"></i>
                    <span class="menu-text">Certificates</span>

                </a>
                @endif
            </nav>


        </aside>



        <!-- mani content  -->
        <div class=" h-screen flex-1 overflow-y-auto">

            <!-- Topbar -->
            <header
                class="h-20 bg-white shadow-sm
            flex items-center justify-between
            px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-xl md:text-3xl">

                        ☰

                    </button>

                    <h4 class="font-bold text-xl text-purple-700">
                        {{$course->title}}
                        <p class="text-slate-600 text-sm">Group Chat ( Discussion )</p>
                    </h4>

                </div>

                <div class="flex items-center gap-5">

                    <span class="py-1 px-4 rounded-2xl bg-blue-100/50 border border-blue-200 text-slate-700 text-sm">group chat</span>

                </div>

            </header>
            <div class="bg-gradient-to-r from-sky-100 via-white to-indigo-100">
                <section class="">
                    <div class="chat-area h-[695px]">

                        <div class="messages pl-3 md:pl-16 pr-4 pt-2" id="messagesBox">
                            @forelse($messages as $message)
                            @php
                            $currentUserId = request()->query('user_id', auth()->id());
                            $isMe = ($message->user_id == $currentUserId);
                            $hasText = !empty(trim($message->message));
                            $hasAttachment = $message->attachments->count() > 0;
                            $isImageOnly = (!$hasText && $hasAttachment && in_array(strtolower($message->attachments->first()->type), ['jpg', 'jpeg', 'png', 'gif', 'webp']));
                            @endphp


                            <div class="chat-row {{ $isMe ? 'row-me' : 'row-other' }}" id="msg-row-{{ $message->id }}">


                                <div class="chat-avatar" title="{{ $message->user->name ?? 'User' }}">
                                    {{ strtoupper(substr($message->user->name ?? 'U', 0, 1)) }}
                                </div>

                                <div class="msg-wrapper">

                                    <div class="user-name">{{ $message->user->name ?? 'User' }}</div>


                                    <div class="message-box {{ $isImageOnly ? 'msg-image-only' : '' }}"
                                        onclick="toggleContextMenu(event, '{{ $message->id }}', `{{ $isMe ? 'me' : 'other' }}`, `{{ addslashes($message->message ?? '') }}`, `{{ $message->user->name ?? 'User' }}`)">

                                        @if($message->reply)
                                        <div class="telegram-reply-box">
                                            <span class="telegram-reply-user">{{ $message->reply->user->name ?? 'User' }}</span>
                                            <div class="text-truncate" style="max-width: 240px;">{{ $message->reply->message }}</div>
                                        </div>
                                        @endif

                                        @if($hasText)
                                        <div class="text-wrap msg-text" id="text-{{ $message->id }}" style="font-size: 15px; word-break: break-word;">{{ $message->message }}</div>
                                        @endif

                                        <!-- Attachments -->
                                        @foreach($message->attachments as $attachment)
                                        @php $extension = strtolower($attachment->type); @endphp
                                        <div class="{{ $hasText ? 'mt-2' : '' }}">
                                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ asset('storage/' . $attachment->file) }}" class="img-fluid">
                                            @else
                                            <a href="{{ asset('storage/chat-attachments/' . $attachment->file) }}" target="_blank" class="btn btn-sm btn-light py-1 px-2 border">
                                                <i class="fa-solid fa-file-lines me-1"></i> {{ Str::limit($attachment->file, 20) }}
                                            </a>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>

                                    <!-- Time & Edited Label -->
                                    <div style="font-size: 10px; color: #999; margin-top: 2px; display: flex; gap: 6px;">
                                        <span>{{ $message->created_at?->timezone('Asia/Yangon')->format('h:i A') ?? 'Just now' }}</span>
                                        <span id="edited-label-{{ $message->id }}" class="{{ $message->is_edited ? '' : 'hidden' }} text-muted">(edited)</span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-muted mt-5" id="no-msg-text">No messages yet.</div>
                            @endforelse
                        </div>


                        <div id="contextMenuBox" class="msg-dropdown-menu">
                            <button type="button" id="menuReplyBtn"><i class="fa-solid fa-reply text-primary"></i> Reply</button>
                            <button type="button" id="menuEditBtn" class="d-none"><i class="fa-solid fa-pen text-warning"></i> Edit</button>
                            <button type="button" id="menuDeleteBtn" class="text-danger d-none"><i class="fa-solid fa-trash"></i> Delete</button>
                        </div>

                        <div class="chat-input">

                            <form id="chatForm" action="{{ route('learner.chat.send', $course->id) }}{{ request()->has('user_id') ? '?user_id=' . request('user_id') : '' }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div id="replyPreviewBox"
                                    class="hidden mb-3 overflow-hidden rounded-2xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 shadow-lg">

                                    <div class="flex items-center justify-between px-4 py-3">

                                        <div class="flex items-start gap-3 flex-1 min-w-0">

                                            <div
                                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                                                <i class="ri-reply-line text-lg"></i>
                                            </div>

                                            <div class="min-w-0 flex-1">

                                                <p id="replyUserTitle"
                                                    class="truncate text-sm font-bold text-blue-700">
                                                    Reply to User
                                                </p>

                                                <p id="replyPreviewText"
                                                    class="mt-1 truncate text-sm text-slate-600">
                                                </p>

                                            </div>

                                        </div>

                                        <button
                                            type="button"
                                            onclick="cancelReply()"
                                            class="ml-3 rounded-xl p-2 text-slate-500 transition hover:bg-red-100 hover:text-red-600">

                                            <i class="ri-close-line text-xl"></i>

                                        </button>

                                    </div>

                                </div>

                                <input type="hidden" name="reply_id" id="reply_id">

                                <div class="flex items-center gap-3">

                                    <label
                                        for="attachment"
                                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded-xl bg-slate-100 transition hover:bg-blue-100 hover:text-blue-600">

                                        <i class="ri-attachment-2 text-xl"></i>

                                    </label>

                                    <input
                                        type="file"
                                        id="attachment"
                                        name="attachment"
                                        hidden>

                                    <input
                                        id="messageInput"
                                        name="message"
                                        type="text"
                                        autocomplete="off"
                                        placeholder="Type a message..."
                                        class="h-12 flex-1 rounded-xl border border-slate-200 bg-white px-4 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

                                    <button
                                        type="submit"
                                        class="flex h-12 items-center gap-2 rounded-xl bg-blue-600 px-6 font-semibold text-white transition hover:bg-blue-700 active:scale-95">

                                        <i class="ri-send-plane-fill"></i>

                                        <span>Send</span>

                                    </button>

                                </div>

                            </form>
                        </div>
                    </div>
                </section>

                <!-- Edit Modal -->
                <div id="editModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

                    <div class="w-full max-w-lg mx-4 rounded-2xl bg-white shadow-2xl">

                        <!-- Header -->
                        <div class="flex items-center justify-between border-b px-6 py-4">
                            <h2 class="text-xl font-bold text-gray-800">
                                Edit Message
                            </h2>

                            <button
                                type="button"
                                onclick="closeEditModal()"
                                class="text-2xl text-gray-400 hover:text-red-500 transition">
                                &times;
                            </button>
                        </div>

                        <!-- Body -->
                        <div class="p-6">

                            <input type="hidden" id="edit-msg-id">

                            <textarea
                                id="edit-msg-text"
                                rows="5"
                                class="w-full rounded-xl border border-gray-300 p-4 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Edit your message..."></textarea>

                        </div>

                        <!-- Footer -->
                        <div class="flex justify-end gap-3 border-t px-6 py-4">

                            <button
                                type="button"
                                onclick="closeEditModal()"
                                class="rounded-xl border px-5 py-2 hover:bg-gray-100">
                                Cancel
                            </button>

                            <button
                                id="saveEditBtn"
                                type="button"
                                class="rounded-xl bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                                Save Changes
                            </button>

                        </div>

                    </div>

                </div>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    const messagesBox = document.getElementById('messagesBox');
                    const chatForm = document.getElementById('chatForm');
                    const messageInput = document.getElementById('messageInput');
                    const attachmentInput = document.getElementById('attachment');

                    const replyPreviewBox = document.getElementById('replyPreviewBox');
                    const replyUserTitle = document.getElementById('replyUserTitle');
                    const replyPreviewText = document.getElementById('replyPreviewText');
                    const replyIdInput = document.getElementById('reply_id');
                    const editModal = document.getElementById("editModal");


                    const contextMenuBox = document.getElementById('contextMenuBox');
                    let userTypedText = "";

                    function scrollToBottom() {
                        messagesBox.scrollTop = messagesBox.scrollHeight;
                    }
                    scrollToBottom();


                    function toggleContextMenu(event, id, type, msgContent, userName) {
                        event.stopPropagation();

                        contextMenuBox.style.display = 'block';
                        contextMenuBox.style.top = (event.pageY - 10) + 'px';
                        contextMenuBox.style.left = (event.pageX > (window.innerWidth - 150) ? event.pageX - 120 : event.pageX) + 'px';

                        document.getElementById('menuReplyBtn').onclick = function() {
                            handleReply(id, msgContent || 'Attachment', userName);
                        };

                        if (type === 'me') {
                            document.getElementById('menuEditBtn').classList.remove('d-none');
                            document.getElementById('menuDeleteBtn').classList.remove('d-none');
                            document.getElementById('menuEditBtn').onclick = function() {
                                handleEdit(id);
                            };
                            document.getElementById('menuDeleteBtn').onclick = function() {
                                handleDelete(id);
                            };
                        } else {
                            document.getElementById('menuEditBtn').classList.add('d-none');
                            document.getElementById('menuDeleteBtn').classList.add('d-none');
                        }
                    }


                    document.addEventListener('click', function() {
                        contextMenuBox.style.display = 'none';
                    });

                    attachmentInput.addEventListener('change', function() {
                        if (this.files.length > 0) {
                            const fileName = this.files[0].name;
                            if (!messageInput.value.includes(fileName)) {
                                userTypedText = messageInput.value;
                            }
                            messageInput.value = fileName + (userTypedText ? " " + userTypedText : "");
                        }
                    });

                    messageInput.addEventListener('input', function() {
                        if (attachmentInput.files.length > 0 && !this.value.includes(attachmentInput.files[0].name)) {
                            attachmentInput.value = '';
                        }
                    });

                    function handleReply(id, message, userName) {

                        replyIdInput.value = id;

                        replyUserTitle.textContent = "Replying to " + userName;

                        replyPreviewText.textContent = message || "Attachment";

                        replyPreviewBox.classList.remove("hidden");

                        contextMenuBox.style.display = "none";

                        messageInput.focus();

                    }

                    function cancelReply() {

                        replyIdInput.value = "";

                        replyPreviewBox.classList.add("hidden");

                    }

                    function handleDelete(id) {

                        contextMenuBox.style.display = "none";

                        Swal.fire({

                            title: "Delete Message?",
                            text: "Are you sure you want to delete this message?",
                            icon: "warning",

                            showCancelButton: true,

                            confirmButtonColor: "#dc2626",
                            cancelButtonColor: "#6b7280",

                            confirmButtonText: "Yes, Delete",
                            cancelButtonText: "Cancel",

                            reverseButtons: true,
                            focusCancel: true

                        }).then((result) => {

                            if (!result.isConfirmed) return;

                            fetch("{{ route('learner.chat.delete', ':id') }}".replace(':id', id), {

                                    method: "DELETE",

                                    headers: {
                                        "X-CSRF-TOKEN": document
                                            .querySelector('meta[name="csrf-token"]')
                                            .content,
                                        "X-Requested-With": "XMLHttpRequest"
                                    }

                                })
                                .then(res => res.json())
                                .then(res => {

                                    if (res.success) {

                                        document.getElementById("msg-row-" + id)?.remove();

                                        if (replyIdInput.value == id) {
                                            cancelReply();
                                        }

                                        showSuccessToast("Message deleted successfully.");

                                    } else {

                                        Swal.fire({
                                            icon: "error",
                                            title: "Delete Failed",
                                            text: "Unable to delete message."
                                        });

                                    }

                                });

                        });

                    }

                    function openEditModal() {
                        editModal.classList.remove("hidden");
                        editModal.classList.add("flex");
                    }

                    function closeEditModal() {
                        editModal.classList.remove("flex");
                        editModal.classList.add("hidden");
                    }

                    function handleEdit(id) {

                        contextMenuBox.style.display = "none";

                        const textElement = document.getElementById("text-" + id);

                        if (!textElement) return;

                        document.getElementById("edit-msg-id").value = id;
                        document.getElementById("edit-msg-text").value = textElement.innerText.trim();

                        openEditModal();

                        setTimeout(() => {
                            document.getElementById("edit-msg-text").focus();
                        }, 100);
                    }
                    document.getElementById("saveEditBtn").addEventListener("click", function() {

                        const id = document.getElementById("edit-msg-id").value;
                        const updatedContent = document.getElementById("edit-msg-text").value;

                        fetch("{{ route('learner.chat.update', ':id') }}".replace(':id', id), {

                                method: "POST",

                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                    "X-Requested-With": "XMLHttpRequest"
                                },

                                body: JSON.stringify({
                                    message: updatedContent
                                })

                            })
                            .then(res => res.json())
                            .then(res => {

                                if (res.success) {

                                    document.getElementById("text-" + id).innerText = res.text;

                                    document.getElementById("edited-label-" + id)
                                        .classList.remove("hidden");

                                    closeEditModal();
                                }

                            });

                    });
                    editModal.addEventListener("click", function(e) {

                        if (e.target === editModal) {
                            closeEditModal();
                        }

                    });

                    chatForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        let textValue = messageInput.value;
                        if (attachmentInput.files.length > 0) {
                            const fileName = attachmentInput.files[0].name;
                            if (textValue.startsWith(fileName)) {
                                textValue = textValue.replace(fileName, '').trim();
                            }
                        }

                        if (!textValue.trim() && attachmentInput.files.length === 0) return;

                        const formData = new FormData(chatForm);
                        formData.set('message', textValue);
                        messageInput.disabled = true;

                        fetch(chatForm.getAttribute('action'), {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(res => res.json()).then(res => {
                                if (res.success) {
                                    const noMsgText = document.getElementById('no-msg-text');
                                    if (noMsgText) noMsgText.remove();
                                    const msg = res.data;

                                    let replyHTML = msg.reply ? `<div class="telegram-reply-box"><span class="telegram-reply-user">${msg.reply.user_name}</span><div>${msg.reply.message}</div></div>` : '';
                                    let isImg = msg.attachment && ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(msg.attachment.type);

                                    let attachmentHTML = '';
                                    if (msg.attachment) {
                                        attachmentHTML = isImg ?
                                            `<div class="${msg.message ? 'mt-2' : ''}"><img src="/storage/chat-attachments/${msg.attachment.file}" class="img-fluid"></div>` :
                                            `<div class="${msg.message ? 'mt-2' : ''}"><a href="/storage/chat-attachments/${msg.attachment.file}" target="_blank" class="btn btn-sm btn-light py-1 px-2 border"><i class="fa-solid fa-file-lines me-1"></i> File Attached</a></div>`;
                                    }

                                    const cleanMsgText = (msg.message || '').replace(/'/g, "\\'");
                                    const cleanUserName = (msg.user_name || 'User').replace(/'/g, "\\'");
                                    const imgBoxClass = (!msg.message && isImg) ? 'msg-image-only' : '';
                                    const avatarLetter = (msg.user_name || 'U').charAt(0).toUpperCase();

                                    const newMsgHtml = `
                        <div class="chat-row row-me" id="msg-row-${msg.id}">
                            <div class="chat-avatar">${avatarLetter}</div>
                            <div class="msg-wrapper">
                                <div class="user-name">${msg.user_name}</div>
                                <div class="message-box  ${imgBoxClass}" onclick="toggleContextMenu(event, ${msg.id}, 'me', '${cleanMsgText}', '${cleanUserName}')">
                                    ${replyHTML}
                                    ${msg.message ? `<div class="text-wrap msg-text" id="text-${msg.id}" style="font-size: 15px;">${msg.message}</div>` : ''}
                                    ${attachmentHTML}
                                </div>
                                <div style="font-size: 10px; color: #999; margin-top: 2px; display: flex; gap: 6px;">
                                    <span>${msg.created_at}</span>
                                    <span id="edited-label-${msg.id}" class="d-none text-muted">(edited)</span>
                                </div>
                            </div>
                        </div>`;

                                    messagesBox.insertAdjacentHTML('beforeend', newMsgHtml);
                                    chatForm.reset();
                                    userTypedText = "";
                                    cancelReply();
                                    scrollToBottom();
                                }
                            }).finally(() => {
                                messageInput.disabled = false;
                                messageInput.focus();
                            });
                    });

                    function showSuccessToast(message = "Message deleted successfully!") {

                        Swal.fire({

                            toast: true,
                            position: "top",
                            icon: "success",

                            title: `
                                <div class="flex items-center gap-2">
                                    <i class="ri-checkbox-circle-fill text-emerald-500 text-xl"></i>
                                    <span>${message}</span>
                                </div>`,

                            showConfirmButton: false,

                            timer: 3000,
                            timerProgressBar: true,

                            background: "#ffffff",
                            color: "#111827",

                            customClass: {
                                popup: "rounded-2xl shadow-2xl border border-emerald-100 px-5 py-2"
                            },

                            showClass: {
                                popup: `
                                    animate__animated
                                    animate__fadeInDown
                                    animate__faster
                                `
                            },

                            hideClass: {
                                popup: `
                                    animate__animated
                                    animate__fadeOutUp
                                    animate__faster
                                `
                            }

                        });

                    }
                </script>
            </div>
        </div>

    </div>


</body>

</html>