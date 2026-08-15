@extends('layout.course_ins')
@section("title","LESSON")

@section('content')
<div class="flex items-center justify-between">

    <div>
        <h1 class="text-4xl font-extrabold text-slate-700">
            All lessons ( {{ $course->title }} )
        </h1>
        <p class="my-3 text-sm text-slate-600">
            Learn smarter with modern structured lessons & interactive content.
        </p>

    </div>

    <!-- Profile -->
    <div class="flex items-center gap-4">
        @if($isInstructor)
        <a href="{{ route('lesson.create', $course->id) }}"
            class="inline-flex items-center gap-2 mt-4 px-6 py-3
                          bg-white text-indigo-600 font-bold rounded-2xl
                          shadow-xl hover:scale-105 active:scale-95
                          transition-all duration-300">
            + Create New Lesson
        </a>
        @endif
    </div>
</div>

<div class="grid  grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    <div class="bg-white/80 rounded-3xl p-6 border border-white hover:-translate-y-2 duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 font-semibold">
                    Total Lessons
                </p>
                <h2 class="text-3xl font-black mt-2  text-yellow-600">
                    20
                </h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-yellow-400 to-orange-400 flex items-center justify-center  text-3xl">
                <i class="ri-bar-chart-box-ai-line text-white"></i>
            </div>
        </div>
        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">
            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-yellow-500 via-orange-500 to-orange-700">
            </div>
        </div>
    </div>
    <div class="bg-white/80 rounded-3xl p-6 border border-slate-100 hover:-translate-y-2 duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 font-semibold">
                    Video Lessons
                </p>
                <h2 class="text-3xl font-black mt-2  text-green-600">
                    10
                </h2>
            </div>
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-sky-500 to-green-500 flex items-center justify-center  text-3xl">
                👨‍🎓
            </div>
        </div>
        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">
            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-sky-500 via-green-500 to-green-700">
            </div>

        </div>
    </div>
    <div class="bg-white/80 rounded-3xl p-6 border border-white hover:-translate-y-2 duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 font-semibold">
                    PDF Lessons
                </p>
                <h2 class="text-3xl font-black mt-2  text-red-600">
                    10
                </h2>
            </div>
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-pink-500 to-red-500 flex items-center justify-center  text-3xl">
                👨‍🎓
            </div>
        </div>
        <!-- Progress -->
        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white">

            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-pink-500 via-red-500 to-red-700">
            </div>

        </div>
    </div>

</div>

<div class="mt-8 space-y-1 grid md:grid-cols-3 gap-14 sm:grid-cols-1">

    @foreach($lessons as $lesson)

    <!-- hidden data -->
    <div id="lesson-{{ $lesson->id }}"
        class="hidden"
        data-title="{{ $lesson->title }}"
        data-description="{{ $lesson->description }}"
        data-update="{{ route('lesson.update',$lesson->id) }}"
        data-points='@json($lesson->summary->flatMap(fn($s)=>$s->key_points ?? []))'>
    </div>

    <!-- MAIN CARD -->
    <article class=" relative space-y-2">

        <!-- card -->
        <div class="relative bg-white/80 rounded-2xl shadow-lg transition-all duration-300 ">

            <!-- TOP -->
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-5 pt-4 mx-6">

                <div class="space-y-2">
                    <h2 class="text-xl font-bold text-slate-800 transition">
                        {{ $lesson->title }}
                    </h2>
                </div>

                <!-- actions -->
                @if($isInstructor)
                <div class="flex gap-4">
                    <div class="relative inline-block group">
                        <button onclick="openEditModal('{{ $lesson->id }}')">
                            <i class="ri-edit-2-line text-xl cursor-pointer text-yellow-600"></i>
                        </button>
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3
                                px-3 py-2 rounded-lg bg-yellow-100/50 border border-yellow-200 text-yellow-700 text-sm font-semibold whitespace-nowrap
                                shadow-xl z-50

                                opacity-0 invisible
                                translate-y-2 scale-95

                                group-hover:opacity-100
                                group-hover:visible
                                group-hover:translate-y-0
                                group-hover:scale-100

                                transition-all duration-500 ease-out">
                            Edit
                            <!-- Arrow -->
                            <div class="absolute top-full left-1/2 -translate-x-1/2
                                border-4 border-transparent border-t-gray-900"></div>
                        </div>
                    </div>
                    <div class="relative inline-block group">

                        <a href="javascript:void(0)"
                            onclick="deleteLesson('{{ $lesson->id }}')">

                            <i class="ri-delete-bin-line text-xl cursor-pointer text-red-500"></i>

                        </a>


                        <!-- Tooltip -->
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3
                            px-3 py-2 rounded-lg bg-red-100/50 border border-red-200 
                            text-red-700 text-sm font-semibold whitespace-nowrap
                            shadow-xl z-50

                            opacity-0 invisible
                            translate-y-2 scale-95

                            group-hover:opacity-100
                            group-hover:visible
                            group-hover:translate-y-0
                            group-hover:scale-100

                            transition-all duration-500 ease-out">

                            Delete

                        </div>

                    </div>

                </div>
                @endif
            </div>
            <!-- MEDIA -->
            <div class="mt-3">
                @if($lesson->lesson_type == 'video')
                <video controls
                    class="w-full h-40">
                    <source src="{{ asset('storage/'.$lesson->file_path) }}">
                </video>
                @else
                <div class="h-40 rounded-2xl w-full
                                    bg-gradient-to-br from-indigo-50 to-sky-100
                                    flex items-center justify-center text-5xl">
                    📄
                </div>
                @endif

            </div>
            <p class="text-gray-500 leading-relaxed max-w-2xl mt-1 mx-6">
                {{ $lesson->description }}
            </p>
            <div class="relative pb-4 pl-4">

                <button onclick="togglePoints('{{ $lesson->id }}')"
                    class="flex items-center gap-2 text-blue-800 font-semibold">
                    Key Highlights

                    <span id="icon-{{ $lesson->id }}"
                        class="transition-transform duration-300">
                        ▾
                    </span>
                </button>


                <!-- Floating Key Points -->
                <div id="points-{{ $lesson->id }}"
                    class="absolute 
           left-0 sm:right-0
           top-full mt-3
           max-w-100
           max-h-0
           overflow-hidden
           opacity-0
           bg-white/90
           backdrop-blur-xl
           rounded-2xl
           shadow-2xl
           border border-indigo-100
           z-[9999]
           transition-all duration-500 ease-in-out">


                    <div class="p-4 flex flex-wrap gap-2">

                        @foreach($lesson->summary_pre as $point)

                        @foreach($point->key_points ?? [] as $p)

                        <div class="flex items-center gap-2
                        px-3 py-2
                        rounded-full
                        bg-gradient-to-r from-indigo-50 to-sky-50
                        border border-indigo-100
                        break-words">

                            <span class="text-green-500">✓</span>

                            <span class="text-sm text-gray-700">
                                {{ $p }}
                            </span>

                        </div>

                        @endforeach

                        @endforeach

                    </div>

                </div>

            </div>


        </div>
    </article>

    @endforeach

