@extends('layout.admin')
@section('page_title','Dashboard')
@section('page','Admin analysis earnings and total counts.')
@section('content')

<div class="max-w-7xl mx-auto">

    <section class="relative py-10">
        <div class="max-w-7xl mx-auto px-6">
            {{-- HERO --}}
            <div class="grid lg:grid-cols-3 gap-10 items-start">
                {{-- LEFT CONTENT --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Thumbnail --}}
                    <div
                        class="group relative overflow-hidden rounded-3xl shadow-2xl">
                        <img
                            src="{{$course->thumbnail_url) }}"
                            class="w-full h-[420px] object-cover transition duration-700 group-hover:scale-110 ">
                        {{-- Overlay --}}
                        <div class=" absolute inset-0 bg-gradient-to-t from-black/60 via-transparent ">
                        </div>

                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                        <div class=" bg-white/50 backdrop-blur-xl rounded-2xl p-5 shadow-md  hover:-translate-y-2 transition">
                            <h3 class="text-2xl font-bold text-indigo-600">
                                {{ $course->ratings_count }}
                            </h3>
                            <p class="text-slate-600">
                                Reviews
                            </p>
                        </div>

                        <div class=" bg-white/50 backdrop-blur-xl rounded-2xl p-5 shadow-md hover:-translate-y-2 transition">
                            <h3 class="text-2xl font-bold text-pink-600">
                                {{ number_format($course->ratings_avg_rating ?? 0,1) }}
                            </h3>
                            <p class="text-slate-700">
                                Rating
                            </p>
                        </div>

                        <div class="bg-white/50 backdrop-blur-xl rounded-2xl p-5 shadow-md hover:-translate-y-2 transition">
                            <h3 class="text-xl font-bold text-emerald-600">
                                {{ $course->level }}
                            </h3>
                            <p class="text-gray-500">
                                Level
                            </p>
                        </div>

                        <div class="bg-white/50 backdrop-blur-xl rounded-2xl p-5 shadow-md hover:-translate-y-2 transition">
                            <h3 class="text-2xl font-bold text-orange-500">
                                {{ $course->schedules->count() }}
                            </h3>
                            <p class="text-gray-500">
                                Classes
                            </p>
                        </div>
                    </div>


                    {{-- Description --}}
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-xl">
                        <h2 class="text-slate-800 text-2xl font-bold mb-5">
                            About This Course
                        </h2>
                        <h1 class="my-2 text-lg md:text-xl font-extrabold tracking-tight text-gray-900">
                            <span class="text-sm font-semibold text-slate-600 mr-4">Course Title</span> {{ $course->title }}
                        </h1>
                        <span class="text-sm my-2 font-semibold text-slate-600 mr-5">Category</span> <span
                            class="inline-flex px-5 py-1 rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm">
                            {{ $course->category }}
                        </span>
                        <h1 class="my-3">
                            <span class="text-sm font-semibold text-slate-600 mr-5">Description</span>
                            <span class=" text-gray-600  leading-8">
                                {{ $course->description }}
                            </span>
                        </h1>
                    </div>
                </div>

                {{-- RIGHT PURCHASE CARD --}}
                <div class="lg:sticky lg:top-24">

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border  border-white hover:-translate-y-2 transition duration-500">
                        <h2 class="text-2xl font-extrabold text-indigo-600">
                            {{ number_format($course->price,2) }} MMK
                        </h2>

                        <div class="mt-5 flex items-center gap-2">
                            <div class="text-yellow-400 text-xl">
                                ★★★★★
                            </div>
                            <span class="text-gray-600">
                                {{ number_format($course->ratings_avg_rating ?? 0,1) }}
                                ({{ $course->ratings_count }})
                            </span>
                        </div>
                        @if(auth()->user()->role != 1)
                        @if($isPurchased)
                        <a
                            href="#"
                            class="mt-8 block text-center py-4 rounded-2xl bg-emerald-500 text-white font-bold hover:scale-105 transition">
                            Continue Learning
                        </a>
                        @else

                        <form
                            action="{{ route('course.checkout', $course->id) }}"
                            method="GET">
                            @csrf
                            <button
                                class="mt-8 w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg hover:scale-105 transition">
                                Enroll Now
                            </button>
                        </form>
                        @endif
                        @endif


                        <div class="mt-8 space-y-4 text-gray-600">
                            <div class="flex gap-3">
                                ✓ Lifetime Access
                            </div>
                            <div class="flex gap-3">
                                ✓ Certificate Included
                            </div>
                            <div class="flex gap-3">
                                ✓ Mobile Learning
                            </div>


                            <div class="flex gap-3">

                                ✓ AI Learning Assistant

                            </div>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="text-xl text-slate-800 md:text-3xl  mb-10">
            <span class="font-extrabold"> Course Schedule </span>
            <p class="text-sm text-slate-600">{{ $course->title }} are weekly schedules.</p>
        </h2>

        <div class="relative">
            {{-- Vertical Line --}}
            <div
                class="absolute left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-sky-500 to-blue-500 rounded-full">
            </div>
            <div class="space-y-4">
                @foreach($course->schedules as $index=>$schedule)
                <div class="relative pl-16 group">
                    {{-- Circle --}}
                    <div class="absolute left-0 top-2 w-12 h-12 rounded-full bg-white border-4 border-blue-500 flex items-center
                                justify-center font-bold text-blue-600 shadow-md group-hover:scale-110 transition">
                        {{ $index+1 }}
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-6 shadow-md hover:-translate-y-2 transition duration-500">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ $schedule->day ?? 'Lesson Schedule' }}
                                </h3>
                            </div>
                            <div class="flex gap-2">
                                <div
                                    class="mt-4 md:mt-0 px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                                    Start Time : {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                </div>
                                <div
                                    class="mt-4 md:mt-0 px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                                    End Time : {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="mt-10">
        <h2 class="text-xl text-slate-600 md:text-3xl  mb-10">
            <span class="font-extrabold">Instructor</span>
            <p class="text-sm text-slate-600">This course instructor.</p>
        </h2>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-lg grid md:grid-cols-3 gap-8 items-center">
            <div class="text-center">
                <div class="relative inline-block">
                    <img
                        src="https://ui-avatars.com/api/?name={{ $course->instructor->name }}"
                        class="w-44 h-44 rounded-full object-cover ring-8 ring-indigo-600 shadow-xl hover:scale-105 transition">
                    <div
                        class="absolute bottom-2 right-2 bg-emerald-500 text-white rounded-full px-3 py-1 text-sm">
                        Verified
                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-3xl font-bold">
                    {{ $course->instructor->name }}
                </h3>

                <div class="flex items-center gap-3 mt-3">
                    <div class="text-yellow-400 text-xl">
                        ★★★★★
                    </div>
                    <span class="text-gray-600">
                        {{ number_format($course->ratings_avg_rating ?? 0,1) }}
                        Instructor Rating
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8">
                    <div class="p-4 rounded-2xl bg-indigo-50 border border-indigo-100">
                        <h4
                            class="text-2xl font-bold text-indigo-600">
                            {{ $courseCount ?? 0 }}
                        </h4>
                        <p class="text-gray-500">
                            Courses
                        </p>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-pink-50 border border-pink-100">
                        <h4
                            class="text-2xl font-bold text-pink-600 ">
                            {{ $course->ratings_count }}
                        </h4>
                        <p class="text-gray-500">
                            Reviews
                        </p>
                    </div>

                    <div
                        class="p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                        <h4 class="text-xl font-bold text-emerald-700 ">
                            {{ $instructor->profession }}
                        </h4>
                        <p class="text-gray-500">
                            Instructor
                        </p>
                    </div>

                </div>
                <p class="mt-6 text-gray-600 leading-8">
                    {{ $instructor->bio ?? 
'Experienced instructor helping students achieve their learning goals.' }}


                </p>



                {{-- Social Links --}}

                <!-- <div class="flex gap-4 mt-6">


                    <a href="#"
                        class="
