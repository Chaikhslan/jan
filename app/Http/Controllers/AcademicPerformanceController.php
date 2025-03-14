<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class AcademicPerformanceController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $userResults = Result::where('user_id', $user->id)
            ->whereNotNull('answer_id')
            ->selectRaw('
        COUNT(*) as total_answers,
        COUNT(CASE WHEN is_correct = TRUE THEN 1 END) as correct_answers
                        ')
            ->first();

        $totalAnswers = $userResults->total_answers ?? 0;
        $correctAnswers = $userResults->correct_answers ?? 0;

        // Проверяем, чтобы не делить на 0
        $averageScore = $totalAnswers > 0
            ? round(($correctAnswers * 100.0) / $totalAnswers, 2)
            : 0;


        return view('profile.data.result', [
            'averageScore' => $averageScore,
            'user' => $user
        ]);
    }
}
