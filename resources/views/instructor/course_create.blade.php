@extends('layout.ins')
@section('title','Create Course')
@section('page','Instructor Create Course and add Schedule.')
@section('content')

<div class="max-w-7xl mx-auto p-6">

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-5">
        {{ session('success') }}
    </div>
    @endif
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
    <form action="{{ route('course.course_store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="max-w-5xl mx-auto p-6 md:p-10 rounded-3xl
                bg-gradient-to-br from-indigo-50 via-white to-violet-50
                shadow-2xl border border-gray-200
                transition-all duration-500 hover:shadow-indigo-200/50">

        @csrf

        <!-- Header -->
        <div class="text-center mb-10 animate-fade-in">
            <h1 class="text-xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 via-violet-600 to-blue-600
                   text-transparent bg-clip-text">
                Create New Course
            </h1>
            <p class="text-gray-500 mt-2">
                Build your course with modern 2026 UI experience
            </p>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6">

            @foreach ([
            'Title' => 'text',
            'Price' => 'number'
            ] as $label => $type)

            <div class="group space-y-2 transition duration-300 hover:-translate-y-1">
                <label class="text-sm font-semibold text-gray-600 group-hover:text-indigo-600 transition">
                    {{ $label }}
                </label>

                <input type="{{ $type }}" required maxlength="30"
                    name="{{ strtolower(str_replace(' ', '_', $label)) }}"
                    class="w-full p-2 md:p-4 rounded-lg md:rounded-2xl border border-slate-300
                       focus:ring-4 focus:ring-indigo-200 focus:border-indigo-400
                       transition-all duration-300
                       hover:shadow-lg hover:scale-[1.02]">
            </div>

            @endforeach


            <!-- Level -->
            <div class="group hover:-translate-y-1 transition">
                <label class="text-sm font-semibold text-slate-700 group-hover:text-violet-600">Category</label>
                <select name="category" required
                    class="w-full  p-2 md:p-4 rounded-lg md:rounded-2xl border
                       focus:ring-4 focus:ring-violet-200
                       hover:shadow-lg transition">

                    @foreach ($c as $category )
                    <option>{{$category}}</option>

                    @endforeach

                </select>
            </div>
            <!-- Level -->
            <div class="group hover:-translate-y-1 transition  text-slate-700">
                <label class="text-sm font-semibold group-hover:text-violet-600">Level</label>
                <select name="level" required
                    class="w-full  p-2 md:p-4 rounded-lg md:rounded-2xl border 
                       focus:ring-4 focus:ring-violet-200
                       hover:shadow-lg transition">
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>
            </div>

            <!-- Dates -->
            <div class="hover:-translate-y-1 transition">
                <label class="text-sm font-semibold  text-slate-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" required
                    class="w-full  p-2 md:p-4 rounded-lg md:rounded-2xl border date-input
                       hover:shadow-lg focus:ring-4 focus:ring-indigo-200">
            </div>

            <div class="hover:-translate-y-1 transition  text-slate-700">
                <label class="text-sm font-semibold  text-slate-700">End Date</label>
                <input type="date" name="end_date" required id="end_date"
                    class="w-full  p-2 md:p-4 rounded-lg md:rounded-2xl border date-input
                       hover:shadow-lg focus:ring-4 focus:ring-indigo-200">
            </div>

            <!-- FILE UPLOAD (Animated Card) -->
            <div class=" p-2 md:p-4 rounded-lg md:rounded-2xl border border-dashed border-indigo-300
                    bg-white hover:bg-indigo-50 transition 
                    hover:scale-[1.02] duration-300">
                <label class="font-semibold text-indigo-600">Thumbnail</label>
                <input type="file" id="imageInput" name="thumbnail" required class="w-full mt-2">
                <div id="imageInfo" class="mt-2 text-sm text-gray-600"></div>

                <div id="imageError" class="hidden mt-2 text-sm text-red-500">
                    Image size must be less than 100KB
                </div>
            </div>


            <div class="group hover:scale-[1.01] transition md:col-span-1  text-slate-700">
                <div class="flex justify-between items-center">
                    <label class="font-semibold group-hover:text-violet-600">Full Description</label>
                    <span id="char-counter" class="text-xs text-gray-500 font-semibold">0 / 100</span>
                </div>
                <textarea id="description" name="description" rows="4" required maxlength="100"
                    oninput="validateDescription()"
                    class="w-full mt-2  p-2 md:p-4 rounded-lg md:rounded-2xl border border-slate-300
                       focus:ring-4 focus:ring-violet-200
                       hover:shadow-lg transition-all"></textarea>
            </div>
        </div>


        <!-- SCHEDULE CARD -->
        <div class="md:mt-10 mt-4 p-6 rounded-3xl
                bg-gradient-to-r from-indigo-50 to-violet-50
                border border-gray-200
                hover:shadow-xl transition-all duration-300">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-indigo-700">
                    Weekly Schedule
                </h2>

                <button type="button"
                    onclick="addSchedule()"
                    class="px-5 py-2 rounded-2xl
                       bg-gradient-to-r from-indigo-600 to-violet-600
                       text-white font-semibold
                       hover:scale-105 active:scale-95
                       transition-all duration-200 shadow-lg">
                    + Add
                </button>
            </div>

            <div id="schedule-wrapper">
                <div class="flex justify-between">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 schedule-item w-60 md:w-200
                        animate-fade-in">

                        <select name="days[]" required
                            class="p-4 rounded-xl border hover:shadow-md transition">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>
                        </select>

                        <input type="time" name="start_times[]" required
                            class="p-4 rounded-xl border hover:shadow-md transition">

                        <input type="time" name="end_times[]" required
                            class="p-4 rounded-xl border hover:shadow-md transition">
                    </div>
                    <button type="button"
                        onclick="removeSchedule(this)"
                        class="rounded-lg text-red-700 w-8 md:w-12 h-12 
                            hover:scale-105 bg-red-200/50 border border-red-400
                           active:scale-95 transition">
                        <i class="ri-close-large-line font-bold"></i>
                    </button>

                </div>

            </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit"
            class="w-full mt-10 py-4 rounded-2xl
                bg-gradient-to-r from-indigo-600 via-violet-600 to-blue-600
                text-white text-lg font-bold
                shadow-xl
                hover:shadow-indigo-500/50
                hover:scale-[1.02]
                active:scale-95
                transition-all duration-300">
            🚀 Publish Course
        </button>


        @if($errors->has('duplicate_schedule'))

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                Swal.fire({

                    icon: 'error',

                    title: 'Schedule Duplicate',

                    html: `
                        <div style="text-align:left">
                        @foreach($errors->get('duplicate_schedule') as $duplicate)
                                <div style="margin-bottom:10px;">
                                    🔴 {{ $duplicate }}
                                </div>
                        @endforeach
                        </div>`,

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#4F46E5'

                });

            });
        </script>

        @endif
    </form>

