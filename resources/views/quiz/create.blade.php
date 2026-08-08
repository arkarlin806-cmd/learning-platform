@extends('layout.course_ins')

@section('title','Quiz')
@section('page','Instructor Quiz Create.')
@section('content')

<div class="max-w-7xl mx-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

        <div>
            <h1 class="text-slate-600 text-3xl font-extrabold">
                Quiz Create ( {{ $course->title }} )
            </h1>
            <p class="text-slate-500 py-2">
                Create, edit, and publish interactive quizzes (2026 SaaS Style)
            </p>
        </div>

        <div class="flex gap-3">
            <button id="publishBtn"
                class="px-6 py-3 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 text-white font-bold shadow-xl hover:scale-105 transition">
                Publish Quiz
            </button>

        </div>

    </div>

    <!-- QUIZ INFO -->
    <div class="bg-white/70 backdrop-blur-xl rounded-3xl p-8 shadow-sm mb-10 border-l-4 border-cyan-500">

        <div class="grid md:grid-cols-2 gap-6">
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div>
                <label class="font-semibold">Quiz Title</label>
                <input name="title" require
                    class="w-full px-4  rounded-2xl h-16 mt-3
                            bg-white/50 backdrop-blur-md
                            border border-cyan-500
                            shadow-sm
                        text-slate-700
                        transition-all duration-300
                        hover:shadow-lg hover:scale-[1.01]  
                        focus:outline-none
                        focus:ring-2 focus:ring-cyan-200
                        focus:border-cyan-700
                        focus:bg-white">
            </div>
            <div class="">
                <label class="font-semibold">End At</label>
                <input type="date" name="endAt" required
                    placeholder="Search..."
                    class="w-full px-4  rounded-2xl h-16 mt-3
                            bg-white/50 backdrop-blur-md
                            border border-cyan-500
                            shadow-sm
                        text-slate-700
                        transition-all duration-300
                        hover:shadow-lg hover:scale-[1.01]                       
                        focus:outline-none
                        focus:ring-2 focus:ring-cyan-200
                        focus:border-cyan-700
                        focus:bg-white" />
            </div>

        </div>

        <div class=" grid md:grid-cols-2 sm:grid-cols-1 gap-6">
            <div class="mt-6">
                <label class="font-semibold">Description</label>
                <textarea name="description" required
                    class="w-full px-4 py-1 rounded-2xl h-16 mt-3
                            bg-white/50 backdrop-blur-md
                            border border-cyan-500
                            shadow-sm
                        text-slate-700
                        transition-all duration-300                 
                        hover:shadow-lg hover:scale-[1.01]                 
                        focus:outline-none
                        focus:ring-2 focus:ring-cyan-200
                        focus:border-cyan-700
                        focus:bg-white"
                    rows="3"></textarea>
            </div>

        </div>


    </div>

    <!-- QUESTION HEADER -->
    <div class="flex justify-between items-center mb-5">
        <div class="pl-6">
            <h2 class="text-3xl font-bold text-slate-800">
                Questions
            </h2>
            <p class="text-slate-500 text-sm">Add quesion and choose quesion type.</p>
        </div>
        <button type="button"
            id="addQuestionBtn"
            class="px-5 py-3 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-700 text-white font-semibold shadow-lg hover:scale-105 transition">
            + Add Question
        </button>

    </div>

    <!-- QUESTIONS CONTAINER -->
    <div id="questionContainer" class="space-y-6"></div>

</div>
<style>
    .question-card {
        animation: fadeUp .45s ease;
    }

    .question-card:hover {
        transform: translateY(-6px) scale(1.01);
    }

    .option-input,
    .question-text,
    .question-type,
    .correct-answer {
        transition: all .3s ease;
    }

    .option-input:hover,
    .question-text:hover,
    .question-type:hover,
    .correct-answer:hover {
        transform: translateY(-2px);
    }

    @keyframes fadeUp {

        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }
</style>

<script>
    let questionIndex = 0;

    /* ADD QUESTION */
    document.getElementById('addQuestionBtn').addEventListener('click', addQuestion);

    function addQuestion() {
        questionIndex++;

        let html = `
    <div class="question-card group relative overflow-hidden p-5 md:p-7
    rounded-[32px]
    border border-slate-200
    bg-gradient-to-br from-sky-50 via-white to-indigo-50
    shadow-[0_15px_40px_rgba(15,23,42,.08)]
    hover:shadow-[0_25px_60px_rgba(59,130,246,.15)]
    hover:-translate-y-1
    transition-all duration-500">

        <div class="flex justify-between items-center mb-4">

            <h3 class="font-bold text-lg text-slate-900">
                Question ${questionIndex}
            </h3>

            <button type="button"
                class="text-red-700 bg-red-100/50 border border-red-300 px-3 py-1 rounded-lg hover:shadow-lg font-bold"
                onclick="this.closest('.question-card').remove()">
                Delete
            </button>

        </div>

        <!-- TYPE -->
            <label class="block mb-2 text-sm font-semibold text-slate-700">
                Question Type
            </label>

            <select
                class="question-type
            w-full
            rounded-2xl
            border border-sky-200
            bg-white
            p-4
            text-slate-700
            shadow-sm
            focus:ring-4
            focus:ring-sky-100
            focus:border-sky-400
            transition"
                onchange="changeType(this)">

                <option value="mcq">
                    Multiple Choice
                </option>

                <option value="true_false">
                    True / False
                </option>

                <option value="fill_blank">
                    Fill Blank
                </option>

            </select>
        <!-- QUESTION -->
        <!-- ANSWER AREA -->
            <textarea required
                class="question-text my-3
            w-full
            min-h-[140px]
            rounded-2xl
            border border-slate-200
            bg-white
            p-5
            resize-none
            shadow-sm
            focus:ring-4
            focus:ring-sky-100
            focus:border-sky-400
            transition"
                placeholder="Enter your question here..."></textarea>
        <div class="answer-area">
            ${mcqTemplate()}
        </div>

    </div>
    `;

        document.getElementById('questionContainer')
            .insertAdjacentHTML('beforeend', html);
    }

    /* CHANGE TYPE */
    function changeType(el) {
        let box = el.closest('.question-card').querySelector('.answer-area');

        if (el.value === 'mcq') box.innerHTML = mcqTemplate();
        if (el.value === 'true_false') box.innerHTML = tfTemplate();
        if (el.value === 'fill_blank') box.innerHTML = blankTemplate();
    }

    /* MCQ */
    function mcqTemplate() {
        return `
<div class="space-y-3">

<input class="option-input  w-full rounded-2xl border border-slate-200 bg-white p-4 shadow-sm focus:ring-4 focus:ring-sky-100 focus:border-sky-400 transition
" placeholder="Option A" required>
<input class="option-input  w-full rounded-2xl border border-slate-200 bg-white p-4 shadow-sm focus:ring-4 focus:ring-sky-100 focus:border-sky-400 transition
0" placeholder="Option B" required>
<input class="option-input  w-full rounded-2xl border border-slate-200 bg-white p-4 shadow-sm focus:ring-4 focus:ring-sky-100 focus:border-sky-400 transition
" placeholder="Option C" required>
<input class="option-input  w-full rounded-2xl border border-slate-200 bg-white p-4 shadow-sm focus:ring-4 focus:ring-sky-100 focus:border-sky-400 transition
" placeholder="Option D" required>

<select class="correct-answer w-full p-3 rounded-xl bg-indigo-100" required>
    <option value="0">✅ A Correct</option>
    <option value="1">✅ B Correct</option>
    <option value="2">✅ C Correct</option>
    <option value="3">✅ D Correct</option>
</select>

</div>
`;
    }

    /* TRUE FALSE */
    function tfTemplate() {
        return `
<select class="tf-answer w-full p-3 rounded-xl bg-indigo-100" required>
    <option value="true">True</option>
    <option value="false">False</option>
</select>
`;
    }

    /* FILL BLANK */
    function blankTemplate() {
        return `
<input class="blank-answer w-full p-3 rounded-xl bg-indigo-100"
       placeholder="Correct Answer" required>
`;
    }

    /* SUBMIT QUIZ */
    document.getElementById('publishBtn').addEventListener('click', function() {

        let quiz = {
            course_id: document.querySelector('[name="course_id"]').value,
            title: document.querySelector('[name="title"]').value,
            description: document.querySelector('[name="description"]').value,
            endAt: document.querySelector('[name="endAt"]').value,
            questions: []
        };

        document.querySelectorAll('.question-card').forEach(card => {

            let type = card.querySelector('.question-type').value;
            let question = card.querySelector('.question-text').value;

            let data = {
                type: type,
                question: question,
                options: [],
                answer: null
            };

            if (type === 'mcq') {
                card.querySelectorAll('.option-input')
                    .forEach(opt => data.options.push(opt.value));

                data.answer =
                    card.querySelector('.correct-answer').value;
            }

            if (type === 'true_false') {
                data.answer =
                    card.querySelector('.tf-answer').value;
            }

            if (type === 'fill_blank') {
                data.answer =
                    card.querySelector('.blank-answer').value;
            }

            quiz.questions.push(data);
        });

        fetch(`{{ route('quiz.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(quiz)
            })
            .then(res => res.json())
            .then(res => {

                Swal.fire({
                    title: '🎉 Quiz Published',
                    html: `
                        <div class = "mt-3" >
                        <p> Quiz created successfully. </p>

                        <div class = "mt-4 p-4 bg-green-50 rounded-2xl" >
                        Students can now access this quiz. </div> </div>`,
                    icon: 'success',
                    confirmButtonText: 'Done',
                    width: 600,
                    timer: 2000,
                    showClass: {
                        popup: 'animateanimated animatefadeInUp'
                    },
                    hideClass: {
                        popup: 'animateanimated animatefadeOutDown'
                    }
                });
                // Quiz Form Clean
                document.querySelector('[name="title"]').value = '';
                document.querySelector('[name="description"]').value = '';
                document.querySelector('[name="endAt"]').value = '';

                // Remove All Questions
                document.getElementById('questionContainer').innerHTML = '';

                // Reset Counter
                questionIndex = 0;

            })
            .catch(error => {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!'
                });

                console.error(error);

            });

    });
</script>

@endsection