</div>

<div id="editModal"
    class="fixed inset-0 z-[100] hidden overflow-y-auto
            items-center justify-center
            bg-black/40 backdrop-blur-md px-4">


    <div id="modalContent"
        class="w-full max-w-2xl
                bg-white rounded-3xl shadow-2xl

                opacity-0
                scale-90
                translate-y-10

                transition-all duration-500">


        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">

            <div>
                <h2 class="text-2xl font-black">
                    Edit Lesson
                </h2>

                <p class="text-gray-500 text-sm">
                    Update your lesson information
                </p>
            </div>


            <button onclick="closeEditModal()">
                <i class="ri-close-line text-2xl"></i>
            </button>

        </div>



        <!-- Body -->
        <div class="p-6 space-y-4">


            <input type="hidden" id="edit_id">


            <div>
                <label class="font-semibold">
                    Title
                </label>

                <input id="edit_title"
                    class="w-full mt-2 p-3 rounded-xl border">
            </div>



            <div>
                <label class="font-semibold">
                    Description
                </label>

                <textarea id="edit_description"
                    rows="4"
                    class="w-full mt-2 p-3 rounded-xl border">
                </textarea>
            </div>



            <div>
                <label class="font-semibold">
                    Duration
                </label>

                <input id="edit_duration"
                    class="w-full mt-2 p-3 rounded-xl border">
            </div>



            <div>

                <div class="flex justify-between">

                    <label class="font-semibold">
                        Key Points
                    </label>


                    <button onclick="addPoint()"
                        class="px-3 py-2 rounded-xl bg-blue-100 text-blue-600">

                        + Add

                    </button>

                </div>


                <div id="keyPointsContainer"
                    class="space-y-2 mt-3">

                </div>


            </div>


        </div>



        <!-- Footer -->
        <div class="flex justify-end gap-3 p-6 border-t">


            <button onclick="closeEditModal()"
                class="px-5 py-3 rounded-xl bg-gray-100">

                Cancel

            </button>


            <button onclick="updateLesson()"
                class="px-6 py-3 rounded-xl
                           bg-blue-600 text-white">

                Update

            </button>


        </div>


    </div>

</div>


