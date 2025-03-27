<?php

namespace App\Providers;

use App\Service\QuestionService;
use App\Services\Exam\ExamService;
use App\Services\Exam\ExamServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionService::class);
        $this->app->bind(ExamServiceInterface::class, ExamService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
