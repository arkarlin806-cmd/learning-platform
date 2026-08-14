@extends('layout.course_ins')

@section("title","Lesson Summaries")
@section("page","Instructor Save, Add And Repair Lesson Summaries")

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">
            AI Lesson Review
        </h1>

        <p class="text-slate-500">
            Edit, repair, add or remove AI-generated content before saving.
        </p>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- MAIN EDITOR -->
        <div class="lg:col-span-2 space-y-6">

            <!-- TITLE -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <label class="text-sm font-semibold text-slate-600">
                    Lesson Title
                </label>

                <input
                    id="title"
                    type="text"
                    value="{{ $summary->title ?? '' }}"
                    class="w-full mt-2 px-4 py-3 bg-slate-100 border border-slate-300 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none">

            </div>


            <!-- SUMMARY -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <div class="flex justify-between items-center">

                    <label class="text-sm font-semibold text-slate-600">
                        Lesson Summary
                    </label>

                    <span
                        id="summaryCount"
                        class="text-xs text-slate-400">
                        0 characters
                    </span>

                </div>

                <textarea
                    id="summary"
                    rows="10"
                    class="w-full mt-2 px-4 py-3 bg-slate-100 border border-slate-300 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none">{{ $summary->summary ?? '' }}</textarea>

            </div>


            <!-- KEY POINTS -->
            <div class="bg-white rounded-3xl p-6 shadow border border-slate-300">

                <div class="flex justify-between items-center mb-4">

                    <div>
                        <h3 class="font-bold text-slate-800">
                            Key Points
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Edit, delete or add key points.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="addPoint()"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold">
                        + Add Point
                    </button>

                </div>


                <div
                    id="points"
                    class="space-y-3">

                    @foreach($summary->key_points ?? [] as $point)

                    <div class="point-row flex gap-2 items-start">

                        <div class="flex-1">

                            <input
                                type="text"
                                class="point w-full px-4 py-3 bg-slate-100 border border-slate-300 rounded-xl outline-none focus:ring-4 focus:ring-indigo-100"
                                value="{{ $point }}"
                                placeholder="Enter key point">

                        </div>

                        <button
                            type="button"
                            onclick="deletePoint(this)"
                            class="w-11 h-11 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100"
                            title="Delete">
                            <i class="ri-delete-bin-line text-xl"></i>
                        </button>

                    </div>

                    @endforeach

                </div>


                <!-- EMPTY MESSAGE -->

                <div
                    id="emptyPoints"
                    class="{{ count($summary->key_points ?? []) > 0 ? 'hidden' : '' }} text-center py-8 text-slate-400">
                    <i class="ri-list-check-3 text-4xl"></i>

                    <p class="mt-2 text-sm">
                        No key points yet.
                    </p>

                    <p class="text-xs">
                        Click "+ Add Point" to add one.
                    </p>
                </div>

            </div>


            <!-- SAVE -->
            <button
                id="saveBtn"
                type="button"
                onclick="saveSummary()"
                class="w-full py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-2xl font-bold hover:opacity-90 transition">

                <i class="ri-save-line mr-2"></i>
                Save Final Summary

            </button>

        </div>


        <!-- SIDE PANEL -->

        <div class="space-y-6">

            <div class="bg-white rounded-3xl p-6 border shadow">

                <h3 class="font-bold mb-3">
                    Instructor Tools
                </h3>

                <ul class="text-sm text-slate-600 space-y-3">

                    <li>
                        <i class="ri-check-line text-green-600"></i>
                        Edit AI title
                    </li>

                    <li>
                        <i class="ri-check-line text-green-600"></i>
                        Repair summary
                    </li>

                    <li>
                        <i class="ri-check-line text-green-600"></i>
                        Add key points
                    </li>

                    <li>
                        <i class="ri-check-line text-green-600"></i>
                        Delete key points
                    </li>

                    <li>
                        <i class="ri-check-line text-green-600"></i>
                        Final approval save
                    </li>

                </ul>

            </div>


            <div class="bg-slate-900 text-white rounded-3xl p-6">

                <h3 class="font-bold mb-2">
                    Review Before Saving
                </h3>

                <p class="text-sm text-slate-300">
                    Your changes will be saved permanently when you click
                    <strong>Save Final Summary</strong>.
                </p>

            </div>

        </div>

    </div>

</div>


