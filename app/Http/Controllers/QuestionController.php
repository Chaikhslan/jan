<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private function getQuestions($subjectId)
    {
        return Question::where('subject_id', $subjectId)->with('answer')->get();
    }

    public function index($subjectId)
    {
        $questions = $this->getQuestions($subjectId);

        if ($questions->isEmpty()) {
            return redirect()->route('home')->with('error', 'Тестовые вопросы не найдены.');
        }

        if (!session()->has('current_question')) {
            session([
                'current_question' => 0,
                'answers' => [],
                'show_results' => false
            ]);
        }

        $currentQuestionIndex = session('current_question');

        if ($currentQuestionIndex >= $questions->count()) {
            $correct = 0;
            foreach ($questions as $question) {
                $correctAnswers = $question->answer->where('is_correct', true)->pluck('id')->toArray();
                $userAnswers = session('answers')[$question->id] ?? [];
                $userAnswers = array_map('intval', $userAnswers);

                sort($correctAnswers);
                sort($userAnswers);

                if ($correctAnswers === $userAnswers) {
                    $correct++;
                }
            }

            $total = $questions->count();
            $percentage = round(($correct / $total) * 100);

            return view('subjects.result', [
                'score' => $correct,
                'total' => $total,
                'percentage' => $percentage,
                'subject_id' => $subjectId
            ]);
        }

        return view('subjects.question', [
            'question' => $questions[$currentQuestionIndex],
            'questionNumber' => $currentQuestionIndex + 1,
            'totalQuestions' => $questions->count(),
            'selectedAnswers' => session('answers')[$questions[$currentQuestionIndex]->id] ?? [],
            'subject_id' => $subjectId,
        ]);
    }

    public function submitAnswer(Request $request, $subjectId)
    {
        $questions = $this->getQuestions($subjectId);

        $currentQuestionIndex = session('current_question');
        $questionId = $questions[$currentQuestionIndex]->id;

        // Сохраняем ответ
        $answers = session('answers');
        $answers[$questionId] = $request->input('answers', []);
        session(['answers' => $answers]);

        // Действие (следующий/предыдущий)
        if ($request->input('action') === 'next') {
            session(['current_question' => $currentQuestionIndex + 1]);
        } elseif ($request->input('action') === 'prev' && $currentQuestionIndex > 0) {
            session(['current_question' => $currentQuestionIndex - 1]);
        }

        return redirect()->route('question.index', ['subject_id' => $subjectId]);
    }

    public function reset(Request $request)
    {
        session()->forget(['current_question', 'answers', 'show_results']);

        return redirect()->route('question.index', ['subject_id' => $request->input('subject_id')]);
    }
}

