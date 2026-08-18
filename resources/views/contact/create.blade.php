[8/17/2026 10:37 PM] 💕 ပူတူးလေး💕:
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @vite(['resources/css/app.css','recource/js/app.js'])
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

                <div class="max-w-4xl mx-auto px-6 ">


                    <div
                        class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white transition-all duration-500 hover:-translate-y-2">
                        <!-- Header -->
                        <div class="text-center mb-10">

                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-4xl shadow-lg animate-bounce">
                                💬
                            </div>
                            <h1 class="text-4xl font-extrabold mt-5 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Contact Support
                            </h1>
                            <p class="text-gray-500 mt-3">
                                Send your message to admin team
                            </p>
                        </div>
                        [8/17/2026 10:37 PM] 💕 ပူတူးလေး💕: @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 animate-pulse">
                            {{session('success')}}
                        </div>
                        @endif

                        <form action="{{route('contact.store')}}"
                            method="POST"
                            class="space-y-6">
                            @csrf
                            <!-- Receiver -->
                            <div>
                                <label class="font-semibold text-gray-700">
                                    Send To
                                </label>

                                @if($mail == "true")
                                <label for="">{{$admins->name}}
                                    <input name="receiver_id" type="text" value="{{$admins->id}}" class="hidden"></label>
                                @else
                                <select
                                    name="receiver_id"
                                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-100 p-4 focus:ring-4 focus:ring-indigo-200 transition">
                                    @foreach($admins as $admin)
                                    <option value="{{$admin->id}}">
                                        {{$admin->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                            </div>

                            <!-- Subject -->
                            <div>
                                <label class="font-semibold">
                                    Subject
                                </label>
                                <input
                                    type="text" maxlength=30
                                    name="subject"
                                    placeholder="Enter subject"
                                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-100 p-4 focus:ring-4 focus:ring-purple-200 transition hover:shadow-lg">
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="font-semibold">
                                    Message
                                </label>
                                <textarea maxlength=150
                                    name="message"
                                    rows="6"
                                    placeholder="Write your message..."
                                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-100 text-slate-700 p-4 focus:ring-4 focus:ring-indigo-200 transition hover:shadow-lg">
                                </textarea>
                            </div>


                            <button
                                class="w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold  text-lg shadow-xl
                                        hover:scale-[1.02] active:scale-95 transition duration-300">

                                🚀 Send Message
                            </button>



                        </form>


                    </div>



                </div>




            </div>
        </div>
    </div>
</body>

</html>