@extends('layout.master')
@section('content')

<div class="min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-5">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 data-en="Meet Our Expert Instructors"
                data-mm="ကျွန်ုပ်တို့၏ ကျွမ်းကျင်နည်းပြများနှင့် မိတ်ဆက်ပေးပါရစေ" class="text-2xl md:text-3xl font-extrabold 
            bg-gradient-to-r from-blue-600 to-indigo-600 
            text-transparent bg-clip-text">
                Meet Our Expert Instructors
            </h1>
            <p data-en="Learn from professional instructors and improve your skills."
                data-mm="ကျွန်ုပ်တို့၏ ကျွမ်းကျင်နည်းပြများနှင့် မိတ်ဆက်ပေးပါရစေ" class="mt-4 text-gray-600 dark:text-white text-lg">
                Learn from professional instructors and improve your skills.
            </p>
        </div>

        <!-- Search -->
        <form method="GET"
            class="mb-10 flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search instructor..."
                    class="
                w-full px-6 py-4 rounded-2xl
                bg-white dark:bg-white/20 dark:text-white shadow-lg
                border border-gray-200
                focus:ring-4 focus:ring-blue-200
                outline-none
                transition
                ">

            </div>


            <button data-en="Search"
                data-mm="ရှာရန်"
                class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold
                    shadow-lg hover:scale-105 transition duration-300">
                Search
            </button>
        </form>

        <!-- Instructor Grid -->
        <div class="grid  grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($instructors as $instructor)
            <div class="group bg-white/80 dark:bg-white/20 backdrop-blur-xl rounded-3xl p-6 shadow-xl border border-white hover:-translate-y-3 transition-all duration-500
            ">
                <!-- Profile -->
                <div class="flex flex-col items-center text-center">
                    <div class="relative w-32 h-32 mb-5">
                        @if($instructor->avatar)
                        <img
                            src="{{ asset('storage/'.$instructor->avatar) }}"
                            class="md:w-full md:h-full w-26 h-26 object-cover rounded-full ring-4 ring-indigo-200 group-hover:ring-purple-400 transition">

                        @else
                        <div
                            class="w-full h-full rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center
                                    text-white text-4xl font-bold">
                            {{ strtoupper(substr($instructor->name,0,1)) }}
                        </div>
                        @endif

                        <!-- Online badge -->

                        <span
                            class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-4 border-white rounded-full">
                        </span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white group-hover:text-indigo-600 transition">
                        {{ $instructor->name }}
                    </h2>
                    <p class="text-gray-500 mt-2 dark:text-white">
                        {{ $instructor->email }}
                    </p>
                </div>
                <!-- Stats -->
                <div class="mt-6 grid grid-cols-2 gap-3 text-center">
                    <div class=" bg-indigo-50 rounded-2xl p-3">
                        <h3 class="font-bold text-indigo-600">
                            {{ $instructor->courses->count() ?? 0 }}
                        </h3>
                        <p data-en="Courses"
                            data-mm="ဘာသာရပ်" class="text-xs text-gray-500">
                            Courses
                        </p>
                    </div>
                    <div class=" bg-yellow-50 rounded-2xl p-3">
                        <h3 class="font-bold text-yellow-600">
                            ⭐ {{ $instructor->average_rating ?? '0' }}
                        </h3>
                        <p data-en="Rating"
                            data-mm="ကြိုက်နှစ်သက်" class="text-xs text-gray-500">
                            Rating
                        </p>
                    </div>
                </div>
                <!-- Button -->

                <a href="{{ route('instructors.show',$instructor->id) }}"
                    data-en="View Profile"
                    data-mm="ပရိုဖိုင် ကြည့်ရန်"
                    class="block mt-6 text-center py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white
                        font-semibold hover:shadow-xl hover:scale-105 transition duration-300">
                    View Profile
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <h3 class="text-2xl font-bold text-gray-600">
                    No Instructor Found
                </h3>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $instructors->links() }}
        </div>


        <!-- CTA -->
        <section class="py-12">

            <div class="max-w-6xl mx-auto px-6">

                <div
                    class="gradient-bg rounded-[40px] p-16 text-center shadow-2xl floating"
                    data-aos="zoom-in">

                    <h2 data-en="Become an Instructor"
                        data-mm="ကြိုဆိုပါတယ်" class="text-2xl md:text-3xl font-bold text-white">
                        🚀 Become an Instructor
                    </h2>

                    <p data-en="Share Your Knowledge
                        With Thousands of Students."
                        data-mm="မင်းရဲ့ အသိပညာတေကို သင်ကြားသူများစွာကို သင်ပေးပါ။" class="text-white/80 text-md md:text-lg mt-6">
                        Share Your Knowledge
                        With Thousands of Students.
                    </p>

                    <a href="{{ route('become-instructor') }}"><button data-en="Request"
                            data-mm="လျှောက်ထားရန်"
                            class="mt-10 bg-white text-indigo-700 px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
                            Request
                        </button>
                    </a>
                </div>

            </div>

        </section>
    </div>
</div>
@endsection