w-12
h-12

rounded-full

bg-gray-100

flex

items-center

justify-center

hover:bg-indigo-600

hover:text-white

transition">

                        f

                    </a>


                    <a href="#"
                        class="
w-12
h-12

rounded-full

bg-gray-100

flex

items-center

justify-center

hover:bg-pink-600

hover:text-white

transition">

                        in

                    </a>


                    <a href="#"
                        class="
w-12
h-12

rounded-full

bg-gray-100

flex

items-center

justify-center

hover:bg-black

hover:text-white

transition">

                        X

                    </a>


                </div> -->



            </div>



        </div>



    </section>

    <section class="mt-20">


        <div class="
grid
lg:grid-cols-3
gap-10
items-center">
            {{-- Average Rating --}}

            <div
                class="
bg-white/80

backdrop-blur-xl

rounded-3xl

p-10

shadow-xl

text-center">


                <h2
                    class="
text-6xl

font-extrabold

text-indigo-600">


                    {{ number_format($course->ratings_avg_rating ?? 0,1) }}


                </h2>



                <div class="
text-yellow-400

text-3xl

mt-3">

                    ★★★★★

                </div>


                <p class="mt-3 text-gray-500">

                    Based on {{ $course->ratings_count }} reviews

                </p>


            </div>





            {{-- Rating Progress --}}

            <div
                class="
