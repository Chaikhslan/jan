<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $testQuestions = [
        [
            'id' => 1,
            'question' => 'Какие из следующих языков являются языками программирования?',
            'options' => [
                ['id' => 'a', 'text' => 'HTML'],
                ['id' => 'b', 'text' => 'JavaScript'],
                ['id' => 'c', 'text' => 'CSS'],
                ['id' => 'd', 'text' => 'Python'],
            ],
            'correctAnswers' => ['b', 'd'],
        ],
        [
            'id' => 2,
            'question' => 'Какие из следующих фреймворков используются для разработки веб-приложений?',
            'options' => [
                ['id' => 'a', 'text' => 'React'],
                ['id' => 'b', 'text' => 'Angular'],
                ['id' => 'c', 'text' => 'Vue'],
                ['id' => 'd', 'text' => 'Excel'],
            ],
            'correctAnswers' => ['a', 'b', 'c'],
        ],
        [
            'id' => 3,
            'question' => 'Какие из следующих являются методами HTTP?',
            'options' => [
                ['id' => 'a', 'text' => 'GET'],
                ['id' => 'b', 'text' => 'POST'],
                ['id' => 'c', 'text' => 'DELETE'],
                ['id' => 'd', 'text' => 'SEND'],
            ],
            'correctAnswers' => ['a', 'b', 'c'],
        ],
    ];

    public function index($subject_id)
    {
        $testQuestions = Question::where('subject_id', $subject_id)
            ->with('answer')
            ->get();

        if ($testQuestions->isEmpty()) {
            return redirect()->route('home')->with('error', 'Тестовые вопросы не найдены.');
        }

        if (!session()->has('test_answers')) {
            session([
                'test_answers' => array_fill_keys($testQuestions->pluck('id')->toArray(), []),
                'current_question' => 1,
                'show_results' => false
            ]);
        }

        $currentQuestionIndex = session('current_question') - 1;
        $currentQuestion = $testQuestions[$currentQuestionIndex] ?? null;

        // Если индекс вышел за границы массива — сбрасываем тест
        if (!$currentQuestion) {
            session()->forget(['test_answers', 'current_question', 'show_results']);
            return redirect()->route('question.index', ['subject_id' => $subject_id])
                ->with('error', 'Тест завершен или вопросы не найдены.');
        }

        // Получаем сохраненные ответы из сессии
        $selectedAnswers = session('test_answers');

        return view('subjects.question', [
            'question' => $currentQuestion,
            'questionNumber' => session('current_question'),
            'totalQuestions' => count($testQuestions),
            'selectedAnswers' => $selectedAnswers[$currentQuestion->id] ?? [],
            'showResults' => session('show_results', false)
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $action = $request->input('action');
        $questionId = $request->input('question_id');
        $answers = $request->input('answers', []);

        // Update answers for current question
        $testAnswers = session('test_answers');
        $testAnswers[$questionId] = $answers;
        session(['test_answers' => $testAnswers]);

        $currentQuestion = session('current_question');

        if ($action === 'next') {
            if ($currentQuestion < count($this->testQuestions)) {
                session(['current_question' => $currentQuestion + 1]);
            } else {
                session(['show_results' => true]);
            }
        } elseif ($action === 'prev' && $currentQuestion > 1) {
            session(['current_question' => $currentQuestion - 1]);
        }

//        dd($request);
        return redirect()->route('question.index', ['subject_id' => $request->input('subject_id')]);
    }

    public function showResults()
    {
        $testAnswers = session('test_answers');
        $score = 0;

        foreach ($this->testQuestions as $question) {
            $userAnswers = $testAnswers[$question['id']] ?? [];
            $correctAnswers = $question['correctAnswers'];

            // Check if arrays have the same elements (regardless of order)
            $isCorrect = count($userAnswers) === count($correctAnswers) &&
                empty(array_diff($userAnswers, $correctAnswers)) &&
                empty(array_diff($correctAnswers, $userAnswers));

            if ($isCorrect) {
                $score++;
            }
        }

        $percentage = round(($score / count($this->testQuestions)) * 100);

        return view('test-results', [
            'score' => $score,
            'total' => count($this->testQuestions),
            'percentage' => $percentage
        ]);
    }

    public function reset(Request $request)
    {
        session()->forget(['test_answers', 'current_question', 'show_results']);
        return redirect()->route('question.index', ['subject_id' => $request->input('subject_id')]);
    }
}

