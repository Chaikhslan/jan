<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private function getQuestions($subjectId)
    {
        return Question::where('subject_id', $subjectId)->with('answers')->get();
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
                'exam_started_at' => now(),
            ]);
        }

        $currentQuestionIndex = session('current_question');

        if ($currentQuestionIndex >= $questions->count()) {
            $exam = Exam::create([
                'user_id' => auth()->id(),
                'started_at' => session('exam_started_at'),
                'finished_at' => now(),
                'score' => 0
            ]);

            $correct = 0;
            foreach ($questions as $question) {
                // Получаем текущий вопрос с его ответами
                $currentQuestion = Question::where('id', $question->id)
                    ->with('answers')
                    ->first();

                // Получаем правильные ответы для текущего вопроса
                $correctAnswers = $currentQuestion->answers
                    ->where('is_correct', true)
                    ->pluck('id')
                    ->map(fn($id) => (int) $id)
                    ->toArray();

                // Получаем ответы пользователя для текущего вопроса
                $sessionAnswers = collect(session('answers'));
                $userAnswerItem = $sessionAnswers->first(function ($item) use ($currentQuestion) {
                    return isset($item[$currentQuestion->id]);
                });
                $userAnswers = collect($userAnswerItem[$currentQuestion->id] ?? [])
                    ->map(fn($id) => (int) $id)
                    ->toArray();

                \Log::info('Question ID: ' . $currentQuestion->id);
                \Log::info('Correct answers: ' . implode(', ', $correctAnswers));
                \Log::info('User answers: ' . implode(', ', $userAnswers));
                \Log::info('Session answers: ', session('answers'));

                // Сравниваем ответы
                $isCorrect = (
                    count($correctAnswers) === count($userAnswers) &&
                    empty(array_diff($correctAnswers, $userAnswers)) &&
                    empty(array_diff($userAnswers, $correctAnswers))
                );

                \Log::info('Is correct: ' . ($isCorrect ? 'true' : 'false'));

                if ($isCorrect) {
                    $correct++;
                }

                foreach ($userAnswers as $answerId) {
                    Result::create([
                        'user_id' => auth()->id(),
                        'exam_id' => $exam->id,
                        'question_id' => $currentQuestion->id,
                        'answer_id' => $answerId,
                        'is_correct' => in_array($answerId, $correctAnswers, true),
                    ]);
                }
            }

            $exam->update(['score' => $correct]);

            $total = $questions->count();
            $percentage = round(($correct / $total) * 100);

            session()->forget(['current_question', 'answers', 'exam_started_at']);

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

        $answers = session('answers');
        $answers[$questionId] = $request->input('answers', []);
        session(['answers' => $answers]);

        if ($request->input('action') === 'next') {
            session(['current_question' => $currentQuestionIndex + 1]);
        } elseif ($request->input('action') === 'prev' && $currentQuestionIndex > 0) {
            session(['current_question' => $currentQuestionIndex - 1]);
        }

        return redirect()->route('question.index', ['subject_id' => $subjectId]);
    }

    public function reset(Request $request)
    {
        session()->forget(['current_question', 'answers', 'exam_started_at']);
        return redirect()->route('question.index', ['subject_id' => $request->input('subject_id')]);
    }
}

