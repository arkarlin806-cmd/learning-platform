@extends('layout.course_ins')
@section("title","Lesson Create")
@section("page","Instructor Lesson Create And Add Summaries with AI.")

@section('content')


<div class="max-w-6xl mx-auto px-4">
    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="gradient-shine text-3xl font-extrabold">
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

                <form
                    id="lessonForm"
                    method="POST"
                    action="{{ route('lesson.store') }}"
                    enctype="multipart/form-data"
                    class="p-6 space-y-6">
                    @csrf
                    <input type="hidden" id="course_id" name="course_id" value="{{ $course->id }}">

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Title</label>
                        <input type="text" name="title" id="title" required
                            class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                            placeholder="Enter lesson title">
                        <p class="text-red-500 text-sm mt-1 hidden" id="error_title"></p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Description</label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full mt-2 px-4 py-3 rounded-2xl border focus:ring-4 focus:ring-indigo-100 outline-none"
                            placeholder="Optional description"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Upload File</label>
                        <input type="file" name="file" id="file" required
                            class="w-full mt-2 px-4 py-3 border rounded-2xl bg-white">
                        <p class="text-xs text-slate-400 mt-1">
                            PDF / MP4 supported (AI will process automatically)
                        </p>
                        <p class="text-red-500 text-sm mt-1 hidden" id="error_file"></p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            id="submitBtn"
                            class="px-6 py-2 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                            Create Lesson
                        </button>

                        <button type="button"
                            onclick="document.getElementById('lessonForm').reset()"
                            class="px-6 py-2 rounded-2xl border hover:bg-slate-50">
                            Reset
                        </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('lessonForm');
        const submitBtn = document.getElementById('submitBtn');

        let polling = null;

        // =====================================================
        // SWEETALERT PROGRESS
        // =====================================================
        function showProgress() {

            Swal.fire({
                title: 'AI Processing...',
                html: `
                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden mt-4">
                    <div
                        id="bar"
                        class="h-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"
                        style="width: 0%">
                    </div>
                </div>

                <p
                    id="text"
                    class="mt-3 text-indigo-600 font-bold"
                >
                    Starting...
                </p>
            `,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        }


        // =====================================================
        // UPDATE PROGRESS
        // =====================================================
        function updateProgress(percent, status) {

            const bar = document.getElementById('bar');
            const text = document.getElementById('text');

            if (bar) {
                bar.style.width = `${percent}%`;
            }

            if (!text) return;

            if (status === 'pending' || percent < 20) {

                text.innerText = "Uploading...";

            } else if (percent < 50) {

                text.innerText = "Extracting content...";

            } else if (percent < 80) {

                text.innerText = "AI generating summary...";

            } else {

                text.innerText = "Finalizing...";
            }
        }


        // =====================================================
        // POLL LESSON STATUS
        // =====================================================
        function pollStatus(id) {

            if (polling) {
                clearInterval(polling);
            }

            polling = setInterval(async function() {

                try {

                    const statusUrl =
                        "{{ route('lesson.status', ['id' => '__LESSON_ID__']) }}"
                        .replace('__LESSON_ID__', id);

                    console.log("STATUS URL:", statusUrl);

                    const res = await fetch(statusUrl, {
                        method: "GET",

                        headers: {
                            "Accept": "application/json"
                        },

                        credentials: "same-origin"
                    });


                    const raw = await res.text();

                    console.log("STATUS HTTP:", res.status);
                    console.log("STATUS RESPONSE:", raw);


                    let data;

                    try {

                        data = JSON.parse(raw);

                    } catch (jsonError) {

                        console.error(
                            "STATUS IS NOT JSON:",
                            raw
                        );

                        throw new Error(
                            `Status server returned HTTP ${res.status}`
                        );
                    }


                    if (!res.ok) {

                        throw new Error(
                            data.message ||
                            data.error ||
                            "Unable to check lesson status"
                        );
                    }


                    updateProgress(
                        Number(data.progress ?? 0),
                        data.status
                    );


                    // =========================
                    // COMPLETED
                    // =========================
                    if (data.status === 'completed') {

                        clearInterval(polling);
                        polling = null;

                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: 'AI Summary ready for review'
                        }).then(function() {

                            const courseId =
                                document.getElementById('course_id').value;

                            const previewUrl =
                                `{{ route('lesson.preview', [
                            'id' => '__LESSON_ID__',
                            'course_id' => '__COURSE_ID__'
                        ])
                    }}`
                                .replace('__LESSON_ID__', id)
                                .replace('__COURSE_ID__', courseId);

                            window.location.href = previewUrl;
                        });
                    }


                    // =========================
                    // FAILED
                    // =========================
                    else if (data.status === 'failed') {

                        clearInterval(polling);
                        polling = null;

                        Swal.fire({
                            icon: 'error',
                            title: 'AI Processing Failed',
                            text: data.error ||
                                data.message ||
                                'Processing failed'
                        });

                        submitBtn.disabled = false;
                        submitBtn.innerText = "Create Lesson";
                    }


                } catch (err) {

                    console.error(
                        "STATUS POLLING ERROR:",
                        err
                    );

                    // Don't immediately stop polling
                    // temporary network error can recover

                }

            }, 2000);
        }


        // =====================================================
        // FORM SUBMIT
        // =====================================================
        form.addEventListener('submit', async function(e) {

            e.preventDefault();


            // Prevent double submit
            if (submitBtn.disabled) {
                return;
            }


            submitBtn.disabled = true;
            submitBtn.innerText = "Uploading...";


            const formData = new FormData(form);


            // Laravel generates the correct production URL
            const storeUrl = form.getAttribute('action');

            console.log("POST URL:", storeUrl);

            console.log("=================================");
            console.log("LESSON STORE URL:", storeUrl);
            console.log("METHOD: POST");
            console.log("=================================");


            try {

                const res = await fetch(storeUrl, {

                    method: "POST",

                    headers: {

                        "Accept": "application/json",

                        "X-Requested-With": "XMLHttpRequest",

                        "X-CSRF-TOKEN": document
                            .querySelector('input[name="_token"]')
                            .value
                    },

                    body: formData,

                    credentials: "same-origin"
                });


                // =================================================
                // IMPORTANT
                // NEVER directly call res.json()
                // =================================================

                const raw = await res.text();


                console.log("=================================");
                console.log("LESSON STORE HTTP:", res.status);
                console.log("LESSON STORE RESPONSE:", raw);
                console.log("=================================");


                let data;


                try {

                    data = JSON.parse(raw);

                } catch (jsonError) {

                    console.error(
                        "SERVER DID NOT RETURN JSON:",
                        raw
                    );


                    let message =
                        `Server returned HTTP ${res.status}.`;


                    if (res.status === 419) {

                        message =
                            "Session expired. Please refresh the page and try again.";

                    } else if (res.status === 413) {

                        message =
                            "Uploaded file is too large for the production server.";

                    } else if (res.status === 422) {

                        message =
                            "Validation failed. Please check your lesson information.";

                    } else if (res.status === 500) {

                        message =
                            "Laravel server error occurred. Check production logs.";

                    } else if (res.status === 405) {

                        message =
                            "Invalid HTTP method. Lesson store requires POST.";

                    }


                    throw new Error(message);
                }


                // =================================================
                // HTTP ERROR
                // =================================================
                if (!res.ok) {

                    let message =
                        data.message ||
                        data.error ||
                        "Lesson creation failed";


                    // Laravel validation errors
                    if (res.status === 422 && data.errors) {

                        const errors = Object.values(data.errors)
                            .flat()
                            .join("\n");

                        message = errors;
                    }


                    throw new Error(message);
                }


                // =================================================
                // SUCCESS
                // =================================================
                console.log(
                    "LESSON CREATED SUCCESSFULLY:",
                    data
                );


                if (!data.lesson_id) {

                    throw new Error(
                        "Server returned success but lesson_id is missing."
                    );
                }


                showProgress();

                updateProgress(
                    Number(data.progress ?? 10),
                    data.status ?? 'pending'
                );


                pollStatus(data.lesson_id);


            } catch (err) {

                console.error(
                    "LESSON CREATE ERROR:",
                    err
                );


                Swal.fire({

                    icon: 'error',

                    title: 'Lesson Creation Failed',

                    text: err.message ||
                        'Something went wrong.'
                });


                submitBtn.disabled = false;

                submitBtn.innerText = "Create Lesson";
            }

        });

    });
</script>
@endsection