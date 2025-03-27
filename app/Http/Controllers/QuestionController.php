<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\Exam\ExamServiceInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $examService;

    public function __construct(ExamServiceInterface $examService)
    {
        $this->examService = $examService;
    }

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
            $result = $this->examService->processExamResults($questions->toArray());
            
            session()->forget(['current_question', 'answers', 'exam_started_at']);

            return view('subjects.result', array_merge($result, ['subject_id' => $subjectId]));
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

