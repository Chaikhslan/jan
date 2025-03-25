<?php

namespace App\Service;

use App\Models\Question;

class QuestionService
{
    public function getQuestion()
    {
        $question = Question::all();

        dd($question);
    }
}
