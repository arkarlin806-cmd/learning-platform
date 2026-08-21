@extends('layout.master')


@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-12">

    <div class="max-w-5xl mx-auto px-4">

        {{-- Hero --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-xl overflow-hidden">

            <div class="grid lg:grid-cols-2 gap-8 items-center p-10">

                <div>

                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 text-white text-sm">
                        🚀 Become an Instructor
                    </span>

                    <h1 class="text-4xl font-bold text-white mt-5 leading-tight">
                        Share Your Knowledge
                        <br>
                        With Thousands of Learners
                    </h1>

                    <p class="text-blue-100 mt-5 leading-8">

                        Join our instructor community and inspire learners around
                        the world by creating high-quality online courses.

                    </p>

                </div>

                <div class="hidden lg:flex justify-center">

                    <div class="w-72 h-72 rounded-full bg-white/10 flex items-center justify-center">

                        <div class="w-56 h-56 rounded-full bg-white/20 flex items-center justify-center text-7xl">

                            👨‍🏫

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Steps --}}
        <div class="grid md:grid-cols-3 gap-6 mt-10">

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">

                    1️⃣

                </div>

                <h3 class="font-bold text-lg mt-5">

                    Submit Request

                </h3>

                <p class="text-gray-500 mt-2">

                    Complete your instructor application.

                </p>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">

                    2️⃣

                </div>

                <h3 class="font-bold text-lg mt-5">

                    Admin Review

                </h3>

                <p class="text-gray-500 mt-2">

                    Our team will review your application.

                </p>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-xl">

                    3️⃣

                </div>

                <h3 class="font-bold text-lg mt-5">

                    Start Teaching

                </h3>

                <p class="text-gray-500 mt-2">

                    Publish courses and earn money.

                </p>

            </div>

        </div>

        {{-- Form --}}
        <div class="bg-white rounded-3xl shadow-xl mt-10 p-8">

            <h2 class="text-2xl font-bold text-gray-800">

                Instructor Application

            </h2>

            <p class="text-gray-500 mt-2 mb-8">

                Please fill in your professional information.

            </p>

            <form
                action="{{ route('become-instructor.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block font-medium mb-2">

                            Full Name

                        </label>
                        <input
                            type="text"
                            value="{{ auth()->user()->name }}"
                            disabled
                            class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3">

                    </div>

                    <div>

                        <label class="block font-medium mb-2">

                            Email

                        </label>

                        <input
                            type="email"
                            value="{{ auth()->user()->email }}"
                            disabled
                            class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3">

                    </div>

                    <div>

                        <label class="block font-medium mb-2">

                            Phone Number

                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                        @error('phone')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <div>

                        <label class="block font-medium mb-2">

                            Profession

                        </label>

                        <input
                            type="text"
                            name="profession"
                            value="{{ old('profession') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                        @error('profession')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <div class="md:col-span-2">

                        <label class="block font-medium mb-2">

                            Teaching Experience

                        </label>

                        <input
                            type="text"
                            name="experience"
                            value="{{ old('experience') }}"
                            placeholder="Example : 5 Years Laravel Developer"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3">

                        @error('experience')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <div class="md:col-span-2">

                        <label class="block font-medium mb-2">

                            Biography

                        </label>

                        <textarea
                            name="bio"
                            rows="6"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3"
                            placeholder="Introduce yourself...">{{ old('bio') }}</textarea>

                        @error('bio')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>
                    {{-- CV Upload --}}
                    <div>

                        <label class="block font-medium mb-2">
                            Curriculum Vitae (CV)
                        </label>

                        <div
                            class="border-2 border-dashed border-blue-200 rounded-2xl p-6 bg-blue-50">

                            <input
                                type="file"
                                name="cv"
                                accept=".pdf,.doc,.docx"
                                class="w-full">

                            <p class="text-sm text-gray-500 mt-3">
                                Accepted:
                                PDF, DOC, DOCX
                                (Max: 5MB)
                            </p>

                        </div>

                        @error('cv')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    {{-- Certificate --}}
                    <div>

                        <label class="block font-medium mb-2">
                            Certificate
                        </label>

                        <div
                            class="border-2 border-dashed border-green-200 rounded-2xl p-6 bg-green-50">

                            <input
                                type="file"
                                name="certificate"
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full">

                            <p class="text-sm text-gray-500 mt-3">
                                Accepted:
                                JPG, PNG, PDF
                                (Max: 5MB)
                            </p>

                        </div>

                        @error('certificate')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                </div>

                {{-- Terms --}}
                <div
                    class="mt-8 rounded-2xl bg-gray-50 border p-5">

                    <label
                        class="flex items-start gap-3 cursor-pointer">

                        <input
                            type="checkbox"
                            required
                            class="mt-1 w-5 h-5">

                        <span class="text-gray-600 leading-7">

                            I confirm that the information provided is
                            accurate and I agree to the platform's
                            instructor policies and terms.

                        </span>

                    </label>

                </div>

                {{-- Submit --}}
                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="px-10 py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-lg hover:scale-105 transition duration-300">

                        🚀 Submit Instructor Request

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>
    Swal.fire({

        icon: 'success',

        title: 'Success',

        text: '{{ session("success") }}',

        confirmButtonColor: '#2563eb'

    });
</script>

@endif


@if(session('error'))

<script>
    Swal.fire({

        icon: 'error',

        title: 'Error',

        text: '{{ session("error") }}',

        confirmButtonColor: '#dc2626'

    });
</script>

@endif

@endsection