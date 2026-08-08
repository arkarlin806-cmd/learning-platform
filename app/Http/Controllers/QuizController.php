<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{

    public function create($id)
    {
        $course = Course::findOrFail($id);
        $isPurchased = QuizController::isPurchased($id);
        $isInstructor = QuizController::isInstructor();
        if ($isInstructor || $isPurchased) {
            return view('quiz.create', compact('course', 'isInstructor', 'isPurchased'));
        } else {
            abort(404, 'Please purchase course!.');
        }
    }
    public function store(Request $request) //quiz create
    {
        $quiz = Quiz::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'draft',
            'end_at' => $request->endAt,
        ]);

        foreach ($request->questions as $index => $q) {
            $correctAnswer = null;

            if ($q['type'] === 'mcq') {
                // Option index ကို text အဖြစ်သိမ်း
                $correctAnswer = $q['options'][$q['answer']] ?? null;
            }

            if ($q['type'] === 'true_false') {
                $correctAnswer = $q['answer']; // true or false
            }

            if ($q['type'] === 'fill_blank') {
                $correctAnswer = $q['answer'];
            }
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'type' => $q['type'],
                'question' => $q['question'],
                'position' => $index + 1,
                'correct_answer' => $correctAnswer
            ]);

            // MCQ
            if ($q['type'] === 'mcq') {
                foreach ($q['options'] as $i => $opt) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => $opt,
                        'is_correct' => $q['answer'] == $i
                    ]);
                }
                log::info($q['options']);
            }

            // TRUE FALSE
            if ($q['type'] === 'true_false') {
                QuestionOption::insert([
                    [
                        'question_id' => $question->id,
                        'option_text' => 'True',
                        'is_correct' => $q['answer'] === 'true'
                    ],
                    [
                        'question_id' => $question->id,
                        'option_text' => 'False',
                        'is_correct' => $q['answer'] === 'false'
                    ],
                ]);
            }

            // FILL BLANK
            if ($q['type'] === 'fill_blank') {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $q['answer'],
                    'is_correct' => true
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Quiz created successfully',
            'quiz_id' => $quiz->id
        ]);
    }

    public function quiz_all($courseId) //all quiz show
    {
        $course = Course::findOrFail($courseId);
        if (auth()->user()->role == 2) {
            $quizzes = Quiz::where('course_id', $courseId)
                ->orderByDesc('id')
                ->get();
        } else {
            $quizzes = Quiz::where('course_id', $courseId)
                ->whereNot('status', 'draft')
                ->orderByDesc('id')
                ->get();
        }

        foreach ($quizzes as $quiz) {
            if (
                $quiz->status != 'expired'
                &&
                now()->gt($quiz->end_at)
            ) {
                $quiz->update([
                    'status' => 'expired'
                ]);
            }

            $quiz->alreadyAnswered =
                StudentAnswer::where(
                    'user_id',
                    auth()->id()
                )
                ->where(
                    'quiz_id',
                    $quiz->id
                )
                ->exists();
        }
        $isPurchased = QuizController::isPurchased($courseId);
        $isInstructor = QuizController::isInstructor();
        if ($isInstructor || $isPurchased) {
            return view(
                'quiz.quiz_all',
                compact('course', 'quizzes', 'isInstructor', 'isPurchased')
            );
        } else {
            abort(402, 'Please pucrhase course');
        }
    }
    public function show($quizId)
    {
        $quiz = Quiz::with('questions')
            ->where('id', $quizId)
            ->firstOrFail();


        $courseId = $quiz->course_id;

        $course = Course::findOrFail($courseId);

        if ($quiz->status != 'expired' && $quiz->end_at && now()->gt($quiz->end_at)) {
            $quiz->status = 'expired';
            $quiz->save();
        }

        $answers = StudentAnswer::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->get()
            ->keyBy('question_id');

        $alreadyAnswered = $answers->count() > 0;

        $score = $answers->where('is_correct', 1)->count();
        $isPurchased = QuizController::isPurchased($courseId);
        $isInstructor = QuizController::isInstructor();
        if ($isInstructor || $isPurchased) {
            return view('quiz.show', compact(
                'quiz',
                'answers',
                'alreadyAnswered',
                'score',
                'course',
                'isInstructor',
                'isPurchased',
            ));
        } else {
            abort(404, 'Please purchase course.');
        }
    }

    public function submit(Request $request, $quizId)   //studenr answer store
    {
        $quiz = Quiz::findOrFail($quizId);

        if ($quiz->status == 'expired' || now()->gt($quiz->end_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz expired'
            ]);
        }

        $exists = StudentAnswer::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Already submitted'
            ]);
        }

        $score = 0;

        foreach ($quiz->questions as $q) {
            $selected = $request->answers[$q->id] ?? null;
            $correct = $selected === $q->correct_answer;
            if ($correct) $score++;

            StudentAnswer::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'question_id' => $q->id,
                'answer' => $selected,
                'is_correct' => $correct
            ]);
        }

        return response()->json([
            'success' => true,
            'score' => $score
        ]);
    }
    public function isInstructor()
    {
        $isInstructor = false;
        if (auth()->check()) {
            $isInstructor = User::where('id', auth()->id())
                ->where('role', '2')
                ->exists();
        }
        if ($isInstructor) {
            return true;
        } else {
            return false;
        }
    }
    public function isPurchased($courseId)
    {
        $isPurchased = false;
        if (auth()->check()) {
            $isPurchased = CourseOrder::where([
                'user_id' => auth()->id(),
                'course_id' => $courseId,
                'status' => 'paid'
            ])->exists();
        }
        if ($isPurchased) {
            return true;
        } else {
            return false;
        }
    }

    public function learnerScores(Quiz $quiz) // each quis all learner score show
    {
        abort_if($quiz->course->instructor_id != auth()->id(), 403);

        // Quiz Total Marks
        $totalMarks = $quiz->questions()->sum('points');

        // Course ဝယ်ထားတဲ့ Learners
        $orders = CourseOrder::with('user')
            ->where('course_id', $quiz->course_id)
            ->where('status', 'paid')
            ->get();

        $result = [];

        foreach ($orders as $order) {

            $answers = StudentAnswer::where('quiz_id', $quiz->id)
                ->where('user_id', $order->user_id)
                ->get();

            $score = $answers->where('is_correct', 1)->count();


            $attempted = $answers->isNotEmpty();

            $result[] = [
                'id'         => $order->user->id,
                'name'       => $order->user->name,
                'email'      => $order->user->email,
                'order_no'   => $order->order_no,
                'paid_at'    => optional($order->paid_at)->format('d M Y'),
                'score'      => $score,
                'total'      => $totalMarks,
                'percentage' => $totalMarks > 0
                    ? round(($score / $totalMarks) * 100, 2)
                    : 0,
                'status'     => $attempted ? 'Completed' : 'Not Attempted',
            ];
        }

        return response()->json($result);
    }

    // Show edit page with existing quiz and questions
    public function edit($id)
    {
        $quiz = Quiz::with('questions.options', 'course')->findOrFail($id);
        $course = $quiz->course;
        return view('quiz.edit', compact('quiz', 'course'));
    }

    // Update quiz and questions/options in database
    public function update(Request $request, $id)
    {
        // 1. Find the Quiz
        $quiz = Quiz::findOrFail($id);

        // 2. Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'end_at' => 'required|date',
            'status' => 'required|in:draft,published,expired',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // 3. Update basic quiz info
            $quiz->update([
                'title' => $request->title,
                'end_at' => $request->end_at,
                'status' => $request->status,
            ]);

            $submittedQuestionIds = [];

            // 4. Process questions
            foreach ($request->questions as $position => $qData) {

                // Map 'multiple_choice' to 'mcq' if received from frontend
                $type = $qData['type'] ?? 'mcq';
                if ($type === 'multiple_choice') {
                    $type = 'mcq';
                }

                // Determine summary text for correct_answer column
                $correctAnswerText = null;
                if ($type === 'mcq') {
                    $correctIndex = $qData['correct_option'] ?? 0;
                    $correctAnswerText = $qData['options'][$correctIndex] ?? null;
                } elseif ($type === 'true_false') {
                    $correctAnswerText = $qData['tf_correct'] ?? 'True';
                } elseif ($type === 'fill_blank') {
                    $correctAnswerText = $qData['blank_answer'] ?? null;
                }

                // Create or update question (Guarantees $question variable is assigned)
                if (!empty($qData['id'])) {
                    $question = Question::findOrFail($qData['id']);
                    $question->update([
                        'question'       => $qData['question'],
                        'type'           => $type,
                        'position'       => $position + 1,
                        'correct_answer' => $correctAnswerText,
                    ]);
                } else {
                    $question = $quiz->questions()->create([
                        'question'       => $qData['question'],
                        'type'           => $type,
                        'position'       => $position + 1,
                        'correct_answer' => $correctAnswerText,
                    ]);
                }

                // Keep track of active question IDs
                $submittedQuestionIds[] = $question->id;

                // 5. Sync Options for this question
                $question->options()->delete();

                if ($type === 'mcq' && isset($qData['options'])) {
                    $selectedCorrectIndex = (int) ($qData['correct_option'] ?? 0);
                    foreach ($qData['options'] as $oIndex => $optionText) {
                        if (!empty($optionText)) {
                            $question->options()->create([
                                'option_text' => $optionText,
                                'is_correct'  => ($oIndex === $selectedCorrectIndex),
                            ]);
                        }
                    }
                } elseif ($type === 'true_false') {
                    $correctTf = $qData['tf_correct'] ?? 'True';
                    $question->options()->create([
                        'option_text' => 'True',
                        'is_correct'  => ($correctTf === 'True'),
                    ]);
                    $question->options()->create([
                        'option_text' => 'False',
                        'is_correct'  => ($correctTf === 'False'),
                    ]);
                } elseif ($type === 'fill_blank' && !empty($qData['blank_answer'])) {
                    $question->options()->create([
                        'option_text' => $qData['blank_answer'],
                        'is_correct'  => true,
                    ]);
                }
            }

            // 6. Delete questions removed in frontend UI
            $quiz->questions()->whereNotIn('id', $submittedQuestionIds)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quiz updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update quiz: ' . $e->getMessage(),
            ], 500);
        }
    }
}
