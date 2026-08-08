@extends('layout.master')

@section('content')

<div class="min-h-screen">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Course Card -->
            <div class="lg:col-span-1">

                <div
                    class="bg-white dark:bg-white/20 rounded-3xl shadow-xl shadow-indigo-200 dark:shadow-white/20 overflow-hidden sticky top-5">

                    <div class="overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$course->thumbnail) }}"
                            class="w-full h-52 sm:h-64 object-cover hover:scale-105 transition duration-500">

                    </div>

                    <div class="p-5">

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-600">
                            Premium Course
                        </span>

                        <h2
                            class="text-xl font-bold mt-4 text-slate-800 dark:text-white/80">

                            {{ $course->title }}

                        </h2>



                        <div
                            class="mt-6 flex items-center justify-between">

                            <span
                                class="text-2xl font-bold text-indigo-800 dark:text-white">

                                {{ number_format($course->price) }} <span class="text-slate-700 dark:text-white/60">MMK</span>

                            </span>

                        </div>

                        <div
                            class="mt-6 space-y-3 text-slate-600 dark:text-white">

                            <div
                                class="flex items-center gap-2 text-sm " data-en="✓ Lifetime Access" data-mm="တစ်သက်တာလေ့လာနိုင်သည်။">

                                ✓ Lifetime Access

                            </div>

                            <div
                                class="flex items-center gap-2 text-sm" data-en="✓ Mobile Learning" data-mm="Mobile (ဖုန်း) ဖြင့်လေ့လာနိုင်သည်။">

                                ✓ Mobile & Desktop

                            </div>

                            <div
                                class="flex items-center gap-2 text-sm" data-en="✓ Certificate Included" data-mm="Certificate ပေးသည်။">

                                ✓ Certificate

                            </div>

                        </div>
                        <hr class="mt-3">
                        <div
                            class="mt-3 space-y-4 text-slate-600 dark:text-white">

                            <div
                                class=" items-center gap-2 text-sm ">

                                Kpay : <span class="font-bold">09751066765</span> <br>
                                <p>Name : <span class="font-bold">Arkar Lin</span>
                                </p>
                            </div>
                            <div
                                class=" items-center gap-2 text-sm ">

                                Aya : <span class="font-bold">09777966941</span> <br>
                                <p>Name : <span class="font-bold">Shane Aung</span>
                                </p>
                            </div>
                            <div
                                class=" items-center gap-2 text-sm ">

                                Wave : <span class="font-bold">09797948914</span> <br>
                                <p>Name : <span class="font-bold">Nay Chi</span>
                                </p>
                            </div>



                        </div>

                    </div>

                </div>

            </div>

            <!-- Checkout Form -->
            <div class="lg:col-span-2">

                <div
                    class="bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100
                shadow-2xl border border-gray-200
                transition-all duration-500 hover:shadow-indigo-200/50 rounded-3xl shadow-lg p-5 sm:p-8">

                    <h1
                        class="text-2xl sm:text-3xl font-bold text-slate-800" data-en="Checkout" data-mm="ငွေပေးချေရန်">

                        Checkout

                    </h1>

                    <p
                        class="text-slate-500 mt-2" data-en="Complete your purchase securely." data-mm="ပြည့်စုံစွာ ငွေပေးချေရန်">

                        Complete your purchase securely.

                    </p>

                    <form
                        action="{{ route('course.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="mt-8 space-y-8">

                        @csrf

                        <input
                            type="hidden"
                            name="course_id"
                            class=""
                            value="{{ $course->id }}">

                        <!-- User Info -->

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div>

                                <label
                                    class="font-medium text-slate-700" data-en="Name" data-mm="အမည်">

                                    Name

                                </label>
                                <input
                                    disabled required
                                    value="{{ auth()->user()->name }}"
                                    class="w-full mt-2 p-4 rounded-2xl border border-slate-400 font-semibold bg-white/80">

                            </div>

                            <div>

                                <label
                                    class="font-medium text-slate-700" data-en="Email" data-mm="Email">

                                    Email

                                </label>

                                <input
                                    disabled
                                    value="{{ auth()->user()->email }}"
                                    class="w-full mt-2 border rounded-2xl p-4 border border-slate-400 font-semibold bg-white/80">

                            </div>

                        </div>

                        <!-- Payment Method -->

                        <div>

                            <label
                                class="font-medium text-slate-700" data-en="Payment Method" data-mm="ငွေပေးချေရန် နည်းလမ်း">

                                Payment Method

                            </label>

                            <select
                                name="payment_method" required
                                class="w-full p-4 rounded-2xl border bg-white/80 border border-slate-400 mt-2
                       focus:ring-2 focus:ring-indigo-400
                       hover:shadow-lg transition">

                                <option value="KBZ Pay">
                                    KBZ Pay
                                </option>

                                <option value="Wave Pay">
                                    Wave Pay
                                </option>

                                <option value="AYA Pay">
                                    AYA Pay
                                </option>

                                <option value="CB Pay">
                                    CB Pay
                                </option>

                                <option value="Bank Transfer">
                                    Bank Transfer
                                </option>

                            </select>

                        </div>

                        <!-- Screenshot -->

                        <div>

                            <label
                                class="font-medium text-slate-800" data-en="Payment Screenshot" data-mm="ပြေစာ">

                                Payment Screenshot

                            </label>

                            <input
                                type="file" required
                                id="image"
                                name="payment_screenshot"
                                accept="image/*"
                                class="p-4 rounded-2xl ml-3 border border-dashed border-indigo-300
                    bg-white hover:bg-indigo-50 transition
                    hover:scale-[1.02] duration-300">

                            <img
                                id="preview"
                                class="hidden mt-4 rounded-2xl w-full max-h-80 object-cover border">

                        </div>

                        <!-- Summary -->

                        <div
                            class="bg-pink-300 rounded-3xl p-6">

                            <div
                                class="flex justify-between text-lg">

                                <span data-en="Course Price" data-mm="ကုန်ကျငွေ">
                                    Course Price
                                </span>

                                <span>
                                    {{ number_format($course->price) }} MMK
                                </span>

                            </div>

                            <div
                                class="border-t mt-4 pt-4 flex justify-between font-bold text-xl">

                                <span data-en="Total" data-mm="စုစုပေါင်း">Total</span>

                                <span class="text-indigo-800">

                                    {{ number_format($course->price) }} <span class="text-slate-800">MMK </span>

                                </span>

                            </div>

                        </div>

                        <!-- Terms -->

                        <label
                            class="flex items-start gap-3"><input
                                type="checkbox"
                                required
                                class="mt-1">

                            <span
                                class="text-sm text-slate-600" data-en=" I agree to the Terms &
                                Conditions and Refund Policy." data-mm="ငွေပေးချေခြင်းဆိုင်ရာ စည်းမျဉ်းစည်းကမ်းများကို လက်ခံသည်။">

                                I agree to the Terms &
                                Conditions and Refund Policy.

                            </span>

                        </label>

                        <!-- Submit -->

                        <button
                            type="submit"
                            class="w-full py-4 rounded-2xl
                            bg-indigo-600
                            hover:bg-indigo-700
                            text-white font-semibold
                            transition-all duration-300
                            hover:scale-[1.02]
                            shadow-lg" data-en="Complete Purchase" data-mm="ပြီးမြောက်စွာ ဝယ်ယူရန်">

                            Complete Purchase

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const imageInput =
        document.getElementById('image');

    const preview =
        document.getElementById('preview');

    imageInput.addEventListener(
        'change',
        function() {

            const file = this.files[0];

            if (file) {
                preview.src =
                    URL.createObjectURL(file);

                preview.classList.remove('hidden');
            }

        });
</script>

@endsection