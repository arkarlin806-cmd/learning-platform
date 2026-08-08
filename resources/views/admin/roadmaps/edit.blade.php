@extends('layout.admin')
@section('page_title',"Edit Roadmap")

@section('content')


<div class="max-w-7xl mx-auto px-6">


    <h1 class="text-3xl font-bold mb-8">

        Edit Learning Roadmap ✨

    </h1>



    <form id="roadmapEditForm">

        <input type="hidden"
            id="roadmap_id"
            value="{{ $roadmap->id }}">
        <div class="bg-white shadow rounded-3xl p-6 mb-8">
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="text-slate-600 font-bold text-lg my-2">
                        Career
                    </label>
                    <input
                        id="career"
                        value="{{ $roadmap->career }}"
                        class="w-full rounded-xl border bg-slate-100 py-3 px-5 text-slate-700 border-slate-300 mt-2">
                </div>

                <div>
                    <label class="text-slate-600 font-bold text-lg my-2">
                        Source
                    </label>

                    <select
                        id="source"
                        class="w-full rounded-xl border bg-slate-100 py-3 px-5 text-slate-700 border-slate-300 mt-2">

                        <option value="default"
                            @if($roadmap->source=="default") selected @endif>
                            Default
                        </option>
                        <option value="ai"
                            @if($roadmap->source=="ai") selected @endif>
                            AI
                        </option>
                    </select>
                </div>
            </div>

            <textarea
                id="description"
                class="w-full mt-5 rounded-xl border bg-slate-100 py-3 px-5 text-slate-700 border-slate-300"
                rows="4">

            {{ $roadmap->description }}

            </textarea>
            <label class="mt-5 block">
                <input
                    type="checkbox"
                    id="is_active"

                    @if($roadmap->is_active)
                checked
                @endif
                >
                Active
            </label>
        </div>

        <div id="phaseContainer">
            @foreach($roadmap->phases as $phase)
            <div class="phase bg-white shadow rounded-3xl p-6 mb-6">

                <div class="mb-4 phase-header cursor-move flex justify-between">
                    <h3 class="font-bold text-md">
                        ☰ Phase
                    </h3>


                    <button
                        type="button"
                        onclick="removeItem(this)"
                        class="text-red-500">

                        Remove

                    </button>


                </div>


                <div class="grid grid-cols-2 gap-5">


                    <div>
                        <label class="text-purple-800 font-bold text-sm">
                            Title
                        </label>
                        <input
                            class="phase-title w-full rounded-xl border mt-2 bg-purple-50 py-3 px-5 text-purple-700 border-purple-300"
                            value="{{ $phase->title }}">

                    </div>
                    <div>
                        <label class="text-purple-800 font-bold text-sm">
                            Days
                        </label>
                        <input
                            class="phase-days mt-2 rounded-xl w-full border bg-purple-50 py-3 px-5 text-purple-700 border-purple-300"
                            value="{{ $phase->estimated_days }}">


                    </div>

                </div>
                <div class="mt-2">
                    <label class="text-purple-800 font-bold text-sm">
                        Description
                    </label>
                    <textarea
                        class="phase-description h-28 mt-2 w-full rounded-xl border bg-purple-50 py-3 px-5 text-purple-700 border-purple-300">

                    {{ $phase->description }}

                    </textarea>
                </div>

                <!-- task  -->
                <div class="taskContainer mt-5">

                    @foreach($phase->tasks as $task)

                    <div class="task border border-slate-300 rounded-2xl p-4 mt-4">

                        <div class="task-header cursor-move flex justify-between">


                            <span class="text-slate-700 text-md font-bold">
                                ☰ Task
                            </span>


                            <button
                                type="button"
                                onclick="removeItem(this)"
                                class="text-red-500">

                                Remove

                            </button>


                        </div>


                        <div class="my-2">
                            <label class="text-pink-800 font-bold text-sm">
                                Title
                            </label>
                            <input
                                class="task-title mt-2 w-full rounded-xl border bg-pink-50 py-3 px-5 text-pink-700 border-pink-300"
                                value="{{ $task->title }}">

                        </div>
                        <div class="my-2">
                            <label class="text-pink-800 font-bold text-sm">
                                Description
                            </label>
                            <textarea
                                class="task-description mt-2 h-26 w-full rounded-xl border bg-pink-50 py-3 px-5 text-pink-700 border-pink-300">

                            {{ $task->description }}

                            </textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-3">



                            <input
                                type="hidden"
                                class="task-course-id"
                                value="{{ $task->course_id }}">

                            <div>
                                <label class="text-pink-800 font-bold text-sm">
                                    Minutes
                                </label>
                                <input
                                    class="task-minutes mt-3 ml-1 rounded-xl border bg-pink-50 py-3 px-5 text-pink-700 border-pink-300"
                                    value="{{ $task->estimated_minutes }}">
                            </div>


                            <div>
                                <label class="text-pink-800 font-bold text-sm">
                                    Lessons
                                </label>
                                <input
                                    class="task-lessons mt-3 ml-1 rounded-xl border bg-pink-50 py-3 px-5 text-pink-700 border-pink-300"
                                    value="{{ $task->lesson_count }}">
                            </div>

                            <div>
                                <label class="text-pink-800 font-bold text-sm">
                                    Practice
                                </label>
                                <input
                                    class="task-practice mt-3 ml-1 rounded-xl border bg-pink-50 py-3 px-5 text-pink-700 border-pink-300"
                                    value="{{ $task->practice_count }}">
                            </div>
                        </div>

                    </div>


                    @endforeach


                </div>




                <button
                    type="button"
                    onclick="addTask(this)"
                    class="mt-4 bg-gray-900 text-white px-4 py-2 rounded-xl">

                    + Add Task

                </button>




            </div>


            @endforeach



        </div>





        <button
            type="button"
            onclick="addPhase()"
            class="bg-indigo-600 text-white px-6 py-3 rounded-xl">

            + Add Phase

        </button>





        <button
            class="ml-4 bg-green-600 text-white px-10 py-3 rounded-xl">

            Update Roadmap

        </button>



    </form>



