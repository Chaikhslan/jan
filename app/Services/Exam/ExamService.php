<?php

namespace App\Services\Exam;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;

class ExamService implements ExamServiceInterface
{
    public function processExamResults(array $questions)
    {
        $exam = Exam::create([
            'user_id' => auth()->id(),
            'started_at' => session('exam_started_at'),
            'finished_at' => now(),
            'score' => 0
        ]);

        $correct = $this->calculateScore($questions);
        $exam->update(['score' => $correct]);

        $total = count($questions);
        $percentage = round(($correct / $total) * 100);

        return [
            'score' => $correct,
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    public function calculateScore(array $questions)
    {
        $correct = 0;

        foreach ($questions as $question) {
            $currentQuestion = Question::where('id', $question->id)
                ->with('answers')
                ->first();

            $correctAnswers = $currentQuestion->answers
                ->where('is_correct', true)
                ->pluck('id')
                ->map(fn($id) => (int) $id)
                ->toArray();

            $sessionAnswers = collect(session('answers'));
            $userAnswerItem = $sessionAnswers->first(function ($item) use ($currentQuestion) {
                return isset($item[$currentQuestion->id]);
            });
            $userAnswers = collect($userAnswerItem[$currentQuestion->id] ?? [])
                ->map(fn($id) => (int) $id)
                ->toArray();

            $isCorrect = $this->checkAnswers($correctAnswers, $userAnswers);

            if ($isCorrect) {
                $correct++;
            }

            $this->saveExamResults($currentQuestion->exam, $currentQuestion, $userAnswers, $correctAnswers);
        }

        return $correct;
    }

    public function saveExamResults($exam, $question, array $userAnswers, array $correctAnswers)
    {
        foreach ($userAnswers as $answerId) {
            Result::create([
                'user_id' => auth()->id(),
                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'answer_id' => $answerId,
                'is_correct' => in_array($answerId, $correctAnswers, true),
            ]);
        }
    }

    private function checkAnswers(array $correctAnswers, array $userAnswers): bool
    {
        return (
            count($correctAnswers) === count($userAnswers) &&
            empty(array_diff($correctAnswers, $userAnswers)) &&
            empty(array_diff($userAnswers, $correctAnswers))
        );
    }
} 