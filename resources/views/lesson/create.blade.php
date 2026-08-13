@extends('layout.course_ins')
@section("title","CREATE LESSON")

@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">


<div class="max-w-6xl mx-auto px-4">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="gradient-shine text-4xl font-extrabold">
            All lessons ( {{ $course->title }} )
        </h1>
        <p class="text-slate-500 mt-2">
            Upload file → AI generates summary → Instructor edits later
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- FORM -->
        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

                <!-- HEADER BAR -->
                <div class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 p-6 text-white">
                    <h2 class="text-xl font-bold">New Lesson Upload</h2>
                    <p class="text-white/70 text-sm">AI processing enabled</p>
                </div>

                <form id="lessonForm" method="POST" class="p-6 space-y-6">

                    @csrf

                    <input type="hidden" id="course_id" name="course_id" value="{{ $course->id }}">

                    <!-- TITLE -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                            placeholder="Enter lesson title">
                        <p class="text-red-500 text-sm mt-1 hidden" id="error_title"></p>
                    </div>

                    <!-- DESCRIPTION -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                            placeholder="Optional description"></textarea>
                    </div>

                    <!-- FILE -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Upload File</label>

                        <input type="file" name="file" id="file"
                            class="w-full mt-2 px-4 py-3 border rounded-2xl bg-white">

                        <p class="text-xs text-slate-400 mt-1">
                            PDF / MP4 supported (AI will process automatically)
                        </p>

                        <p class="text-red-500 text-sm mt-1 hidden" id="error_file"></p>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex gap-4">
                        <button type="submit"
                            id="submitBtn"
                            class="px-6 py-2 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                            Create Lesson
                        </button>

                        <!-- <button type="button"
                            onclick="document.getElementById('lessonForm').reset()"
                            class="px-6 py-2 rounded-2xl border hover:bg-slate-50">
                            Reset
                        </button> -->
                    </div>

                </form>
            </div>
        </div>

        <!-- INFO PANEL -->
        <div class="space-y-6">

            <div class="bg-white rounded-3xl p-6 border shadow-sm">
                <h3 class="font-bold text-slate-900 mb-3">AI Flow</h3>
                <ul class="text-sm space-y-3 text-slate-600">
                    <li>1. Upload file</li>
                    <li>2. Extract text (PDF / Video)</li>
                    <li>3. AI generates summary</li>
                    <li>4. Cache preview (edit later)</li>
                </ul>
            </div>

            <div class="bg-slate-900 text-white rounded-3xl p-6">
                <h3 class="font-bold mb-2">Important</h3>
                <p class="text-sm text-slate-300">
                    Do not close page during processing. AI may take 30–120 seconds.
                </p>
            </div>

        </div>
    </div>
