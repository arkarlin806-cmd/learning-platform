@extends('layout.admin')
@section('page_title')
Create Roadmap
@endsection
@section('content')

<div class="max-w-6xl mx-auto">


    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Create Learning Roadmap 🚀
        </h1>

        <p class="text-gray-500">
            Build default learning path for learners
        </p>

    </div>



    <form id="roadmapForm">


        <!-- Roadmap Info -->

        <div class="bg-white shadow rounded-3xl p-6 mb-8">


            <h2 class="text-xl font-bold mb-5">
                Roadmap Information
            </h2>



            <div class="grid md:grid-cols-2 gap-5">


                <div>

                    <label>
                        Career
                    </label>

                    <input
                        id="career"
                        class="w-full mt-2 rounded-xl border-slate-300 px-6 py-3 border border-slate-300 bg-slate-100 text-slate-700"
                        placeholder="Full Stack Developer .......................">

                </div>



                <div>

                    <label>
                        Source
                    </label>


                    <select
                        id="source"
                        class="w-full mt-2 rounded-xl px-6 py-3 border border-slate-300 bg-slate-100 text-slate-700">


                        <option value="default">
                            Default
                        </option>


                        <option value="ai">
                            AI
                        </option>


                    </select>


                </div>


            </div>




            <div class="mt-5">


                <label>
                    Description
                </label>


                <textarea
                    id="description"
                    rows="4"
                    class="w-full mt-2 rounded-xl px-6 py-3 border border-slate-300 bg-slate-100 text-slate-700">
</textarea>


            </div>



            <div class="mt-5">

                <label>

                    <input
                        type="checkbox"
                        id="is_active"
                        checked>

                    Active

                </label>


            </div>


        </div>





        <!-- Phase Area -->


        <div
            id="phaseContainer">

        </div>



        <button
            type="button"
            onclick="addPhase()"
            class="bg-indigo-600 text-white px-6 py-3 rounded-xl">

            + Add Phase

        </button>





        <div class="mt-8">

            <button
                class="bg-green-600 text-white px-10 py-3 rounded-xl">

                Save Roadmap

            </button>


        </div>



    </form>


</div>

<script>
    let phaseCount = 0;



    function addPhase() {


        phaseCount++;


        let html =
            `
<div class="phase bg-white shadow rounded-3xl p-6 mb-6">
<div class="phase-header cursor-move flex justify-between">
<h3 class="font-bold text-lg">
☰ Phase ${phaseCount}
</h3>
<button
type="button"
onclick="removeItem(this)"
class="text-red-500">
Remove
</button>
</div>

<div class="grid grid-cols-2 gap-5">
<input
class="phase-title mt-4 w-full rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Phase Title">
<input
type="number"
class="phase-days mt-3 w-full rounded-xl border  border-blue-300 px-4 py-3 bg-white/80 text-slate-700"
placeholder="Estimated Days">
</div>

<textarea
class="phase-description mt-5 w-full rounded-xl border border-slate-300 px-4 py-3 h-40 bg-slate-100 text-slate-700"
placeholder="Description">
</textarea>



<h4 class="mt-5 font-bold">
Tasks
</h4>

<div class="taskContainer mt-3">

</div>

<button
type="button"
onclick="addTask(this)"
class="mt-4 bg-gray-900 text-white px-4 py-2 rounded-xl">

+ Add Task

</button>

</div>
`;



        document
            .getElementById('phaseContainer')
            .insertAdjacentHTML(
                'beforeend',
                html
            );

        initSortable();

    }


    function addTask(btn) {

        let container =
            btn.parentElement.querySelector(
                '.taskContainer'
            );



        let html =
            `
<div class="task border rounded-2xl p-4 mt-4">

<div class="task-header cursor-move flex justify-between">

<span>
☰ Task
</span>


<button
type="button"
onclick="removeItem(this)"
class="text-red-500">

Remove

</button>


</div>




<input
class="task-title mt-3 w-full rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Task title">





<textarea
class="task-description mt-3 w-full rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Task description">
</textarea>





<div class="relative mt-3">


<input
class="task-course-search w-full rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Search Course">



<input
type="hidden"
class="task-course-id">



<div class="course-result absolute bg-white shadow w-full z-50">

</div>



</div>






<div class="grid grid-cols-3 gap-3 mt-3">


<input
class="task-minutes rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Minutes">



<input
class="task-lessons rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Lessons">



<input
class="task-practice rounded-xl border border-slate-300 px-4 py-3 bg-slate-100 text-slate-700"
placeholder="Practice">


</div>



</div>

`;

        container.insertAdjacentHTML(
            'beforeend',
            html
        );

        initSortable();
    }

    function removeItem(btn) {
        let item =
            btn.closest('.phase,.task');

        item.classList.add(
            'opacity-0',
            'scale-95'
        );

        setTimeout(() => {
            item.remove();
        }, 300);
    }

    function initSortable() {
        document
            .querySelectorAll('.taskContainer')
            .forEach(container => {
                if (!container.dataset.sortable) {
                    new Sortable(
                        container, {
                            animation: 300,
                            handle: '.task-header'
                        }
                    );
                    container.dataset.sortable = true;
                }
            });
        new Sortable(
            document.getElementById(
                'phaseContainer'
            ), {
                animation: 300,
                handle: '.phase-header'
            }
        );
    }
    // Course Search
    document.addEventListener(
        'input',
        function(e) {
            if (
                e.target.classList.contains(
                    'task-course-search'
                )
            ) {
                let input = e.target;
                fetch("{{ route('admin.course.search',':q') }}".replace(':q', input.value))
                    .then(r => r.json())
                    .then(data => {


                        let box =
                            input.parentElement
                            .querySelector('.course-result');


                        box.innerHTML = "";



                        data.forEach(course => {


                            box.innerHTML +=
                                `
<div
onclick="selectCourse(this)"
data-id="${course.id}"
class="p-3 hover:bg-gray-100 cursor-pointer">

${course.title}

</div>

`;


                        });


                    });


            }


        });






    function selectCourse(el) {


        let parent =
            el.closest('.relative');



        parent.querySelector(
                '.task-course-search'
            ).value =
            el.innerText;



        parent.querySelector(
                '.task-course-id'
            ).value =
            el.dataset.id;



        parent.querySelector(
            '.course-result'
        ).innerHTML = "";


    }







    // Submit


    document
        .getElementById('roadmapForm')
        .addEventListener(
            'submit',
            async function(e) {


                e.preventDefault();



                let phases = [];



                document
                    .querySelectorAll('.phase')
                    .forEach((phase, pIndex) => {


                        let tasks = [];



                        phase
                            .querySelectorAll('.task')
                            .forEach((task, tIndex) => {


                                tasks.push({

                                    title: task.querySelector('.task-title').value,


                                    description: task.querySelector('.task-description').value,


                                    course_id: task.querySelector('.task-course-id').value || null,
                                    estimated_minutes: task.querySelector('.task-minutes').value,


                                    lesson_count: task.querySelector('.task-lessons').value || 0,


                                    practice_count: task.querySelector('.task-practice').value || 0,


                                    sort_order: tIndex + 1


                                });


                            });




                        phases.push({

                            title: phase.querySelector('.phase-title').value,


                            description: phase.querySelector('.phase-description').value,


                            estimated_days: phase.querySelector('.phase-days').value,


                            sort_order: pIndex + 1,


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







                let res =
                    await fetch(
                        "{{ route('admin.roadmaps.store') }}", {


                            method: "POST",


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
                    await res.json();



                if (result.status) {


                    alert(result.message);


                    location.reload();


                } else {


                    alert("Error");


                }



            });
</script>
@endsection