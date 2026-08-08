@extends('layout.course_ins')
@section('title','Course Edit')
@section('page','Instructor Course Edit And Schedule Edit.')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 p-8">

            <h1 class="text-4xl font-bold text-white">
                Edit Course
            </h1>

            <p class="text-white/80 mt-2">
                Update your course information
            </p>

        </div>
        @php $c = [

        "Backend Language",
        "Frontend Language",
        "Web Development",
        "Mobile Development",
        "Artificial Intelligence",
        "Data Science",
        "Cyber Security",
        "UI/UX Design",
        "Graphic Design",
        "Business",
        "Photography",
        "Video Editing",
        "Language",
        "Other"

        ];
        @endphp

        <form class="bg-gradient-to-r from-sky-50 via-blue-50 to-indigo-50"
            action="{{ route('instructor.course.update',$course) }}"
            method="POST"
            enctype="multipart/form-data"
            id="courseForm">

            @csrf
            @method('PUT')

            <div class="p-8 space-y-8">

                {{-- Title --}}
                <div>

                    <label class="font-semibold">
                        Course Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title',$course->title) }}"
                        class="w-full mt-2 rounded-xl border p-4 focus:ring-2 focus:ring-indigo-500">

                </div>
                {{-- Description --}}
                <div>

                    <label class="font-semibold">
                        Description
                    </label>

                    <textarea
                        rows="8"
                        name="description"
                        class="w-full mt-2 rounded-xl border p-4">{{ old('description',$course->description) }}</textarea>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Category --}}
                    <div>

                        <label class="font-semibold">
                            Category
                        </label>

                        <!-- <input
                            type="text"
                            name="category"
                            value="{{ old('category',$course->category) }}"
                            class="w-full mt-2 rounded-xl border p-4"> -->
                        <select name="category" required
                            class="w-full p-4 rounded-2xl border
                       focus:ring-4 focus:ring-violet-200
                       hover:shadow-lg transition">
                            <option>{{ old('category',$course->category) }}</option>
                            @foreach ($c as $category )
                            <option>{{$category}}</option>

                            @endforeach

                        </select>
                    </div>

                    {{-- Level --}}
                    <div>

                        <label class="font-semibold">
                            Level
                        </label>

                        <select
                            name="level"
                            class="w-full mt-2 rounded-xl border p-4">

                            <option value="Beginner"
                                @selected(old('level',$course->level)=='Beginner')>
                                Beginner
                            </option>

                            <option value="Intermediate"
                                @selected(old('level',$course->level)=='Intermediate')>
                                Intermediate
                            </option>

                            <option value="Advanced"
                                @selected(old('level',$course->level)=='Advanced')>
                                Advanced
                            </option>

                        </select>

                    </div>

                    {{-- Price --}}
                    <div>

                        <label class="font-semibold">
                            Price
                        </label><input
                            type="number"
                            name="price"
                            value="{{ old('price',$course->price) }}"
                            class="w-full mt-2 rounded-xl border p-4">

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="font-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full mt-2 rounded-xl border p-4">

                            <option value="draft"
                                @selected(old('status',$course->status)=='draft')>
                                Draft
                            </option>

                            <option value="published"
                                @selected(old('status',$course->status)=='published')>
                                Published
                            </option>

                        </select>

                    </div>

                    {{-- Start Date --}}
                    <div>

                        <label class="font-semibold">
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ old('start_date',$course->start_date) }}"
                            class="w-full mt-2 rounded-xl border p-4">

                    </div>

                    {{-- End Date --}}
                    <div>

                        <label class="font-semibold">
                            End Date
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            value="{{ old('end_date',$course->end_date) }}"
                            class="w-full mt-2 rounded-xl border p-4">

                    </div>

                </div>

                {{-- Thumbnail --}}
                <div>

                    <label class="font-semibold">
                        Thumbnail
                    </label>

                    @if($course->thumbnail)

                    <img
                        src="{{ asset('storage/'.$course->thumbnail) }}"
                        class="w-40 rounded-xl mt-4 mb-4">

                    @endif

                    <input
                        type="file"
                        name="thumbnail"
                        class="w-full mt-2">

                </div>



                {{-- Schedule --}}
                <div>

                    <div class="flex justify-between items-center mb-5">

                        <h2 class="text-2xl font-bold">
                            Course Schedule
                        </h2>

                        <button
                            type="button"
                            id="addSchedule"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                            + Add Schedule

                        </button>

                    </div>

                    <div id="scheduleContainer">
                        @php
                        $oldSchedules = old('schedules', $course->schedules->toArray());
                        @endphp

                        @foreach($oldSchedules as $i=>$schedule)

                        <div class="schedule-card border rounded-2xl p-6 mb-5 bg-gray-50">

                            <div class="grid md:grid-cols-3 gap-4">

                                <select
                                    name="schedules[{{ $i }}][day]"
                                    class="border rounded-xl p-3">

                                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)

                                    <option
                                        value="{{ $day }}"
                                        @selected(($schedule['day'] ?? '' )==$day)>

                                        {{ $day }}

                                    </option>

                                    @endforeach

                                </select>

                                <input
                                    type="time"
                                    name="schedules[{{ $i }}][start_time]"
                                    value="{{ $schedule['start_time'] ?? '' }}"
                                    class="border rounded-xl p-3">

                                <input
                                    type="time"
                                    name="schedules[{{ $i }}][end_time]"
                                    value="{{ $schedule['end_time'] ?? '' }}"
                                    class="border rounded-xl p-3">

                            </div>

                            <div class="text-right mt-4">

                                <button
                                    type="button"
                                    class="removeSchedule bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                    Remove

                                </button>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <div class="text-center">

                    <button
                        type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-pink-600 hover:scale-105 duration-300 text-white px-12 py-4 rounded-2xl text-lg font-bold">

                        Update Course

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let scheduleIndex = `{{ count(old('schedules', $course->schedules)) }}`;

    const container = document.getElementById('scheduleContainer');

    document.getElementById('addSchedule').addEventListener('click', function() {

        const html = `
    <div class="schedule-card border rounded-2xl p-6 mb-5 bg-gray-50">

        <div class="grid md:grid-cols-3 gap-4">

            <select
                name="schedules[${scheduleIndex}][day]"
                class="border rounded-xl p-3">

                <option value="">Choose Day</option>

                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>

            </select>

            <input
                type="time"
                name="schedules[${scheduleIndex}][start_time]"
                class="border rounded-xl p-3">

            <input
                type="time"
                name="schedules[${scheduleIndex}][end_time]"
                class="border rounded-xl p-3">

        </div>

        <div class="text-right mt-4">

            <button
                type="button"
                class="removeSchedule bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                Remove

            </button>

        </div>

    </div>`;

        container.insertAdjacentHTML('beforeend', html);

        scheduleIndex++;

    });

    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('removeSchedule')) {

            e.target.closest('.schedule-card').remove();

        }

    });

    const form = document.getElementById('courseForm');

    let submitting = false;

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        if (submitting) {
            return;
        }

        const cards = document.querySelectorAll('.schedule-card');

        if (cards.length === 0) {

            Swal.fire({
                icon: 'error',
                title: 'Schedule Required',
                text: 'Please add at least one schedule.'
            });

            return;
        }

        let duplicate = [];
        let hasDuplicate = false;

        cards.forEach(function(card) {

            const day = card.querySelector('select').value.trim();

            const start = card.querySelector('input[name*="[start_time]"]').value;

            const end = card.querySelector('input[name*="[end_time]"]').value;

            if (day == '' || start == '' || end == '') {

                hasDuplicate = true;

                Swal.fire({
                    icon: 'error',
                    title: 'Incomplete Schedule',
                    text: 'Please complete every schedule.'
                });

                return;
            }

            if (end <= start) {

                hasDuplicate = true;

                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Time',
                    text: 'End time must be after Start time.'
                });

                return;
            }

            const key = day + '_' + start + '_' + end;

            if (duplicate.includes(key)) {

                hasDuplicate = true;

                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Schedule',
                    text: 'Duplicate schedules are not allowed.'
                });

                return;
            }

            duplicate.push(key);

        });

        if (hasDuplicate) {
            return;
        }

        submitting = true;

        const btn = form.querySelector('button[type=submit]');

        btn.disabled = true;

        btn.innerHTML = `
        <svg class="animate-spin h-5 w-5 inline-block mr-2"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24">

            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4">
            </circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8v8z">
            </path>

        </svg>

        Updating...
    `;

        Swal.fire({

            title: 'Updating Course...',

            text: 'Please wait.',

            allowOutsideClick: false,

            allowEscapeKey: false,

            didOpen: () => {

                Swal.showLoading();

            }

        });

        form.submit();

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({

        icon: 'success',

        title: 'Success',

        text: "{{ session('success') }}",

        timer: 2000,

        showConfirmButton: false

    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({

        icon: 'error',

        title: 'Error',

        text: "{{ session('error') }}"

    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({

        icon: 'error',

        title: 'Validation Error',

        text: "{{ $errors->first() }}"

    });
</script>
@endif
@endsection