</div>

<script>
    document.addEventListener(
        "DOMContentLoaded",
        () => {


            initSortable();


        });



    function initSortable() {


        new Sortable(
            document.getElementById('phaseContainer'), {
                animation: 300,
                handle: '.phase-header'
            }
        );



        document
            .querySelectorAll('.taskContainer')
            .forEach(box => {


                new Sortable(
                    box, {
                        animation: 300,
                        handle: '.task-header'
                    }
                );


            });


    }





    function removeItem(btn) {


        btn.closest('.phase,.task').remove();


    }





    function addPhase() {


        document
            .getElementById('phaseContainer')
            .insertAdjacentHTML(
                'beforeend',
                `
<div class="phase bg-white shadow rounded-3xl p-6 mb-6">


<div class="phase-header cursor-move">

☰ Phase

<button
type="button"
onclick="removeItem(this)">
Remove
</button>

</div>


<input
class="phase-title mt-3 w-full rounded-xl border-gray-300"
placeholder="Phase title">


<textarea
class="phase-description mt-3 w-full rounded-xl border-gray-300">

</textarea>


<input
class="phase-days mt-3 rounded-xl border-gray-300"
placeholder="Days">


<div class="taskContainer"></div>



<button
type="button"
onclick="addTask(this)"
class="mt-3 bg-black text-white px-4 py-2 rounded-xl">

Add Task

</button>



</div>

`
            );


        initSortable();


    }






    function addTask(btn) {


        let box =
            btn.parentElement
            .querySelector('.taskContainer');



        box.insertAdjacentHTML(
            'beforeend',

            `

<div class="task border rounded-xl p-4 mt-3">


<div class="task-header cursor-move">

☰ Task

</div>


<input
class="task-title mt-2 w-full rounded-xl border"
placeholder="Title">


<textarea
class="task-description mt-2 w-full rounded-xl border">

</textarea>


<input
class="task-course-id mt-2 w-full rounded-xl border"
placeholder="Course ID">


<input
class="task-minutes mt-2 w-full rounded-xl border"
placeholder="Minutes">


<input
class="task-lessons mt-2 w-full rounded-xl border"
placeholder="Lessons">


<input
class="task-practice mt-2 w-full rounded-xl border"
placeholder="Practice">


</div>

`

        );


        initSortable();


    }






    document
        .getElementById('roadmapEditForm')
        .addEventListener(
            'submit',
            async function(e) {


                e.preventDefault();



                let phases = [];



                document
                    .querySelectorAll('.phase')
                    .forEach((phase, p) => {


                        let tasks = [];



                        phase
                            .querySelectorAll('.task')
                            .forEach((task, t) => {


                                tasks.push({

                                    title: task.querySelector('.task-title').value,


                                    description: task.querySelector('.task-description').value,


                                    course_id: task.querySelector('.task-course-id').value,


                                    estimated_minutes: task.querySelector('.task-minutes').value,


                                    lesson_count: task.querySelector('.task-lessons').value,


                                    practice_count: task.querySelector('.task-practice').value,


                                    sort_order: t + 1


                                });


                            });



                        phases.push({

                            title: phase.querySelector('.phase-title').value,


                            description: phase.querySelector('.phase-description').value,


                            estimated_days: phase.querySelector('.phase-days').value,


                            sort_order: p + 1,


                            tasks: tasks


                        });


                    });





                let data = {

                    career: career.value,

                    description: description.value,

                    source: source.value,

                    is_active: is_active.checked ? 1 : 0,


                    phases: phases

                };





                let id =
                    document.getElementById('roadmap_id').value;



                let response =
                    await fetch("{{ route('admin.roadmaps.update',':id') }}".replace(':id', id), {

                        method: "PUT",

                        headers: {


                            "Content-Type": "application/json",


                            "X-CSRF-TOKEN": document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                ).content


                        },


                        body: JSON.stringify(data)


                    });



                let result =
                    await response.json();



                if (result.status) {


                    alert(result.message);


                    location.reload();


                }



            });
</script>

@endsection