@extends('layout.course_ins')
@section('title','Quiz')
@section('page','Assignment show and submit.')

@section('content')
<div class="max-w-7xl mx-auto px-6">

    <div class=" bg-white/70 border border-white/40 shadow-xl shadow-pink-100 rounded-3xl p-6 mb-8 animate-fade-in">

        <h1 class="text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
            {{ $quiz->title }}
        </h1>

        <div class="flex justify-between items-center my-3">

            <div class="text-sm text-slate-500">
                🧠 Questions:
                <span class="font-bold text-slate-800">
                    {{ $quiz->questions->count() }}
                </span>
            </div>

            @if(!$alreadyAnswered && $quiz->status != 'expired')
            <div id="countdown"
                class="px-5 py-2 rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-white font-bold shadow-lg">
            </div>
            @endif

        </div>

        @if($quiz->status == 'expired')
        <div class="mt-6 p-4 rounded-2xl bg-red-100 text-red-600 font-semibold">
            ⛔ Quiz Expired
        </div>
        @endif

        @if($alreadyAnswered)
        <div class="mt-6 p-6 rounded-2xl bg-green-100/50 border border-green-300">
            <h2 class="text-xl font-bold mb-2">🎯 Your Score</h2>
            <div class="text-3xl font-black text-green-800">
                {{ $score }} / {{ $quiz->questions->count() }}
            </div>
        </div>
        @endif

    </div>

    <form id="quizForm" class="space-y-6">

        @csrf

        @foreach($quiz->questions as $index => $question)

        @php
        $studentAnswer = $answers[$question->id] ?? null;
        @endphp

        <div class="group backdrop-blur-xl bg-white/50 border border-white rounded-3xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 animate-fade-in">

            <h3 class="text-lg font-bold my-2 text-slate-700">
                {{ $index + 1 }}. {{ $question->question }}
            </h3>

            <div class="grid gap-3">

                @foreach($question->options as $option)

                @php
                $isCorrect = $option->is_correct == 1;
                $is = $option->option_text == $option->is_correct;
                $isSelected = $studentAnswer && $studentAnswer->answer == $option->option_text;
                @endphp
                @if($question->type != "fill_blank")
                <label
                    class="cursor-pointer flex items-center gap-3 p-4 rounded-2xl border  transition-all duration-300
                                hover:scale-[1.02] hover:shadow-md
                                @if($alreadyAnswered)
                                    @if($isCorrect)
                                        bg-green-100/50 border-green-400 text-green-800
                                    @elseif($isSelected)
                                        bg-red-100/50 border-red-400 text-red-800
                                    @else
                                        bg-slate-200/50 border-white
                                    @endif
                                @else
                                    bg-white/60 hover:bg-white border-pink-200
                                @endif
                                ">

                    <input
                        type="radio" required
                        name="answers[{{$question->id}}]"
                        value="{{$option->option_text}}"
                        class="w-5 h-5 accent-indigo-600"
                        @if($isSelected) checked @endif
                        @if($alreadyAnswered || $quiz->status=='expired') disabled @endif
                    >
                    <span class="font-semibold">
                        {{ $option->option_text }}
                    </span>

                </label>
                @else
                <!-- fill blank answer -->
                @if($alreadyAnswered)
                <div class="flex gap-6">
                    <label class="cursor-pointer flex items-center gap-3 p-4 rounded-2xl border border-pink-200 transition-all duration-300
                                hover:scale-[1.02] hover:shadow-md">Your answer :
                        <input
                            type="text"
                            name="answers[{{$question->id}}]"
                            class="font-semibold"
                            value="{{$studentAnswer->answer}}"
                            @if($isSelected) checked @endif
                            @if($alreadyAnswered || $quiz->status=='expired') disabled @endif
                        >
                    </label>
                    <label
                        class="cursor-pointer flex items-center gap-3 px-4 py-3 rounded-2xl border border-blue-500 transition-all duration-300
                                    hover:scale-[1.02] hover:shadow-md
                                        @if($alreadyAnswered)
                                            @if($option->option_text == $studentAnswer->answer)
                                                bg-green-100/50 border-green-400 text-green-800
                                            @else
                                                bg-red-100/50 border-red-400 text-red-800
                                            @endif
                                        @else
                                            bg-white/60 hover:bg-white
                                        @endif
                                    
                                    ">


                        <input
                            type="text"
                            name="answers[{{$question->id}}]"
                            class="w-full accent-indigo-600 font-semibold"
                            value="{{$option->option_text}}"
                            @if($isSelected) checked @endif
                            @if($alreadyAnswered || $quiz->status=='expired') disabled @endif
                        >

                    </label>

                </div>
                <!-- fill blank not answer -->
                @else
                <input
                    type="text" required
                    name="answers[{{$question->id}}]"
                    class="w-full accent-indigo-600 border border-pink-200 py-3 px-5 rounded-xl"
                    @if($isSelected) checked @endif
                    @if($alreadyAnswered || $quiz->status=='expired') disabled @endif
                >
                @endif
                <!-- fill blank not answer -->
                @endif

                @endforeach

            </div>

        </div>

        @endforeach

        @if(auth()->user()->role == 2)
        <div
            onclick="showScores('{{ $quiz->id }}')"
            class="mt-5 bottom-5 w-full py-4 rounded-3xl font-bold text-white flex justify-center
                    bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-500
                    shadow-xl hover:scale-[1.01] transition-all duration-300">
            All Learner Score
        </div>
        @if($quiz->status == 'draft')
        <div class="psticky bottom-5 w-full py-4 rounded-3xl font-bold text-white
                    bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500
                    shadow-xl hover:scale-[1.01] transition-all duration-300 flex justify-center"><a href="{{ route('quiz.edit',$quiz->id) }}">Edit</a>
        </div>
        @endif
        @else
        @if(!$alreadyAnswered && $quiz->status != 'expired')

        <button
            id="submitBtn"
            type="submit"
            class="sticky bottom-5 w-full py-4 rounded-3xl font-bold text-white
                    bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500
                    shadow-xl hover:scale-[1.01] transition-all duration-300">
            🚀 Submit Quiz
        </button>

        @endif
        @endif

    </form>
    <div id="scoreModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white w-11/12 md:w-3/5 rounded-xl shadow-xl">

            <div class="flex justify-between p-5 border-b">

                <h2 class="text-xl font-bold">
                    Learner Scores
                </h2>

                <button onclick="closeModal()">✕</button>

            </div>

            <div class="p-5 overflow-auto max-h-[70vh]">

                <table class="w-full">

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Score</th>
                            <th>%</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody id="scoreBody">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<script>
    let endTime = new Date("{{ $quiz->end_at }}").getTime();

    let timer = setInterval(() => {
        let now = new Date().getTime();
        let distance = endTime - now;

        if (distance <= 0) {
            clearInterval(timer);

            document.querySelectorAll('input').forEach(i => i.disabled = true);

            let btn = document.getElementById('submitBtn');
            if (btn) btn.remove();

            Swal.fire({
                icon: 'warning',
                title: 'Time is up!',
                text: 'Quiz has expired'
            });

            return;
        }

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let secs = Math.floor((distance % (1000 * 60)) / 1000);

        let el = document.getElementById('countdown');
        if (el) {
            el.innerHTML = `⏳ ${days}d ${hours}h ${mins}m ${secs}s`;
        }

    }, 1000);

    // submit
    document.getElementById('quizForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        fetch(`{{ route('quiz.submit',$quiz->id) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: new FormData(this)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted!',
                        text: 'Your quiz has been saved'
                    }).then(() => location.reload());
                }
            });
    });
</script>
<script>
    function showScores(id) {
        document.getElementById('scoreModal').classList.remove('hidden');
        document.getElementById('scoreModal').classList.add('flex');

        fetch(`{{ route('instructor.quiz.learner-scores',':id') }}`.replace(':id', id))
            .then(res => res.json())
            .then(data => {

                let html = '';

                data.forEach(item => {

                    html += `
            <tr class="border-b">

                <td class="py-3">
                    ${item.name}
                    <br>
                    <small>${item.email}</small>
                </td>

                <td class="text-center">
                    ${item.score}/${item.total}
                </td>

                <td class="text-center">
                    ${item.percentage}%
                </td>

                <td class="text-center">

                    ${
                        item.status=="Completed"
                        ?
                        '<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full">Completed</span>'
                        :
                        '<span class="px-2 py-1 bg-red-100 text-red-700 rounded-full">Not Attempted</span>'
                    }

                </td>

            </tr>`;
                });

                document.getElementById('scoreBody').innerHTML = html;

            });
    }

    function closeModal() {
        document.getElementById('scoreModal').classList.remove('flex');
        document.getElementById('scoreModal').classList.add('hidden');
    }
</script>
@endsection