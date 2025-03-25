<?php

use App\Http\Controllers\AcademicPerformanceController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/academic_performance', [AcademicPerformanceController::class, 'show'])->name('academic_performance.show');
    Route::get('/question_page', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/question', [SubjectController::class, 'show'])->name('subject.show');
    Route::get('/question/index/{subject_id}', [QuestionController::class, 'index'])->name('question.index');
    Route::post('/question/submit', [QuestionController::class, 'submitAnswer'])->name('question.submit');
    Route::get('/question/results', [QuestionController::class, 'showResults'])->name('question.results');
    Route::post('/question/reset', [QuestionController::class, 'reset'])->name('question.reset');
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
});

require __DIR__.'/auth.php';