</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('lessonForm');
        const submitBtn = document.getElementById('submitBtn');

        let polling = null;

        // =========================
        // SWEET ALERT PROGRESS UI
        // =========================
        function showProgress() {
            Swal.fire({
                title: 'AI Processing...',
                html: `
                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden mt-4">
                    <div id="bar" class="h-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 w-0"></div>
                </div>
                <p id="text" class="mt-3 text-indigo-600 font-bold">Starting...</p>`,
                showConfirmButton: false,
                allowOutsideClick: false,
            });
        }

        function updateProgress(percent, status) {
            const bar = document.getElementById('bar');
            const text = document.getElementById('text');

            if (bar) bar.style.width = percent + '%';

            if (text) {
                if (percent < 20) text.innerText = "Uploading...";
                else if (percent < 50) text.innerText = "Extracting content...";
                else if (percent < 80) text.innerText = "AI generating summary...";
                else text.innerText = "Finalizing...";
            }
        }

        function pollStatus(id) {

            polling = setInterval(async () => {

                try {
                    const course_id = document.getElementById('course_id').value;

                    const res = await fetch(`{{ route('lesson.status',':id') }}`.replace(':id', id));

                    const data = await res.json();

                    updateProgress(data.progress, data.status);

                    if (data.status === 'completed') {
                        clearInterval(polling);

                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: 'AI Summary ready for review'
                        }).then(() => {
                            const course_id = document.getElementById('course_id').value;

                            let url = "{{ route('lesson.preview', ['id' => ':id', 'course_id' => ':course_id']) }}";

                            url = url.replace(':id', id).replace(':course_id', course_id);
                            window.location.href = url;
                        });
                    }

                    if (data.status === 'failed') {
                        clearInterval(polling);

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.error || 'Processing failed'
                        });

                        submitBtn.disabled = false;
                        submitBtn.innerText = "Create Lesson";
                    }

                } catch (err) {
                    console.error(err);
                }

            }, 2000);
        }


        // =========================
        // FORM SUBMIT (FETCH API)
        // =========================
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.innerText = "Processing...";

            const formData = new FormData(form);
            try {

                const res = await fetch("{{ route('lesson.store') }}", {
                    method: "POST",

                    headers: {
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: formData,

                    credentials: "same-origin"
                });

                console.log("LESSON STORE STATUS:", res.status);

                // Get raw response first
                const raw = await res.text();

                console.log("LESSON STORE RESPONSE:", raw);

                let data = {};

                // Try JSON parsing
                try {
                    data = JSON.parse(raw);
                } catch (jsonError) {

                    console.error("SERVER DID NOT RETURN JSON:", raw);

                    if (res.status === 413) {
                        throw new Error(
                            "File is too large. Maximum lesson file size is 50 MB."
                        );
                    }

                    if (res.status === 419) {
                        throw new Error(
                            "Session expired. Please refresh the page and try again."
                        );
                    }

                    if (res.status === 422) {
                        throw new Error(
                            "Validation failed. Please check your lesson information."
                        );
                    }

                    if (res.status === 500) {
                        throw new Error(
                            "Server error while uploading lesson. Please try again."
                        );
                    }

                    if (res.status === 405) {
                        throw new Error(
                            "Invalid request method. Please refresh the page and try again."
                        );
                    }

                    throw new Error(
                        `Server returned HTTP ${res.status}.`
                    );
                }

                // HTTP error
                if (!res.ok) {

                    let message =
                        data.message ||
                        data.error ||
                        "Lesson upload failed.";

                    // Laravel validation errors
                    if (res.status === 422 && data.errors) {

                        message = Object.values(data.errors)
                            .flat()
                            .join("\n");
                    }

                    throw new Error(message);
                }

                // Laravel success check
                if (data.success !== true) {

                    throw new Error(
                        data.message || "Lesson upload failed."
                    );
                }

                // Lesson ID required
                if (!data.lesson_id) {

                    throw new Error(
                        "Lesson was created but lesson ID was not returned."
                    );
                }

                console.log(
                    "LESSON CREATED SUCCESSFULLY:",
                    data
                );

                // Show progress
                showProgress();

                updateProgress(
                    Number(data.progress ?? 10),
                    data.status ?? "pending"
                );

                // Start polling
                pollStatus(data.lesson_id);


            } catch (err) {

                console.error(
                    "LESSON CREATE ERROR:",
                    err
                );

                let message = "Lesson upload failed.";

                // Network error
                if (err instanceof TypeError && err.message === "Failed to fetch") {
                    message =
                        "Lesson upload request failed. Please check the Network tab for /lesson/store.";

                } else if (err.message) {

                    message = err.message;
                }

                Swal.fire({

                    icon: "error",

                    title: "Lesson Creation Failed",

                    text: message,

                    confirmButtonText: "OK"

                });

                submitBtn.disabled = false;

                submitBtn.innerText = "Create Lesson";
            }
            // try {
            //     const res = await fetch("{{ route('lesson.store') }}", {
            //         method: "POST",
            //         headers: {
            //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
            //         },
            //         body: formData
            //     });
            //     const data = await res.json();

            //     if (!res.ok) throw data;

            //     showProgress();
            //     updateProgress(10, 'start');

            //     pollStatus(data.lesson_id);

            // } catch (err) {

            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error',
            //         text: err.message || 'Something went wrong'
            //     });

            //     submitBtn.disabled = false;
            //     submitBtn.innerText = "Create Lesson";
            // }
        });

    });
</script>

@endsection