</div>


<script>
    const imageInput = document.getElementById('imageInput');
    const imageInfo = document.getElementById('imageInfo');
    const imageError = document.getElementById('imageError');

    let imageValid = true;

    imageInput.addEventListener('change', function() {

        const file = this.files[0];

        if (!file) {
            imageInfo.textContent = '';
            imageError.classList.add('hidden');
            imageValid = false;
            return;
        }


        // File size
        const sizeKB = (file.size / 1024).toFixed(2);

        // File type
        const type = file.type;


        imageInfo.innerHTML = `
        <p>
            <strong>Type:</strong> ${type}
        </p>

        <p>
            <strong>Size:</strong> ${sizeKB} KB
        </p>`;


        // 100 KB limit
        if (file.size > 100 * 1024) {

            imageError.classList.remove('hidden');

            imageInfo.classList.add('text-red-500');

            imageValid = false;

            this.value = ""; // remove selected image

        } else {

            imageError.classList.add('hidden');

            imageInfo.classList.remove('text-red-500');

            imageValid = true;

        }

    });


    // Submit block
    document.querySelector('form').addEventListener('submit', function(e) {

        if (!imageValid) {

            e.preventDefault();

            alert('Please upload an image smaller than 500KB');

        }

    });


    document.addEventListener('DOMContentLoaded', function() {

        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');


        // Current date YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];


        // Start date cannot be before today
        startDate.min = today;


        function updateDateLimit() {

            // Start selected
            if (startDate.value) {

                // End cannot be before Start
                endDate.min = startDate.value;

            } else {

                endDate.min = today;

            }


            // End selected
            if (endDate.value) {

                // Start cannot be after End
                startDate.max = endDate.value;

            } else {

                startDate.removeAttribute('max');

            }

        }


        startDate.addEventListener('change', function() {

            // If selected start > end, clear end
            if (
                endDate.value &&
                startDate.value > endDate.value
            ) {
                endDate.value = '';
            }

            updateDateLimit();

        });


        endDate.addEventListener('change', function() {

            // If selected end < start, clear start
            if (
                startDate.value &&
                endDate.value < startDate.value
            ) {
                startDate.value = '';
            }

            updateDateLimit();

        });


        updateDateLimit();

    });

    function validateDescription() {
        const descInput = document.getElementById('description');
        const counter = document.getElementById('char-counter');

        const length = descInput.value.length;
        counter.textContent = `${length} / 100`;

        if (length > 100) {
            warning.classList.remove('hidden');
            counter.classList.add('text-red-500');
            counter.classList.remove('text-gray-500');
        } else {
            warning.classList.add('hidden');
            counter.classList.remove('text-red-500');
            counter.classList.add('text-gray-500');
        }
    }

    function addSchedule() {
        let html = `

                  <div class="flex justify-between  schedule-item">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 w-200
                        animate-fade-in">

                        <select name="days[]" required
                                onchange="checkScheduleConflicts()"
                                class="p-4 rounded-2xl border day-input">

                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>

                        </select>

                        <input type="time" required
                            name="start_times[]"
                            onchange="checkScheduleConflicts()"
                            class="p-4 rounded-2xl border start-input">

                        <input type="time" required
                            name="end_times[]"
                            onchange="checkScheduleConflicts()"
                            class="p-4 rounded-2xl border end-input">
                        </div>

                        <button type="button"
                                onclick="removeSchedule(this)"
                                class="rounded-lg text-red-700 w-12 h-12 
                            hover:scale-105 bg-red-200/50 border border-red-400
                           active:scale-95 transition">
                        <i class="ri-close-large-line font-bold"></i>
                    </button>


                    </div>
                        `;

        document.getElementById('schedule-wrapper')
            .insertAdjacentHTML('beforeend', html);

        checkScheduleConflicts();
    }

    function removeSchedule(button) {
        button.closest('.schedule-item').remove();

        checkScheduleConflicts();
    }

    function timeToMinutes(time) {
        let parts = time.split(':');

        return parseInt(parts[0]) * 60 + parseInt(parts[1]);
    }

    function checkScheduleConflicts() {
        let schedules = document.querySelectorAll('.schedule-item');

        let hasConflict = false;

        schedules.forEach(item => {

            item.classList.remove('border-2');
            item.classList.remove('border-red-500');

            item.querySelector('.conflict-message').innerHTML = '';

        });

        schedules.forEach((current, index) => {

            let currentDay = current.querySelector('.day-input').value;

            let currentStart =
                current.querySelector('.start-input').value;

            let currentEnd =
                current.querySelector('.end-input').value;

            if (!currentStart || !currentEnd)
                return;

            let currentStartMinutes =
                timeToMinutes(currentStart);

            let currentEndMinutes =
                timeToMinutes(currentEnd);

            schedules.forEach((other, otherIndex) => {

                if (index === otherIndex)
                    return;

                let otherDay =
                    other.querySelector('.day-input').value;

                let otherStart =
                    other.querySelector('.start-input').value;

                let otherEnd =
                    other.querySelector('.end-input').value;

                if (!otherStart || !otherEnd)
                    return;

                let otherStartMinutes =
                    timeToMinutes(otherStart);

                let otherEndMinutes =
                    timeToMinutes(otherEnd);

                if (currentDay === otherDay) {
                    let overlap =

                        currentStartMinutes < otherEndMinutes &&
                        currentEndMinutes > otherStartMinutes;

                    if (overlap) {
                        hasConflict = true;

                        current.classList.add(
                            'border-2',
                            'border-red-500'
                        );

                        other.classList.add(
                            'border-2',
                            'border-red-500'
                        );

                        current.querySelector(
                                '.conflict-message'
                            ).innerHTML =
                            'Schedule conflict';

                        other.querySelector(
                                '.conflict-message'
                            ).innerHTML =
                            'Schedule conflict';
                    }
                }

            });

        });

        let submitButton =
            document.getElementById('submit-button');
        if (hasConflict) {
            submitButton.disabled = true;

            submitButton.classList.add(
                'opacity-50',
                'cursor-not-allowed'
            );
        } else {
            submitButton.disabled = false;

            submitButton.classList.remove(
                'opacity-50',
                'cursor-not-allowed'
            );
        }
    }
</script>

@endsection