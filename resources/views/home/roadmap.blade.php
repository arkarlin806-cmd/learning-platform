@extends('layout.user')

@section('title','Roadmap')
@section('page','Learner Show Your Roadmap.')

@section('content')

<div class="max-w-6xl mx-auto px-6">



    <h1 class="text-3xl font-bold">

        {{$goal->target_role}} Roadmap 🚀

    </h1>

    <!-- Timeline -->
    <div class="mt-10 border-l-4 border-indigo-500 ml-5">
        @foreach(
        $progress->groupBy(
        fn($item)=>
        $item->task->phase->id
        )
        as $phaseId=>$tasks)

        <div class="ml-8 mb-10 bg-white/70 p-5 rounded-xl border border-slate-300">
            <div class="flex justify-between pr-4">
                <div class="">
                    <h1 class="text-slate-700 text-lg font-bold">{{$tasks->first()->task->phase->title}}</h1>
                    <p class="text-slate-400 text-sm ">{{$tasks->first()->task->phase->description}}</p>
                </div>
                <div class="bg-blue-100/50 border border-blue-300 text-blue-700 px-6 py-2 rounded-full h-8 flex justify-center items-center font-bold">{{$tasks->first()->task->phase->estimated_days}} days</div>
            </div>
            <div class="mt-5 space-y-4">
                @foreach($tasks as $item)
                <div class="bg-white/50 border border-slate-200 shadow rounded-2xl p-5 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold">
                            {{$item->task->title}}
                        </h3>
                        <p class="text-gray-500">
                            {{$item->task->description}}

                        </p>


                    </div>






                    @if($item->completed)



                    <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full">

                        Completed ✓

                    </span>



                    @else



                    <button

                        onclick="completeTask(
                                            '{{$item->id}}'
                                            )"

                        class="bg-indigo-600 hidden text-white px-5 py-2 rounded-xl">


                        Complete


                    </button>



                    @endif




                </div>



                @endforeach


            </div>


        </div>


        @endforeach



    </div>


</div>


<script>
    async function completeTask(id) {


        let response =
            await fetch(
                "/learning/task/" + id + "/complete", {

                    method: "POST",

                    headers: {


                        "X-CSRF-TOKEN": document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            ).content


                    }

                });



        let data =
            await response.json();



        if (data.status) {


            location.reload();


        }



    }
</script>


@endsection