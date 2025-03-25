<?php

namespace App\Console\Commands;

use App\Service\QuestionService;
use Illuminate\Console\Command;

class CreateQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        parent::__construct();
        $this->questionService = $questionService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->questionService->getQuestion();
    }
}
