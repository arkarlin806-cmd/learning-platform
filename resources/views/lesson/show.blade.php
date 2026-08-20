@extends('layout.course_ins')

@section("title","LESSON")
@section("page","All lessons show video and AI summary.")

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- header  -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>
            <h1 class="text-3xl sm:text-xl font-extrabold text-slate-700">
                All Lessons ({{ $course->title }})
            </h1>

            <p class="my-3 text-sm text-slate-600">
                Learn smarter with modern structured lessons & interactive content.
            </p>
        </div>

        @if($isInstructor)

        <a
            href="{{ route('lesson.create', $course->id) }}"
            class="inline-flex items-center justify-center gap-2
                       px-6 py-3
                       bg-white text-indigo-600
                       font-bold rounded-2xl
                       shadow-xl
                       hover:scale-105
                       active:scale-95
                       transition-all duration-300">
            <i class="ri-add-line text-xl"></i>
            Create New Lesson
        </a>

        @endif

    </div>


    <!-- staticts -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

        {{-- Total Lessons --}}
        <div class="bg-white/80 rounded-3xl p-6
                    border border-white
                    shadow-sm
                    hover:-translate-y-1
                    duration-300">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 font-semibold">
                        Total Lessons
                    </p>

                    <h2 class="text-lg md:text-3xl font-black mt-2 text-yellow-600">
                        {{ $totalLessons }}
                    </h2>
                </div>

                <div class="md:w-14 md:h-14 md:rounded-2xl w-10 h-10 rounded-lg
                            bg-gradient-to-r from-yellow-400 to-orange-400
                            flex items-center justify-center text-3xl">

                    <i class="ri-bar-chart-box-ai-line text-white"></i>

                </div>

            </div>

            <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">

                <div
                    class="h-full rounded-full bg-gradient-to-r
                           from-yellow-500 via-orange-500 to-orange-700"
                    style="width: 100%"></div>

            </div>

        </div>


        {{-- Video Lessons --}}
        <div class="bg-white/80 rounded-3xl p-6
                    border border-slate-100
                    shadow-sm
                    hover:-translate-y-1
                    duration-300">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 font-semibold">
                        Video Lessons
                    </p>

                    <h2 class="text-lg md:text-3xl font-black mt-2 text-green-600">
                        {{ $videoLessons ?? $lessons->where('lesson_type','video')->count() }}
                    </h2>

                </div>

                <div class="md:w-14 md:h-14 md:rounded-2xl w-10 h-10 rounded-lg
                            bg-gradient-to-r from-sky-500 to-green-500
                            flex items-center justify-center text-3xl">

                    <i class="ri-video-line text-white"></i>

                </div>

            </div>

            <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">

                @php
                $videoCount = $videoLessons ?? $lessons->where('lesson_type','video')->count();
                $videoPercent = $totalLessons > 0
                ? ($videoCount / $totalLessons) * 100
                : 0;
                @endphp

                <div
                    class="h-full rounded-full bg-gradient-to-r
                           from-sky-500 via-green-500 to-green-700"
                    style="width: {{ min($videoPercent,100) }}%"></div>

            </div>

        </div>


        {{-- PDF Lessons --}}
        <div class="bg-white/80 rounded-3xl p-6
                    border border-white
                    shadow-sm
                    hover:-translate-y-1
                    duration-300">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 font-semibold">
                        PDF Lessons
                    </p>

                    <h2 class="text-lg md:text-3xl font-black mt-2 text-red-600">
                        {{ $pdfLessons ?? $lessons->where('lesson_type','pdf')->count() }}
                    </h2>

                </div>

                <div class="md:w-14 md:h-14 md:rounded-2xl w-10 h-10 rounded-lg
                            bg-gradient-to-r from-pink-500 to-red-500
                            flex items-center justify-center text-3xl">

                    <i class="ri-file-pdf-2-line text-white"></i>

                </div>

            </div>

            <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">

                @php
                $pdfCount = $pdfLessons ?? $lessons->where('lesson_type','pdf')->count();
                $pdfPercent = $totalLessons > 0
                ? ($pdfCount / $totalLessons) * 100
                : 0;
                @endphp

                <div
                    class="h-full rounded-full bg-gradient-to-r
                           from-pink-500 via-red-500 to-red-700"
                    style="width: {{ min($pdfPercent,100) }}%"></div>

            </div>

        </div>

    </div>


    <!-- lesson list  -->
    <div class="mt-10">

        @if($lessons->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

            @foreach($lessons as $lesson)

            {{-- =================================================
                        HIDDEN LESSON DATA
                    ================================================== --}}
            @php
            $keyPoints = collect($lesson->summary ?? [])
            ->flatMap(function ($summary) {
            return is_array($summary->key_points ?? null)
            ? $summary->key_points
            : [];
            })
            ->filter(fn($point) => filled($point))
            ->values()
            ->all();
            @endphp

            <div
                id="lesson-{{ $lesson->id }}"
                class="hidden"
                data-title="{{ $lesson->title }}"
                data-description="{{ $lesson->description }}"
                data-duration="{{ $lesson->duration ?? '' }}"
                data-update="{{ route('lesson.update', $lesson->id) }}"
                data-points='@json($keyPoints)'>
            </div>


            {{-- =================================================
                        LESSON CARD
                    ================================================== --}}
            <article class="relative">

                <div
                    class="relative
                                   bg-white/90
                                   backdrop-blur-xl
                                   rounded-3xl
                                   shadow-lg
                                   border border-white
                                   overflow-visible
                                   transition-all duration-300
                                   hover:-translate-y-1
                                   hover:shadow-2xl">

                    <!-- top section  -->
                    <div class="flex items-start justify-between gap-4 p-5">

                        <div class="min-w-0">

                            <div class="flex items-center gap-2 mb-2">

                                @if($lesson->lesson_type === 'video')

                                <span
                                    class="inline-flex items-center gap-1
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-green-50
                                                       text-green-600
                                                       text-xs font-bold">
                                    <i class="ri-video-line"></i>
                                    VIDEO
                                </span>

                                @elseif($lesson->lesson_type === 'pdf')

                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold">
                                    <i class="ri-file-pdf-2-line"></i>
                                    PDF
                                </span>

                                @endif

                            </div>

                            <h2
                                class="text-md md:text-xl font-bold  text-slate-800 break-words">
                                {{ $lesson->title }}
                            </h2>

                        </div>


                        <!-- instructor action -->
                        @if($isInstructor)

                        <div class="flex items-center gap-3 flex-shrink-0">

                            {{-- Edit --}}
                            <div class="relative inline-block group">

                                <button
                                    type="button"
                                    onclick="openEditModal('{{ $lesson->id }}')"
                                    class="w-9 h-9 rounded-xl
                                                       flex items-center justify-center
                                                       bg-yellow-50
                                                       text-yellow-600
                                                       hover:bg-yellow-100
                                                       transition">
                                    <i class="ri-edit-2-line text-lg"></i>
                                </button>

                                <div
                                    class="absolute
                                                       bottom-full
                                                       right-0
                                                       mb-2
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-slate-800
                                                       text-white
                                                       text-xs font-semibold
                                                       whitespace-nowrap
                                                       shadow-xl
                                                       z-50
                                                       opacity-0
                                                       invisible
                                                       translate-y-2
                                                       group-hover:opacity-100
                                                       group-hover:visible
                                                       group-hover:translate-y-0
                                                       transition-all duration-200">
                                    Edit
                                </div>

                            </div>


                            {{-- Delete --}}
                            <div class="relative inline-block group">

                                <button
                                    type="button"
                                    onclick="deleteLesson('{{ $lesson->id }}')"
                                    class="w-9 h-9 rounded-xl
                                                       flex items-center justify-center
                                                       bg-red-50
                                                       text-red-500
                                                       hover:bg-red-100
                                                       transition">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>

                                <div
                                    class="absolute
                                                       bottom-full
                                                       right-0
                                                       mb-2
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-slate-800
                                                       text-white
                                                       text-xs font-semibold
                                                       whitespace-nowrap
                                                       shadow-xl
                                                       z-50
                                                       opacity-0
                                                       invisible
                                                       translate-y-2
                                                       group-hover:opacity-100
                                                       group-hover:visible
                                                       group-hover:translate-y-0
                                                       transition-all duration-200">
                                    Delete
                                </div>

                            </div>

                        </div>

                        @endif

                    </div>


                    <!-- media -->
                    <div class="px-0">

                        @if($lesson->lesson_type === 'video')

                        @if(!empty($lesson->video_url))

                        <video
                            controls
                            preload="metadata"
                            playsinline
                            class="w-full h-40 md:h-52 lesson-video object-cover bg-black"
                            data-lesson-id="{{ $lesson->id }}">
                            <source
                                src="{{ $lesson->video_url }}"
                                type="video/mp4">

                            Your browser does not support
                            the video tag.

                        </video>

                        @else

                        <div
                            class="h-52 w-full bg-gradient-to-br from-red-50 to-orange-50 flex flex-col items-center justify-center">
                            <i
                                class="ri-video-off-line text-5xl text-red-400"></i>
                            <p
                                class="mt-3 text-sm text-red-500 font-semibold">
                                Video unavailable
                            </p>
                            <p
                                class="text-xs text-slate-400 mt-1">
                                File could not be loaded from B2
                            </p>
                        </div>
                        @endif
                        @elseif($lesson->lesson_type === 'pdf')
                        <div
                            class="h-52 w-full
                                               bg-gradient-to-br
                                               from-indigo-50
                                               to-sky-100
                                               flex flex-col
                                               items-center
                                               justify-center">

                            <i
                                class="ri-file-pdf-2-line
                                                   text-6xl
                                                   text-red-500"></i>

                            <p
                                class="mt-3
                                                   text-sm
                                                   font-bold
                                                   text-slate-600">
                                PDF Lesson
                            </p>

                        </div>

                        @else

                        <div
                            class="h-52 w-full
                                               bg-gradient-to-br
                                               from-indigo-50
                                               to-sky-100
                                               flex items-center
                                               justify-center">

                            <i
                                class="ri-file-line
                                                   text-6xl
                                                   text-indigo-400"></i>

                        </div>

                        @endif

                    </div>


                    {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}
                    <div class="px-5 pt-4">

                        <p
                            class="text-gray-500
                                           leading-relaxed
                                           text-sm
                                           line-clamp-3">
                            {{ $lesson->description }}
                        </p>

                    </div>


                    {{-- =================================================
                                AI SUMMARY / KEY HIGHLIGHTS
                            ================================================== --}}
                    <div class="relative px-5 py-5">

                        <button
                            type="button"
                            onclick="openKeyPointModal('{{ $lesson->id }}')"
                            class="flex items-center gap-2
                                           text-indigo-700
                                           font-semibold
                                           text-sm
                                           hover:text-indigo-900
                                           transition">

                            <span
                                class="w-8 h-8
                                               rounded-xl
                                               bg-indigo-50
                                               flex items-center justify-center">
                                <i class="ri-sparkling-2-line"></i>
                            </span>

                            <span>
                                AI Key Highlights
                            </span>

                            <span
                                id="icon-{{ $lesson->id }}"
                                class="transition-transform duration-300">
                                ▾
                            </span>

                        </button>



                    </div>

                </div>

            </article>

            @endforeach
            {{-- =========================================================
    CENTER KEY POINT MODAL
========================================================= --}}

            <div
                id="keyPointModal"
                class="fixed inset-0 z-[99999] hidden
           items-center justify-center
           bg-black/50 backdrop-blur-sm
           px-4 py-6">

                <div
                    id="keyPointModalContent"
                    class="w-full max-w-2xl
               max-h-[85vh]
               bg-white
               rounded-3xl
               shadow-2xl
               overflow-hidden
               opacity-0
               scale-95
               translate-y-5
               transition-all duration-300">

                    {{-- Header --}}
                    <div
                        class="flex items-center justify-between
                   px-6 py-5
                   border-b border-slate-100">

                        <div>
                            <h2
                                id="keyPointModalTitle"
                                class="text-xl font-black text-slate-800">
                                Key Points
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                AI generated lesson highlights
                            </p>
                        </div>

                        <button
                            type="button"
                            onclick="closeKeyPointModal()"
                            class="w-10 h-10
                       rounded-xl
                       bg-slate-100
                       hover:bg-slate-200
                       flex items-center justify-center">

                            <i class="ri-close-line text-xl"></i>

                        </button>

                    </div>


                    {{-- Body --}}
                    <div
                        id="keyPointModalBody"
                        class="p-6
                   overflow-y-auto
                   max-h-[65vh]">

                    </div>

                </div>

            </div>


        </div>



        <div class="mt-10">

            {{ $lessons->withQueryString()->links() }}

        </div>


        @else


        <!-- EMPTY STATE -->

        <div
            class="bg-white/80
                       rounded-3xl
                       border border-slate-100
                       shadow-sm
                       py-16
                       px-6
                       text-center">

            <div
                class="w-20 h-20
                           mx-auto
                           rounded-3xl
                           bg-indigo-50
                           flex items-center justify-center">

                <i
                    class="ri-book-open-line
                               text-4xl
                               text-indigo-500"></i>

            </div>

            <h3
                class="mt-5
                           text-xl
                           font-bold
                           text-slate-700">
                No lessons found
            </h3>

            <p
                class="mt-2
                           text-sm
                           text-slate-500">
                There are no lessons available for this course yet.
            </p>

            @if($isInstructor)

            <a
                href="{{ route('lesson.create', $course->id) }}"
                class="inline-flex
                               items-center
                               gap-2
                               mt-6
                               px-6 py-3
                               rounded-2xl
                               bg-indigo-600
                               text-white
                               font-bold
                               hover:bg-indigo-700
                               transition">
                <i class="ri-add-line"></i>
                Create First Lesson
            </a>

            @endif

        </div>

        @endif

    </div>

</div>


<!-- EDIT MODAL -->
@if($isInstructor)

<div
    id="editModal"
    class="fixed inset-0
           z-[100]
           hidden
           overflow-y-auto
           items-center
           justify-center
           bg-black/40
           backdrop-blur-md
           px-4
           py-8">

    <div
        id="modalContent"
        class="w-full
               max-w-2xl
               bg-white
               rounded-3xl
               shadow-2xl
               opacity-0
               scale-90
               translate-y-10
               transition-all duration-500">

        {{-- Header --}}
        <div
            class="flex
                   justify-between
                   items-center
                   p-6
                   border-b">

            <div>

                <h2
                    class="text-2xl
                           font-black
                           text-slate-800">
                    Edit Lesson
                </h2>

                <p
                    class="text-gray-500
                           text-sm
                           mt-1">
                    Update your lesson information
                </p>

            </div>


            <button
                type="button"
                onclick="closeEditModal()"
                class="w-10 h-10
                       rounded-xl
                       bg-slate-100
                       hover:bg-slate-200
                       flex items-center justify-center
                       transition">

                <i class="ri-close-line text-2xl"></i>

            </button>

        </div>


        {{-- Body --}}
        <div class="p-6 space-y-5">

            <input
                type="hidden"
                id="edit_id">


            {{-- Title --}}
            <div>

                <label
                    class="font-semibold
                           text-slate-700">
                    Title
                </label>

                <input
                    id="edit_title"
                    type="text"
                    class="w-full
                           mt-2
                           p-3
                           rounded-xl
                           border border-slate-200
                           focus:ring-2
                           focus:ring-indigo-500
                           outline-none">

            </div>


            {{-- Description --}}
            <div>

                <label
                    class="font-semibold
                           text-slate-700">
                    Description
                </label>

                <textarea
                    id="edit_description"
                    rows="4"
                    class="w-full
                           mt-2
                           p-3
                           rounded-xl
                           border border-slate-200
                           focus:ring-2
                           focus:ring-indigo-500
                           outline-none"></textarea>

            </div>


            {{-- Duration --}}
            <div>

                <label
                    class="font-semibold
                           text-slate-700">
                    Duration
                </label>

                <input
                    id="edit_duration"
                    type="text"
                    class="w-full
                           mt-2
                           p-3
                           rounded-xl
                           border border-slate-200
                           focus:ring-2
                           focus:ring-indigo-500
                           outline-none">

            </div>


            {{-- Key Points --}}
            <div>

                <div
                    class="flex
                           items-center
                           justify-between">

                    <label
                        class="font-semibold
                               text-slate-700">
                        Key Points
                    </label>

                    <button
                        type="button"
                        onclick="addPoint()"
                        class="px-3 py-2
                               rounded-xl
                               bg-blue-100
                               text-blue-600
                               font-semibold
                               hover:bg-blue-200
                               transition">
                        + Add
                    </button>

                </div>


                <div
                    id="keyPointsContainer"
                    class="space-y-2
                           mt-3"></div>

            </div>

        </div>


        {{-- Footer --}}
        <div
            class="flex
                   flex-col-reverse
                   sm:flex-row
                   justify-end
                   gap-3
                   p-6
                   border-t">

            <button
                type="button"
                onclick="closeEditModal()"
                class="px-5 py-3
                       rounded-xl
                       bg-gray-100
                       text-gray-700
                       font-semibold
                       hover:bg-gray-200
                       transition">
                Cancel
            </button>


            <button
                type="button"
                onclick="updateLesson()"
                class="px-6 py-3
                       rounded-xl
                       bg-blue-600
                       text-white
                       font-semibold
                       hover:bg-blue-700
                       transition">
                <i class="ri-save-line mr-1"></i>
                Update
            </button>

        </div>

    </div>

</div>

@endif



<!-- JAVASCRIPT -->
<script>
    function openKeyPointModal(id) {

        console.log('Opening key points for lesson:', id);

        const lesson =
            document.getElementById('lesson-' + id);

        if (!lesson) {

            console.error(
                'Lesson data not found:',
                'lesson-' + id
            );

            return;
        }


        const modal =
            document.getElementById('keyPointModal');

        const content =
            document.getElementById('keyPointModalContent');

        const body =
            document.getElementById('keyPointModalBody');

        const title =
            document.getElementById('keyPointModalTitle');


        if (!modal || !content || !body || !title) {

            console.error(
                'Key Point modal elements not found.'
            );

            return;
        }


        // =========================
        // GET KEY POINTS
        // =========================

        let points = [];

        try {

            points = JSON.parse(
                lesson.dataset.points || '[]'
            );

        } catch (error) {

            console.error(
                'Invalid key points JSON:',
                error
            );

            points = [];
        }


        console.log(
            'Lesson:',
            id,
            'Key Points:',
            points
        );


        // =========================
        // TITLE
        // =========================

        title.textContent =
            lesson.dataset.title ||
            'Key Points';


        // =========================
        // CONTENT
        // =========================

        if (!Array.isArray(points) || points.length === 0) {

            body.innerHTML = `

        <div class="py-12 text-center">

            <div
                class="w-16 h-16
                       mx-auto
                       rounded-2xl
                       bg-slate-100
                       flex items-center justify-center">

                <i
                    class="ri-sparkling-line
                           text-3xl
                           text-slate-400">
                </i>

            </div>

            <p
                class="mt-4
                       text-sm
                       font-semibold
                       text-slate-500">

                No key points available.

            </p>

        </div>

    `;

        } else {

            body.innerHTML = points.map(
                (point, index) => `

            <div
                class="flex items-start gap-3
                       p-4 mb-3
                       rounded-2xl
                       bg-gradient-to-r
                       from-indigo-50
                       to-sky-50
                       border border-indigo-100">

                <div
                    class="w-8 h-8
                           flex-shrink-0
                           rounded-full
                           bg-indigo-600
                           text-white
                           text-sm
                           font-bold
                           flex items-center justify-center">

                    ${index + 1}

                </div>

                <p
                    class="text-sm
                           leading-6
                           text-slate-700">

                    ${escapeHtml(point)}

                </p>

            </div>

        `
            ).join('');
        }


        // =========================
        // OPEN MODAL
        // =========================

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add(
            'overflow-hidden'
        );


        // Animation
        requestAnimationFrame(() => {

            content.classList.remove(
                'opacity-0',
                'scale-95',
                'translate-y-5'
            );

            content.classList.add(
                'opacity-100',
                'scale-100',
                'translate-y-0'
            );

        });

    }


    function closeKeyPointModal() {

        const modal =
            document.getElementById(
                'keyPointModal'
            );

        const content =
            document.getElementById(
                'keyPointModalContent'
            );


        if (!modal || !content) {
            return;
        }


        content.classList.remove(
            'opacity-100',
            'scale-100',
            'translate-y-0'
        );

        content.classList.add(
            'opacity-0',
            'scale-95',
            'translate-y-5'
        );


        setTimeout(() => {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 300);

    }


    // Close when clicking backdrop
    document.addEventListener(
        'click',
        function(event) {

            const modal =
                document.getElementById(
                    'keyPointModal'
                );

            if (
                modal &&
                event.target === modal
            ) {

                closeKeyPointModal();

            }

        }
    );


    // Close with ESC
    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                const modal =
                    document.getElementById(
                        'keyPointModal'
                    );

                if (
                    modal &&
                    !modal.classList.contains('hidden')
                ) {

                    closeKeyPointModal();

                }

            }

        }
    );

    /* ============================================================
       DELETE LESSON
    ============================================================ */

    function deleteLesson(id) {

        Swal.fire({

            title: "Are you sure?",

            text: "This lesson will be permanently deleted!",

            icon: "warning",

            showCancelButton: true,

            confirmButtonColor: "#dc2626",

            cancelButtonColor: "#6b7280",

            confirmButtonText: "Yes, Delete",

            cancelButtonText: "Cancel"

        }).then((result) => {

            if (!result.isConfirmed) {
                return;
            }


            fetch(
                    `{{ route('lesson.destroy', ':id') }}`
                    .replace(':id', id), {
                        method: "DELETE",

                        headers: {

                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            "Accept": "application/json"

                        }
                    }
                )

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        Swal.fire({

                            title: "Deleted!",

                            text: data.message,

                            icon: "success",

                            timer: 1500,

                            showConfirmButton: false

                        }).then(() => {

                            location.reload();

                        });

                    } else {

                        Swal.fire(
                            "Error!",
                            data.message ||
                            "Unable to delete lesson.",
                            "error"
                        );

                    }

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire(
                        "Error!",
                        "Something went wrong!",
                        "error"
                    );

                });

        });

    }



    /* ============================================================
       OPEN EDIT MODAL
    ============================================================ */

    function openEditModal(id) {

        const lesson =
            document.getElementById(
                'lesson-' + id
            );


        if (!lesson) {

            Swal.fire(
                "Error",
                "Lesson data not found.",
                "error"
            );

            return;
        }


        document.getElementById(
            'edit_id'
        ).value = id;


        document.getElementById(
                'edit_title'
            ).value =
            lesson.dataset.title || '';


        document.getElementById(
                'edit_description'
            ).value =
            lesson.dataset.description || '';


        document.getElementById(
                'edit_duration'
            ).value =
            lesson.dataset.duration || '';


        let points = [];

        try {

            points =
                JSON.parse(
                    lesson.dataset.points || '[]'
                );

        } catch (error) {

            console.error(
                "Invalid key points JSON",
                error
            );

            points = [];

        }


        const container =
            document.getElementById(
                'keyPointsContainer'
            );


        container.innerHTML = "";


        if (points.length === 0) {

            addPoint();

        } else {

            points.forEach(point => {

                addPoint(point);

            });

        }


        const modal =
            document.getElementById(
                'editModal'
            );


        const content =
            document.getElementById(
                'modalContent'
            );


        modal.classList.remove('hidden');

        modal.classList.add('flex');


        document.body.classList.add(
            'overflow-hidden'
        );


        setTimeout(() => {

            content.classList.remove(
                'opacity-0',
                'scale-90',
                'translate-y-10'
            );

            content.classList.add(
                'opacity-100',
                'scale-100',
                'translate-y-0'
            );

        }, 50);

    }



    /* ============================================================
       CLOSE EDIT MODAL
    ============================================================ */

    function closeEditModal() {

        const content =
            document.getElementById(
                'modalContent'
            );


        if (!content) {
            return;
        }


        content.classList.add(
            'opacity-0',
            'scale-90',
            'translate-y-10'
        );


        content.classList.remove(
            'opacity-100',
            'scale-100',
            'translate-y-0'
        );


        setTimeout(() => {

            const modal =
                document.getElementById(
                    'editModal'
                );


            modal.classList.add('hidden');

            modal.classList.remove('flex');


            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 400);

    }



    /* ============================================================
       ADD KEY POINT
    ============================================================ */

    function addPoint(value = '') {

        const container =
            document.getElementById(
                'keyPointsContainer'
            );


        if (!container) {
            return;
        }


        const wrapper =
            document.createElement('div');


        wrapper.className =
            'flex gap-2 items-center';


        wrapper.innerHTML = `

            <input
                type="text"
                name="points[]"
                value="${escapeHtml(value)}"
                placeholder="Enter key point..."
                class="flex-1
                       p-3
                       rounded-xl
                       border border-slate-200
                       focus:ring-2
                       focus:ring-indigo-500
                       outline-none"
            >

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="w-11
                       h-11
                       flex-shrink-0
                       bg-red-100
                       text-red-600
                       rounded-xl
                       hover:bg-red-200
                       transition"
            >
                <i class="ri-delete-bin-line"></i>
            </button>

        `;


        container.appendChild(wrapper);

    }



    /* ============================================================
       ESCAPE HTML
    ============================================================ */

    function escapeHtml(value) {

        if (value === null || value === undefined) {
            return '';
        }


        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }



    /* ============================================================
       UPDATE LESSON
    ============================================================ */

    async function updateLesson() {

        const id =
            document.getElementById(
                'edit_id'
            ).value;


        const title =
            document.getElementById(
                'edit_title'
            ).value.trim();


        const description =
            document.getElementById(
                'edit_description'
            ).value.trim();


        const duration =
            document.getElementById(
                'edit_duration'
            ).value.trim();


        if (!title) {

            Swal.fire(
                "Validation Error",
                "Lesson title is required.",
                "warning"
            );

            return;
        }


        const formData =
            new FormData();


        formData.append(
            'title',
            title
        );


        formData.append(
            'description',
            description
        );


        formData.append(
            'duration',
            duration
        );


        document
            .querySelectorAll(
                '#keyPointsContainer input[name="points[]"]'
            )
            .forEach(input => {

                if (input.value.trim()) {

                    formData.append(
                        'points[]',
                        input.value.trim()
                    );

                }

            });


        try {

            Swal.fire({

                title: 'Updating...',

                text: 'Please wait.',

                allowOutsideClick: false,

                didOpen: () => {

                    Swal.showLoading();

                }

            });


            const response =
                await fetch(
                    `{{ route('lesson.update', ':id') }}`
                    .replace(':id', id), {

                        method: "POST",

                        headers: {

                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            "X-HTTP-Method-Override": "PUT",

                            "Accept": "application/json"

                        },

                        body: formData

                    }
                );


            const data =
                await response.json();


            Swal.close();


            if (response.ok && data.success) {

                Swal.fire({

                    icon: "success",

                    title: "Updated!",

                    text: data.message ||
                        "Lesson updated successfully.",

                    timer: 1500,

                    showConfirmButton: false

                }).then(() => {

                    location.reload();

                });

            } else {

                Swal.fire(

                    "Error",

                    data.message ||
                    "Unable to update lesson.",

                    "error"

                );

            }

        } catch (error) {

            console.error(error);


            Swal.close();


            Swal.fire(
                "Error",
                "Something went wrong!",
                "error"
            );

        }

    }



    /* ============================================================
       CLOSE MODAL WHEN CLICK OUTSIDE
    ============================================================ */

    document.addEventListener(
        'click',
        function(event) {

            const modal =
                document.getElementById(
                    'editModal'
                );


            if (
                modal &&
                event.target === modal
            ) {

                closeEditModal();

            }

        }
    );

    //lesson progress store
    document.addEventListener('DOMContentLoaded', function() {

        const USER_ID = `@json(auth()->id() ?? 'guest')`;

        const STORAGE_KEY = `lesson_video_progress_user_${USER_ID}`;

        function getProgress() {
            return JSON.parse(
                localStorage.getItem(STORAGE_KEY) || '{}'
            );
        }

        function saveProgress(data) {
            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(data)
            );
        }


        document.querySelectorAll('.lesson-video').forEach(video => {

            const lessonId = video.dataset.lessonId;

            if (!lessonId) return;


            // =========================
            // LOAD PREVIOUS POSITION
            // =========================

            video.addEventListener('loadedmetadata', function() {

                const progress = getProgress();
                const saved = progress[lessonId];

                if (!saved) return;

                if (
                    saved.currentTime > 0 &&
                    saved.currentTime < video.duration
                ) {

                    video.currentTime =
                        saved.currentTime;

                }

            }, {
                once: true
            });


            // =========================
            // SAVE POSITION
            // =========================

            video.addEventListener('timeupdate', function() {

                if (!video.duration) return;

                const progress = getProgress();

                progress[lessonId] = {

                    currentTime: video.currentTime,

                    duration: video.duration,

                    percent: Math.floor(
                        (video.currentTime /
                            video.duration) * 100
                    )

                };

                saveProgress(progress);

            });


            // Save immediately when pause
            video.addEventListener('pause', function() {

                const progress = getProgress();

                progress[lessonId] = {

                    currentTime: video.currentTime,

                    duration: video.duration,

                    percent: video.duration ?
                        Math.floor(
                            (video.currentTime /
                                video.duration) * 100
                        ) : 0

                };

                saveProgress(progress);

            });

        });

    });
</script>

@endsection