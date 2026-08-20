@extends('layout.course_ins')
@section("title","Course")
@section("page","Each Course Dashboard.")

@section('content')
<div
    class="relative overflow-hidden rounded-[32px] bg-white-80 border border-slate-200 shadow-lg">
    <div
        class="relative p-4 md:p-8 lg:p-10">

        <div
            class="grid lg:grid-cols-3 gap-8 items-center">

            <!-- Course Thumbnail -->

            <div class="lg:col-span-1">

                <div
                    class="relative rounded-3xl overflow-hidden shadow-2xl group">
                    @if($course->thumbnail_url)
                    <img
                        src="{{ $course->thumbnail_url }}"
                        alt="{{ $course->title }}"
                        class="w-full h-72 object-cover transition duration-700 group-hover:scale-110">
                    @else
                    <div class="w-full h-48 flex items-center justify-center">
                        No Image
                    </div>
                    @endif




                    <!-- Status -->

                    <div
                        class="absolute top-5 left-5">

                        @if($course->status=='draft')

                        <span
                            class="px-4 py-2 rounded-full bg-green-500 text-white font-semibold shadow-lg">

                            ✅ Active

                        </span>

                        @elseif($course->status=='completed')
                        <span
                            class="px-4 py-2 rounded-full bg-slate-500 text-white font-semibold shadow-lg">

                            ✅ Completed

                        </span>
                        @else

                        <span
                            class="px-4 py-2 rounded-full bg-yellow-500 text-white font-semibold">

                            ⏳ Pending

                        </span>

                        @endif

                    </div>

                </div>

            </div>

            <!-- Course Details -->

            <div class="lg:col-span-2 text-white">
                <div
                    class="flex flex-wrap gap-3 mb-5">
                    <span
                        class="px-4 py-2 rounded-full bg-sky-100 text-blue-700 text-sm">
                        {{ $course->category }}
                    </span>
                    <span
                        class="px-4 py-2 rounded-full bg-cyan-500 text-sm">

                        {{ ucfirst($course->level) }}

                    </span>

                    @if(auth()->user()->role == 2)
                    <a href="{{ route('instructor.course.edit',$course->id) }}"
                        class="px-4 py-2 rounded-full bg-orange-500 text-sm font-bold">

                        Course edit

                    </a>
                    @endif
                    @if($course->status != 'completed' && auth()->user()->role == 2)
                    <button
                        type="button"
                        onclick="completeCourse('{{ $course->id }}')"
                        class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition">
                        Complete Course
                    </button>
                    @endif
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        function completeCourse(courseId) {

                            Swal.fire({
                                title: 'Complete Course?',
                                text: "After completing, learners will know this course is finished.",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#16a34a',
                                cancelButtonColor: '#ef4444',
                                confirmButtonText: 'Yes, Complete',
                                cancelButtonText: 'No'
                            }).then((result) => {

                                if (result.isConfirmed) {

                                    fetch(`{{ route('instructor.course.complete',':course_id') }}`.replace(':course_id', courseId), {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            }
                                        })
                                        .then(res => res.json())
                                        .then(data => {

                                            if (data.success) {

                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Completed',
                                                    text: data.message
                                                }).then(() => {
                                                    location.reload();
                                                });

                                            } else {

                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Cannot Complete',
                                                    html: data.message
                                                });

                                            }

                                        });

                                }

                            });

                        }
                    </script>
                </div>

                <h1
                    class="text-xl lg:text-3xl text-slate-700 font-bold leading-tight">

                    {{ $course->title }}

                </h1>


                <!-- Statistics -->

                <div
                    class="grid grid-cols-2 md:grid-cols-3 gap-5 mt-4 md:mt-10">
                    <div
                        class="rounded-2xl bg-blue-100/50 backdrop-blur p-5">
                        <p class="text-slate-600 text-sm font-semibold">
                            Price
                        </p>
                        <h3 class="text-blue-700 font-bold">
                            {{ number_format($course->price) }} MMK
                        </h3>
                    </div>
                    <div
                        class="rounded-2xl bg-green-100/50 p-5">
                        <p class="text-slate-700 font-semibold text-sm">
                            Start Date
                        </p>
                        <h3 class="font-bold text-green-700">
                            {{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }}
                        </h3>
                    </div>
                    <div
                        class="rounded-2xl bg-pink-100/50 p-5">
                        <p class="text-slate-700 font-semibold text-sm">
                            End Date
                        </p>
                        <h3 class="font-bold text-pink-700">
                            {{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}
                        </h3>
                    </div>

                </div>
                <!-- Buttons -->
            </div>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mt-5 sm:px-3 md:mt-10">

    <!-- Total Learners -->
    <div
        class="group bg-white/50 rounded-3xl  px-7 py-5 shadow-md border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition duration-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">
                    Total Learners
                </p>
                <h2
                    class="text-2xl font-extrabold text-indigo-700 mt-3">
                    {{ number_format($totalLearners) }}
                </h2>
                <p class="text-green-600 mt-3">
                    Active Students
                </p>
            </div>
            <div
                class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl group-hover:rotate-12 transition">
                👨‍🎓
            </div>
        </div>
    </div>



    <!-- Lessons -->

    <div
        class="group bg-white/50 rounded-3xl  px-7 py-5 shadow-md border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition duration-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">
                    Lessons
                </p>
                <h2
                    class="text-2xl font-extrabold text-pink-600 mt-3">
                    {{ $totalLessons }}
                </h2>
                <p class="text-gray-500 mt-3">
                    This Month
                    <span class="font-bold text-pink-600">
                        +{{ $currentMonthLessons }}
                    </span>
                </p>
            </div>
            <div
                class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center text-2xl group-hover:rotate-12 transition">
                📚
            </div>
        </div>
    </div>



    <!-- Live Sessions -->

    <div
        class="group bg-white/50 rounded-3xl px-7 py-5 shadow-md border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition duration-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">
                    Live Sessions
                </p>
                <h2
                    class="text-2xl font-extrabold text-green-600 mt-3">
                    {{ $totalLives }}
                </h2>
                <p class="text-gray-500 mt-3">
                    This Month
                    <span class="font-bold text-green-600">
                        +{{ $currentMonthLives }}
                    </span>
                </p>
            </div>
            <div
                class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl group-hover:rotate-12 transition">
                🎥
            </div>
        </div>
    </div>

    <!-- Quizzes -->
    <div
        class="group bg-white/50 rounded-3xl  px-7 py-5 shadow-md border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition duration-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">
                    Quizzes
                </p>
                <h2
                    class="text-2xl font-extrabold text-orange-500 mt-3">
                    {{ $totalQuizzes }}
                </h2>
                <p class="text-gray-500 mt-3">
                    This Month
                    <span class="font-bold text-orange-500">
                        +{{ $currentMonthQuizzes }}
                    </span>
                </p>
            </div>
            <div
                class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center text-2xl group-hover:rotate-12 transition">
                📝
            </div>
        </div>
    </div>
</div>

<div class="mt-5 sm:px-3 md:mt-10">

    <label class="text-slate-700 text-xl font-bold">

        Course Description

    </label>

    <div
        class="mt-3 bg-white/70 rounded-2xl shadow-md p-6 leading-8 text-gray-700">

        {!! nl2br(e($course->description)) !!}

    </div>

</div>



<div class="mt-5 sm:px-3 md:mt-10">

    <div class="bg-white rounded-[32px] shadow-xl border border-gray-100 overflow-hidden">

        <!-- Header -->

        <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 px-8 py-6">

            <h2 class="text-2xl font-bold text-white">

                👨‍🏫 Instructor Information

            </h2>

            <p class="text-white/80 mt-2">

                Course instructor profile and statistics

            </p>

        </div>

        <!-- Body -->

        <div class="p-8">

            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Left -->

                <div class="text-center">

                    <img
                        src="https://ui-avatars.com/api/?name={{ $instructor->name }}"
                        class="w-32 h-32 rounded-full object-cover mx-auto shadow-xl">

                    <h3 class="text-xl font-bold mt-6">

                        {{ $instructor->name }}

                    </h3>

                </div>

                <!-- Right -->

                <div class="lg:col-span-2">

                    <div class="grid md:grid-cols-2 gap-6">

                        <div class="bg-gray-50 rounded-2xl p-5">

                            <p class="text-gray-500 text-sm">

                                Email

                            </p>

                            <h3 class="font-bold mt-2">

                                {{ $course->instructor->email }}

                            </h3>

                        </div>

                        <div class="bg-gray-50 rounded-2xl p-5">

                            <p class="text-gray-500 text-sm">

                                Role

                            </p>

                            <h3 class="font-bold mt-2">

                                Instructor

                            </h3>

                        </div>

                        <div class="bg-gray-50 rounded-2xl p-5">

                            <p class="text-gray-500 text-sm">

                                Total Courses

                            </p>

                            <h3 class="font-bold text-2xl text-indigo-600 mt-2">

                                {{ $course->instructor->courses()->count() }}

                            </h3>

                        </div>

                        <div class="bg-gray-50 rounded-2xl p-5">

                            <p class="text-gray-500 text-sm">

                                Member Since

                            </p>

                            <h3 class="font-bold mt-2">

                                {{ $course->instructor->created_at->format('d M Y') }}

                            </h3>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </div>

</div>

@endsection