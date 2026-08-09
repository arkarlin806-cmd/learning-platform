<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Instructor Dashboard</title>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sidebar-animation {
            animation: slideIn .5s ease;
        }

        .content-animation {
            animation: fadeIn .8s ease;
        }
    </style>

</head>

<body class="bg-slate-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
        </div>
        @if(auth()->user()->role == 1)
        @include('sharedata.admin_side')


        @elseif(auth()->user()->role == 0)
        @include('sharedata.user_side')

        @else
        @include('sharedata.ins_side')
        @endif
        <div class="h-screen overflow-y-auto custom-scroll  relative flex-1">

            <header
                class="h-20 bg-white shadow-sm
                flex items-center justify-between
                px-6 sticky top-0 z-30">

                <div class="flex items-center gap-4">

                    <button id="openSidebar"
                        class="lg:hidden text-3xl">

                        ☰

                    </button>
                    <div class="">
                        <h1 class="font-bold text-2xl text-slate-600 font-semibold">
                            Contact
                        </h1>
                        <p class="text-sm text-slate-500">
                            @if(auth()->user()->role == 1)
                            Admin Contact Read and Reply User.
                            @else
                            Read And Send Contact To Admin.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <span class="px-5 py-1 rounded-2xl bg-blue-100 border border-blue-200 text-sm text-slate-600">Contact</span>
                </div>

            </header>

            <div class="bg-gradient-to-r from-sky-100 via-white to-indigo-100 p-12 min-h-screen">

                <div class="max-w-6xl mx-auto px-6">
                    <div class="flex justify-between items-center mb-10">
                        <div>

                            <h1 class="text-4xl font-black bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                                Contact Center
                            </h1>

                            <p class="text-slate-500">
                                Manage your conversations
                            </p>
                        </div>


                        <a href="{{route('contact.create')}}"
                            class="px-6 py-3 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 text-white font-bold shadow-xl hover:scale-105 transition">
                            + New Message
                        </a>
                    </div>

                    @if(session('success'))

                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
                        {{session('success')}}
                    </div>
                    @endif






                    <div class="space-y-6">



                        @forelse($contacts as $contact)



                        <div class="bg-white/80
backdrop-blur-xl
rounded-3xl
shadow-xl
p-6
border border-white
hover:-translate-y-1
transition duration-500">





                            <div class="flex justify-between">


                                <div class="flex gap-4 items-center">


                                    <div class="w-14 h-14
rounded-full
bg-gradient-to-r
from-indigo-500
to-purple-600
text-white
flex items-center
justify-center
text-xl
font-bold">


                                        {{substr($contact->sender->name,0,1)}}


                                    </div>




                                    <div>

                                        <h2 class="font-bold text-xl">

                                            {{$contact->sender->name}}

                                        </h2>


                                        <p class="text-sm text-gray-400">

                                            {{$contact->created_at->diffForHumans()}}

                                        </p>


                                    </div>


                                </div>





                                @if(!$contact->is_read)

                                <span class="px-4 py-1 h-10 w-10 flex justify-center items-center
bg-red-500
text-white
rounded-full
text-xs
animate-pulse">

                                    NEW

                                </span>

                                @endif


                            </div>







                            <div class="mt-5">

                                <h3 class="font-bold text-lg">

                                    {{$contact->subject}}

                                </h3>


                                <p class="text-gray-600 mt-3">

                                    {{$contact->message}}

                                </p>


                            </div>







                            <div class="mt-6 flex gap-3">



                                <a href="{{route('contact.read',$contact->id)}}"

                                    class="px-5 py-2 rounded-xl
bg-gray-100
hover:bg-gray-200">

                                    Read

                                </a>





                                <button

                                    onclick="openReply(
'{{$contact->sender_id}}',
'{{$contact->subject}}'
)"

                                    class="px-5 py-2 rounded-xl

bg-indigo-600

text-white

hover:bg-indigo-700">


                                    Reply


                                </button>



                            </div>





                        </div>



                        @empty


                        <div class="bg-white rounded-3xl
p-12 text-center shadow-xl">


                            <div class="text-6xl">

                                📭

                            </div>


                            <h2 class="text-2xl font-bold mt-4">

                                No Messages

                            </h2>


                        </div>


                        @endforelse





                    </div>



                </div>

                <!-- Reply Modal -->
                <div id="replyModal"

                    class="hidden fixed inset-0
bg-black/40
backdrop-blur-sm
flex items-center
justify-center">


                    <div class="bg-white
rounded-3xl
p-8
w-full
max-w-lg
shadow-2xl">



                        <h2 class="text-2xl font-bold mb-5">

                            Reply Message

                        </h2>



                        <form method="POST"
                            action="{{route('contact.reply')}}">


                            @csrf



                            <input type="hidden"
                                id="receiver_id"
                                name="receiver_id">



                            <input
                                id="subject"
                                name="subject"
                                class="w-full border rounded-xl p-3 mb-4">





                            <textarea

                                name="message"

                                rows="5"

                                placeholder="Write reply..."

                                class="w-full border rounded-xl p-3 mb-5"></textarea>





                            <button

                                class="w-full py-3
rounded-xl
bg-indigo-600
text-white
font-bold">

                                Send Reply

                            </button>



                        </form>



                    </div>


                </div>

                <script>
                    function openReply(id, subject)

                    {


                        document
                            .getElementById('replyModal')
                            .classList
                            .remove('hidden');



                        document
                            .getElementById('receiver_id')
                            .value = id;



                        document
                            .getElementById('subject')
                            .value = "Re: " + subject;



                    }
                </script>



            </div>

        </div>

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

        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');

        profileBtn.addEventListener('click', () => {

            profileMenu.classList.toggle('hidden');

        });

        const collapseBtn = document.getElementById('collapseBtn');

        collapseBtn.addEventListener('click', () => {

            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-24');

            document.querySelectorAll('.menu-text')
                .forEach(el => el.classList.toggle('hidden'));

            document.getElementById('logoText')
                .classList.toggle('hidden');

        });
    </script>

</body>

</html>