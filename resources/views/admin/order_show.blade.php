@extends('layout.admin')

@section('page_title','Single Order')
@section('page','Admin Single Order Show, Accept and Reject Analysis.')
@section('content')


<h1 class="text-3xl text-slate-700 mx-10 font-bold">Order Status</h1>
<p class="mx-10 text-sm text-slate-600">Admin Single Order Show, Accept and Reject Analysis.</p>
<!-- CONTENT -->
<div class="max-w-7xl mx-auto p-4 md:p-8 grid lg:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="lg:col-span-2 space-y-6">

        <!-- STUDENT BOX -->
        <div class="bg-white rounded-3xl p-6 shadow-md border-l-4 border-blue-500 transition">

            <h2 class="text-lg font-semibold text-slate-700 mb-4">
                👤 Learner Information
            </h2>

            <div class="space-y-2 text-gray-600">
                <p>Name :
                    <span class="font-semibold text-blue-800">
                        {{ $order->user->name }}
                    </span>
                </p>

                <p>Email :
                    <span class="font-semibold text-blue-800">
                        {{ $order->user->email }}
                    </span>
                </p>
            </div>
        </div>

        <!-- COURSE BOX -->
        <div class="bg-white rounded-3xl p-6 shadow-md border-l-4 border-orange-500 hover:shadow-xl transition">

            <h2 class="text-lg font-semibold text-slate-700 ">
                📚 Course Information
            </h2>

            <h3 class="text-lg ml-6 font-bold text-slate-800 mt-3">
                {{ $order->course->title }}
            </h3>

            <p class="mt-1 ml-6 text-gray-600">
                Amount:
                <span class="font-bold text-sm text-green-600">
                    MMK {{ number_format($order->amount) }}
                </span>
            </p>
        </div>

        <!-- SCREENSHOT BOX -->
        <div class="bg-white rounded-3xl p-6 shadow-md border-l-4 border-slate-500 hover:shadow-xl transition">

            <h2 class="text-lg font-semibold text-slate-600 mb-4">
                🧾 Payment Screenshot
            </h2>

            <img src="{{ asset('storage/'.$order->payment_screenshot) }}"
                class="w-60 h-80 rounded-2xl border border-slate-200 hover:scale-[1.01] transition duration-300">
        </div>

    </div>

    <!-- RIGHT -->
    <div class="space-y-6">

        <!-- STATUS BOX -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-indigo-100 sticky top-20">

            <h2 class="text-lg font-semibold text-indigo-600 mb-4">
                ⚙️ Order Status
            </h2>

            <!-- ORDER NO -->
            <div class="bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 rounded-2xl p-4 border border-indigo-200 mb-5">

                <p class="text-sm text-gray-500">Order No</p>
                <h3 class="font-bold text-indigo-700 tracking-widest">
                    {{ $order->order_no }}
                </h3>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('course.updateStatus',$order->id) }}">
                @csrf

                <select name="status"
                    class="w-full border border-indigo-200 rounded-2xl p-3 focus:ring-2 focus:ring-indigo-300">

                    <option value="paid" class="rounded-2xl"> Paid</option>
                    <option value="failed"> Failed</option>
                    <option value="refund"> Refund</option>

                </select><button class="w-full mt-4 py-3 rounded-2xl
                                   bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-500
                                   text-white font-semibold shadow-md
                                   hover:scale-105 active:scale-95 transition">
                    Update Status
                </button>
            </form>

            <!-- BREAKDOWN BOX -->
            <div class="mt-6 border-t pt-4 space-y-3 text-sm">

                <div class="flex justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                    <span>Total</span>
                    <span class="font-semibold text-slate-700">
                        MMK {{ number_format($order->amount) }}
                    </span>
                </div>

                <div class="flex justify-between p-2 rounded-xl bg-indigo-50 border border-indigo-100">
                    <span>Admin (20%)</span>
                    <span class="font-semibold text-indigo-600">
                        MMK {{ number_format($order->admin_amount) }}
                    </span>
                </div>

                <div class="flex justify-between p-2 rounded-xl bg-pink-50 border border-pink-100">
                    <span>Instructor (80%)</span>
                    <span class="font-semibold text-pink-600">
                        MMK {{ number_format($order->instructor_amount) }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection