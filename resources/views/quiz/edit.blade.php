@extends('layout.course_ins')
@section('title', 'Edit Quiz')
@section('page', 'Update existing quiz questions and options.')

@section('content')

<div class="bg-white/70 border border-white/40 shadow-xl shadow-pink-100 rounded-3xl p-6 mb-8 animate-fade-in flex flex-wrap justify-between items-center gap-4">
    <div>
        <h1 class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
            ✏️ Edit Quiz: {{ $quiz->title }}
        </h1>
        <p class="text-slate-500 text-sm mt-1">
            Modify existing questions, options, true/false answers, or add new items.
        </p>
    </div>

    <a href="{{ route('quiz.show', $quiz->id) }}" class="px-5 py-2.5 rounded-2xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold shadow-sm transition-all duration-300 hover:scale-105">
        ⬅️ View Quiz
    </a>
</div>

<form id="editQuizForm" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Quiz Settings Block -->
    <div class="backdrop-blur-xl bg-white/60 border border-white rounded-3xl p-6 shadow-md animate-fade-in space-y-4">
        <h2 class="text-xl font-bold text-slate-800 border-b border-slate-100 pb-3">⚙️ Quiz Settings</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Quiz Title</label>
                <input type="text" name="title" value="{{ $quiz->title }}" required
                    class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-medium">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">End Date & Time</label>
                <input type="datetime-local" name="end_at" value="{{ \Carbon\Carbon::parse($quiz->end_at)->format('Y-m-d\TH:i') }}" required
                    class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-medium text-slate-700">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-semibold text-slate-700">
                    <option value="draft" {{ $quiz->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $quiz->status == 'published' ? 'selected' : '' }}>published</option>
                    <option value="expired" {{ $quiz->status == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Questions Container -->
    <div id="questionsContainer" class="space-y-6">
        @foreach($quiz->questions as $index => $question)
        <div class="question-card group backdrop-blur-xl bg-white/50 border border-white rounded-3xl p-6 shadow-md hover:shadow-xl transition-all duration-300 animate-fade-in relative" data-index="{{ $index }}">

            <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

            <div class="flex justify-between items-center border-b border-slate-100/80 pb-3 mb-4">
                <span class="font-bold text-indigo-600 text-lg question-number">
                    Question {{ $index + 1 }}
                </span>
                <button type="button" onclick="removeQuestion(this)" class="text-rose-500 hover:text-rose-700 font-bold text-xs sm:text-sm px-3 py-1.5 bg-rose-50 rounded-xl hover:bg-rose-100 transition duration-200">
                    🗑️ Remove Question
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Question Statement</label>
                    <input type="text" name="questions[{{ $index }}][question]" value="{{ $question->question }}" required
                        class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Question Type</label>
                    <select name="questions[{{ $index }}][type]" onchange="toggleType(this)"
                        class="w-full px-4 py-2.5 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-medium text-slate-700">
                        <option value="mcq" {{ ($question->type == 'mcq' || $question->type == 'multiple_choice') ? 'selected' : '' }}>Multiple Choice</option>
                        <option value="true_false" {{ $question->type == 'true_false' ? 'selected' : '' }}>True / False</option>
                        <option value="fill_blank" {{ $question->type == 'fill_blank' ? 'selected' : '' }}>Fill in the Blank</option>
                    </select>
                </div>

                <!-- 1. Multiple Choice Section -->
                <div class="mc-section space-y-3 {{ ($question->type != 'multiple_choice' && $question->type != 'mcq') ? 'hidden' : '' }}">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Options (Select radio for correct answer):
                    </label>

                    <div class="options-container space-y-2.5">
                        @php
                        $options = $question->options;
                        if($options->isEmpty() && ($question->type == 'multiple_choice' || $question->type == 'mcq')) {
                        $options = collect([
                        (object)['option_text' => '', 'is_correct' => 1],
                        (object)['option_text' => '', 'is_correct' => 0],
                        (object)['option_text' => '', 'is_correct' => 0],
                        (object)['option_text' => '', 'is_correct' => 0]
                        ]);
                        }
                        @endphp

                        @foreach($options as $oIndex => $option)
                        <div class="flex items-center gap-3 p-2 bg-white/60 border border-pink-100 rounded-2xl">
                            <input type="radio" name="questions[{{ $index }}][correct_option]" value="{{ $oIndex }}"
                                class="w-5 h-5 accent-indigo-600 ml-2" {{ $option->is_correct ? 'checked' : '' }}>
                            <input type="text" name="questions[{{ $index }}][options][{{ $oIndex }}]" value="{{ $option->option_text }}"
                                placeholder="Option {{ $oIndex + 1 }}"
                                class="w-full px-4 py-2 bg-transparent font-medium text-slate-700 outline-none">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. True / False Section -->
                @php
                $tfTrueOption = $question->options->where('option_text', 'True')->first();
                $isTrueCorrect = $tfTrueOption ? $tfTrueOption->is_correct : true;
                @endphp
                <div class="tf-section space-y-3 {{ $question->type != 'true_false' ? 'hidden' : '' }}">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Select Correct Statement Answer:</label>
                    <div class="flex items-center gap-6 p-4 bg-white/60 border border-pink-100 rounded-2xl">
                        <label class="inline-flex items-center gap-2 cursor-pointer font-bold text-emerald-600">
                            <input type="radio" name="questions[{{ $index }}][tf_correct]" value="True" class="w-5 h-5 accent-emerald-600" {{ $isTrueCorrect ? 'checked' : '' }}>
                            True
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer font-bold text-rose-600">
                            <input type="radio" name="questions[{{ $index }}][tf_correct]" value="False" class="w-5 h-5 accent-rose-600" {{ !$isTrueCorrect ? 'checked' : '' }}>
                            False
                        </label>
                    </div>
                </div>

                <!-- 3. Fill in the Blank Section -->
                <div class="fb-section {{ $question->type != 'fill_blank' ? 'hidden' : '' }}">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Correct Answer Text</label>
                    <input type="text" name="questions[{{ $index }}][blank_answer]"
                        value="{{ $question->options->first()->option_text ?? '' }}"
                        placeholder="Enter the exact answer"
                        class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-semibold text-slate-800">
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add Question Button -->
    <button type="button" onclick="addQuestion()"
        class="w-full py-4 bg-white/80 hover:bg-white text-indigo-600 font-bold rounded-3xl border-2 border-dashed border-indigo-200 hover:border-indigo-400 transition-all duration-300 shadow-sm hover:shadow-md">
        ➕ Add New Question
    </button>

    <!-- Confirm / Submit Button -->
    <button id="submitBtn" type="submit"
        class="sticky bottom-5 w-full py-4 rounded-3xl font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow-xl hover:scale-[1.01] transition-all duration-300">
        💾 Confirm & Update Database
    </button>
</form>

<script class="keep">
    let questionCounter = `{{ $quiz->questions->count() }}`;

    function addQuestion() {
        const container = document.getElementById('questionsContainer');
        const qIndex = questionCounter;

        const html = `
        <div class="question-card group backdrop-blur-xl bg-white/50 border border-white rounded-3xl p-6 shadow-md hover:shadow-xl transition-all duration-300 animate-fade-in relative" data-index="${qIndex}">
            <input type="hidden" name="questions[${qIndex}][id]" value="">

            <div class="flex justify-between items-center border-b border-slate-100/80 pb-3 mb-4">
                <span class="font-bold text-indigo-600 text-lg question-number">
                    Question #${container.children.length + 1}
                </span>
                <button type="button" onclick="removeQuestion(this)" class="text-rose-500 hover:text-rose-700 font-bold text-xs sm:text-sm px-3 py-1.5 bg-rose-50 rounded-xl hover:bg-rose-100 transition duration-200">
                    🗑️ Remove Question
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Question Statement</label>
                    <input type="text" name="questions[${qIndex}][question]" required
                        class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Question Type</label>
                  <select name="questions[${qIndex}][type]" onchange="toggleType(this)"
    class="w-full px-4 py-2.5 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-medium text-slate-700">
    <option value="mcq">Multiple Choice</option>
    <option value="true_false">True / False</option>
    <option value="fill_blank">Fill in the Blank</option>
</select>
                </div>

                <!-- MC Section -->
                <div class="mc-section space-y-3">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Options (Select radio for correct answer):</label>
                    <div class="options-container space-y-2.5">
                        <div class="flex items-center gap-3 p-2 bg-white/60 border border-pink-100 rounded-2xl">
                            <input type="radio" name="questions[${qIndex}][correct_option]" value="0" checked class="w-5 h-5 accent-indigo-600 ml-2">
                            <input type="text" name="questions[${qIndex}][options][0]" placeholder="Option 1" class="w-full px-4 py-2 bg-transparent font-medium text-slate-700 outline-none">
                        </div>
                        <div class="flex items-center gap-3 p-2 bg-white/60 border border-pink-100 rounded-2xl">
                            <input type="radio" name="questions[${qIndex}][correct_option]" value="1" class="w-5 h-5 accent-indigo-600 ml-2">
                            <input type="text" name="questions[${qIndex}][options][1]" placeholder="Option 2" class="w-full px-4 py-2 bg-transparent font-medium text-slate-700 outline-none">
                        </div>
                        <div class="flex items-center gap-3 p-2 bg-white/60 border border-pink-100 rounded-2xl">
                            <input type="radio" name="questions[${qIndex}][correct_option]" value="2" class="w-5 h-5 accent-indigo-600 ml-2">
                            <input type="text" name="questions[${qIndex}][options][2]" placeholder="Option 3" class="w-full px-4 py-2 bg-transparent font-medium text-slate-700 outline-none">
                        </div>
                        <div class="flex items-center gap-3 p-2 bg-white/60 border border-pink-100 rounded-2xl">
                            <input type="radio" name="questions[${qIndex}][correct_option]" value="3" class="w-5 h-5 accent-indigo-600 ml-2">
                            <input type="text" name="questions[${qIndex}][options][3]" placeholder="Option 4" class="w-full px-4 py-2 bg-transparent font-medium text-slate-700 outline-none">
                        </div>
                    </div>
                </div>

                <!-- True False Section -->
                <div class="tf-section space-y-3 hidden">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Select Correct Statement Answer:</label>
                    <div class="flex items-center gap-6 p-4 bg-white/60 border border-pink-100 rounded-2xl">
                        <label class="inline-flex items-center gap-2 cursor-pointer font-bold text-emerald-600">
                            <input type="radio" name="questions[${qIndex}][tf_correct]" value="True" checked class="w-5 h-5 accent-emerald-600">
                            True
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer font-bold text-rose-600">
                            <input type="radio" name="questions[${qIndex}][tf_correct]" value="False" class="w-5 h-5 accent-rose-600">
                            False
                        </label>
                    </div>
                </div>

                <!-- Fill Blank Section -->
                <div class="fb-section hidden">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Correct Answer Text</label>
                    <input type="text" name="questions[${qIndex}][blank_answer]" placeholder="Enter the exact answer"
                        class="w-full px-4 py-3 rounded-2xl border border-pink-200 bg-white/80 focus:ring-2 focus:ring-indigo-500 outline-none font-semibold text-slate-800">
                </div>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        questionCounter++;
        reindexQuestions();
    }

    function removeQuestion(btn) {
        btn.closest('.question-card').remove();
        reindexQuestions();
    }

    function toggleType(selectEl) {
        const card = selectEl.closest('.question-card');
        const mcSection = card.querySelector('.mc-section');
        const tfSection = card.querySelector('.tf-section');
        const fbSection = card.querySelector('.fb-section');

        mcSection.classList.add('hidden');
        tfSection.classList.add('hidden');
        fbSection.classList.add('hidden');

        if (selectEl.value === 'multiple_choice' || selectEl.value === 'mcq') {
            mcSection.classList.remove('hidden');
        } else if (selectEl.value === 'true_false') {
            tfSection.classList.remove('hidden');
        } else if (selectEl.value === 'fill_blank') {
            fbSection.classList.remove('hidden');
        }
    }

    function reindexQuestions() {
        document.querySelectorAll('.question-card').forEach((card, idx) => {
            card.querySelector('.question-number').innerText = `Question ${idx + 1}`;
        });
    }

    document.getElementById('editQuizForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerText = '⏳ Updating Database...';

        const formData = new FormData(this);

        fetch(`{{ route('quiz.update', $quiz->id) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    let errorMsg = data.message || `Server Error: ${response.status}`;
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    throw new Error(errorMsg);
                }
                return data;
            })
            .then(data => {
                btn.disabled = false;
                btn.innerText = '💾 Confirm & Update Database';

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Quiz Updated!',
                        text: data.message || 'Your changes were saved successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = `{{ route('quiz.show', $quiz->id) }}`;
                    });
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = '💾 Confirm & Update Database';

                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    html: err.message
                });
            });
    });
</script>

@endsection