<script>
    let activePoint = null;

    function togglePoints(id) {

        const box = document.getElementById('points-' + id);
        const icon = document.getElementById('icon-' + id);


        // Close previous opened box
        if (activePoint && activePoint !== id) {

            const oldBox = document.getElementById('points-' + activePoint);
            const oldIcon = document.getElementById('icon-' + activePoint);

            if (oldBox) {
                oldBox.style.maxHeight = "0px";
                oldBox.style.opacity = "0";
            }

            if (oldIcon) {
                oldIcon.style.transform = "rotate(0deg)";
            }
        }


        // Toggle current box
        if (box.style.maxHeight && box.style.maxHeight !== "0px") {

            box.style.maxHeight = "0px";
            box.style.opacity = "0";

            icon.style.transform = "rotate(0deg)";

            activePoint = null;

        } else {

            box.style.maxHeight = box.scrollHeight + "px";
            box.style.opacity = "1";

            icon.style.transform = "rotate(180deg)";

            activePoint = id;
        }
    }

    function deleteLesson(id) {

        Swal.fire({

            title: "Are you sure?",
            text: "This lesson will be permanently deleted!",
            icon: "warning",

            showCancelButton: true,

            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",

            confirmButtonText: "Yes, Delete"

        }).then((result) => {


            if (result.isConfirmed) {

                fetch(`{{ route('lesson.destroy',':id') }}`.replace(':id', id), {

                        method: "DELETE",

                        headers: {

                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            "Accept": "application/json"

                        }

                    })


                    .then(response => response.json())


                    .then(data => {


                        if (data.success) {

                            Swal.fire({

                                    title: "Deleted!",
                                    text: data.message,
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false

                                })
                                .then(() => {

                                    location.reload();

                                });


                        } else {

                            Swal.fire(
                                "Error!",
                                data.message,
                                "error"
                            );

                        }


                    })


                    .catch(error => {


                        Swal.fire(
                            "Error!",
                            "Something went wrong!",
                            "error"
                        );


                    });


            }


        });


    }

    function openEditModal(id) {

        let lesson =
            document.getElementById(
                'lesson-' + id
            );


        document.getElementById('edit_id').value = id;


        document.getElementById('edit_title').value =
            lesson.dataset.title;


        document.getElementById('edit_description').value =
            lesson.dataset.description;


        document.getElementById('edit_duration').value =
            lesson.dataset.duration;



        let points =
            JSON.parse(
                lesson.dataset.points ?? '[]'
            );


        let container =
            document.getElementById(
                'keyPointsContainer'
            );


        container.innerHTML = "";


        points.forEach(point => {

            container.innerHTML += `

        <div class="flex gap-2">

            <input name="points[]"
                   value="${point}"
                   class="flex-1 p-3 rounded-xl border">


            <button onclick="this.parentElement.remove()"
                    class="px-3 bg-red-100 text-red-600 rounded-xl">

                <i class="ri-delete-bin-line"></i>

            </button>

        </div>
`;

        });



        let modal =
            document.getElementById('editModal');


        let content =
            document.getElementById('modalContent');


        modal.classList.remove('hidden');
        modal.classList.add('flex');


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

    function closeEditModal() {

        let content =
            document.getElementById(
                'modalContent'
            );


        content.classList.add(
            'opacity-0',
            'scale-90',
            'translate-y-10'
        );


        setTimeout(() => {

            let modal =
                document.getElementById(
                    'editModal'
                );


            modal.classList.add('hidden');
            modal.classList.remove('flex');


        }, 500);

    }

    function addPoint() {

        let container =
            document.getElementById(
                'keyPointsContainer'
            );


        container.insertAdjacentHTML(
            'beforeend', `
        <div class="flex gap-2">

            <input name="points[]"
                   class="flex-1 p-3 rounded-xl border">


            <button onclick="this.parentElement.remove()"
                    class="px-3 bg-red-100 text-red-600 rounded-xl">

                <i class="ri-delete-bin-line"></i>

            </button>

        </div>`
        );

    }

    async function updateLesson() {

        let id =
            document.getElementById(
                'edit_id'
            ).value;



        let formData =
            new FormData();


        formData.append(
            'title',
            edit_title.value
        );


        formData.append(
            'description',
            edit_description.value
        );


        formData.append(
            'duration',
            edit_duration.value
        );



        document
            .querySelectorAll(
                '#keyPointsContainer input'
            )
            .forEach(input => {

                formData.append(
                    'points[]',
                    input.value
                );

            });



        try {


            let response = await fetch(`{{ route('lesson.update',':id') }}`.replace(':id', id), {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,


                    "X-HTTP-Method-Override": "PUT",

                    "Accept": "application/json"

                },

                body: formData

            });



            let data =
                await response.json();



            if (data.success) {


                Swal.fire({

                    icon: "success",
                    title: "Updated!",
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false

                });


                closeEditModal();


            } else {

                Swal.fire(
                    "Error",
                    data.message,
                    "error"
                );

            }



        } catch (error) {

            Swal.fire(
                "Error",
                "Something went wrong!",
                "error"
            );

        }

    }
</script>

@endsection