<script>
    /*
    |--------------------------------------------------------------------------
    | SUMMARY CHARACTER COUNT
    |--------------------------------------------------------------------------
    */

    const summaryInput = document.getElementById('summary');
    const summaryCount = document.getElementById('summaryCount');

    function updateSummaryCount() {

        summaryCount.textContent =
            `${summaryInput.value.length} characters`;

    }

    summaryInput.addEventListener(
        'input',
        updateSummaryCount
    );

    updateSummaryCount();


    /*
    |--------------------------------------------------------------------------
    | ADD KEY POINT
    |--------------------------------------------------------------------------
    */

    function addPoint() {

        const container =
            document.getElementById('points');

        const emptyMessage =
            document.getElementById('emptyPoints');

        const row =
            document.createElement('div');

        row.className =
            'point-row flex gap-2 items-start';

        row.innerHTML = `
            <div class="flex-1">

                <input
                    type="text"
                    class="point w-full px-4 py-3 bg-slate-100 border border-slate-300 rounded-xl outline-none focus:ring-4 focus:ring-indigo-100"
                    placeholder="Enter new key point"
                >

            </div>

            <button
                type="button"
                onclick="deletePoint(this)"
                class="w-11 h-11 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100"
                title="Delete"
            >
                <i class="ri-delete-bin-line text-xl"></i>
            </button>
        `;

        container.appendChild(row);

        emptyMessage.classList.add('hidden');

        row.querySelector('.point').focus();
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE KEY POINT
    |--------------------------------------------------------------------------
    */

    function deletePoint(button) {

        const row =
            button.closest('.point-row');

        if (!row) return;

        row.remove();

        checkEmptyPoints();
    }


    /*
    |--------------------------------------------------------------------------
    | EMPTY POINTS CHECK
    |--------------------------------------------------------------------------
    */

    function checkEmptyPoints() {

        const rows =
            document.querySelectorAll('.point-row');

        const emptyMessage =
            document.getElementById('emptyPoints');

        if (rows.length === 0) {

            emptyMessage.classList.remove('hidden');

        } else {

            emptyMessage.classList.add('hidden');

        }
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE SUMMARY
    |--------------------------------------------------------------------------
    */

    async function saveSummary() {

        const saveBtn =
            document.getElementById('saveBtn');

        const title =
            document.getElementById('title').value.trim();

        const summary =
            document.getElementById('summary').value.trim();


        /*
        |--------------------------------------------------------------------------
        | BASIC VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!title) {

            Swal.fire({
                icon: 'warning',
                title: 'Title required',
                text: 'Please enter the lesson title.'
            });

            return;
        }


        if (!summary) {

            Swal.fire({
                icon: 'warning',
                title: 'Summary required',
                text: 'Please enter the lesson summary.'
            });

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | COLLECT KEY POINTS
        |--------------------------------------------------------------------------
        */

        const points = Array.from(
                document.querySelectorAll('.point')
            )
            .map(input => input.value.trim())
            .filter(point => point.length > 0);


        /*
        |--------------------------------------------------------------------------
        | CONFIRM SAVE
        |--------------------------------------------------------------------------
        */

        const confirm = await Swal.fire({

            icon: 'question',

            title: 'Save Final Summary?',

            text: 'Your edited lesson summary will be saved.',

            showCancelButton: true,

            confirmButtonText: 'Yes, Save',

            cancelButtonText: 'Review Again',

            reverseButtons: true

        });


        if (!confirm.isConfirmed) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | LOADING
        |--------------------------------------------------------------------------
        */

        saveBtn.disabled = true;

        saveBtn.innerHTML = `
            <i class="ri-loader-4-line animate-spin mr-2"></i>
            Saving...
        `;


        try {

            const res = await fetch(
                "{{ route('lesson.save.summary', $lesson->id) }}", {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-Requested-With": "XMLHttpRequest",

                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    credentials: "same-origin",

                    body: JSON.stringify({
                        title: title,
                        summary: summary,
                        key_points: points
                    })
                }
            );


            const raw =
                await res.text();


            let data = {};

            try {

                data = JSON.parse(raw);

            } catch (e) {

                console.error(
                    "SAVE SUMMARY NON JSON:",
                    raw
                );

                throw new Error(
                    `Server returned HTTP ${res.status}`
                );
            }


            if (!res.ok) {

                let message =
                    data.message ||
                    'Failed to save summary.';

                if (
                    res.status === 422 &&
                    data.errors
                ) {

                    message =
                        Object.values(data.errors)
                        .flat()
                        .join('\n');
                }

                throw new Error(message);
            }


            if (!data.success) {

                throw new Error(
                    data.message ||
                    'Failed to save summary.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            await Swal.fire({

                icon: 'success',

                title: 'Saved!',

                text: 'Lesson summary saved successfully.',

                confirmButtonText: 'Continue'

            });


            window.location.href =
                "{{ route('lesson.show', $course->id) }}";


        } catch (error) {

            console.error(
                'SAVE SUMMARY ERROR:',
                error
            );

            Swal.fire({

                icon: 'error',

                title: 'Save Failed',

                text: error.message ||
                    'Unable to save lesson summary.'

            });

            saveBtn.disabled = false;

            saveBtn.innerHTML = `
                <i class="ri-save-line mr-2"></i>
                Save Final Summary
            `;
        }
    }
</script>

@endsection