lg:col-span-2

bg-white/80

backdrop-blur-xl

rounded-3xl

p-8

shadow-xl">


                <h3
                    class="
text-2xl

font-bold

mb-8">

                    Rating Breakdown

                </h3>



                @php

                $ratingData=[
                5=>90,
                4=>70,
                3=>40,
                2=>15,
                1=>5
                ];

                @endphp



                @foreach($ratingData as $star=>$percent)


                <div class="flex items-center gap-4 mb-5">


                    <span class="w-10 font-bold">

                        {{$star}}★

                    </span>



                    <div
                        class="
flex-1

h-4

bg-gray-200

rounded-full

overflow-hidden">


                        <div

                            class="
h-full

bg-gradient-to-r

from-yellow-400

to-orange-400

rounded-full

rating-bar"

                            style="width:0%"
                            data-width="{{$percent}}%">


                        </div>


                    </div>


                    <span class="w-12 text-gray-500">

                        {{$percent}}%

                    </span>



                </div>


                @endforeach



            </div>



        </div>


    </section>


    <section class="mt-20">
        <div class="flex justify-between items-center mb-10">
            <h2
                class="text-3xl md:text-4xl font-extrabold">
                Student Reviews
            </h2>
        </div>
        <div
            class="grid md:grid-cols-2 gap-6">
            @forelse($course->ratings->take(6) as $review)
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-6 shadow-lg hover:-translate-y-2 transition">
                <div class="flex items-center gap-4">
                    <img
                        src="https://ui-avatars.com/api/?name={{ $review->user->name }}"
                        class="w-14 h-14 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold">
                            {{ $review->user->name }}
                        </h4>
                        <div class="text-yellow-400">
                            {{ str_repeat('★',$review->rating) }}
                        </div>
                    </div>
                </div>
                <p
                    class="
mt-5

text-gray-600

leading-7">


                    {{ $review->comment ?? 'Great course. Very helpful!' }}


                </p>


            </div>


            @empty


            <div class="
col-span-full

text-center

py-10

text-gray-500">


                No reviews yet


            </div>


            @endforelse




        </div>


    </section>









    {{-- SIMILAR COURSES --}}

    <section class="mt-20">


        <h2
            class="
text-3xl

md:text-4xl

font-extrabold

mb-10">


            Related Courses

        </h2>




        <div
            class="
grid

md:grid-cols-2

lg:grid-cols-3

gap-8">



            @foreach(
            \App\Models\Course::where('category',$course->category)
            ->where('id','!=',$course->id)
            ->limit(3)
            ->get()
            as $item)



            <div

                class="
group

bg-white

rounded-3xl

overflow-hidden

shadow-xl

hover:-translate-y-3

transition

duration-500">


                <div class="overflow-hidden">


                    <img

                        src="{{asset('storage/'.$item->thumbnail)}}"

                        class="
w-full

h-52

object-cover

group-hover:scale-110

transition

duration-700">


                </div>



                <div class="p-6">


                    <h3
                        class="
text-xl

font-bold

line-clamp-2">


                        {{$item->title}}


                    </h3>



                    <div class="
flex

items-center

justify-between

mt-5">


                        <span class="
text-indigo-600

font-bold">

                            ${{$item->price}}

                        </span>



                        <div class="text-yellow-400">

                            ★★★★★

                        </div>


                    </div>



                    <a

                        href="{{route('admin.course.show',$item->id)}}"

                        class="
block

mt-5

text-center

py-3

rounded-xl

bg-gray-100

hover:bg-indigo-600

hover:text-white

transition">


                        View Course


                    </a>



                </div>


            </div>


            @endforeach




        </div>


    </section>









</div>


{{-- ANIMATION SCRIPT --}}
<script>
    document.addEventListener(
        "DOMContentLoaded",
        () => {


            const bars = document.querySelectorAll('.rating-bar');


            bars.forEach(bar => {


                setTimeout(() => {


                    bar.style.width =
                        bar.dataset.width;


                    bar.style.transition =
                        "width 1.5s ease";


                }, 300);



            });



        });
</script>


@endsection