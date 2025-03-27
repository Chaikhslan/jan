<?php

namespace App\Services\Exam;

interface ExamServiceInterface
{
    public function processExamResults(array $questions);
    public function calculateScore(array $questions);
    public function saveExamResults($exam, $question, array $userAnswers, array $correctAnswers);
} 