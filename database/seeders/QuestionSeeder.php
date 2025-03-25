<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $questions = [
            [
                'question' => 'Көмекші сөз',
                'level_question' => 1,
                'topic_id' => 1,
                'subject_id' => 1,
                'grade_id' => 5,
                'answers' => [
                    ['answer' => 'ойын', 'is_correct' => false],
                    ['answer' => 'бүгін', 'is_correct' => false],
                    ['answer' => 'алма', 'is_correct' => false],
                    ['answer' => 'ертең', 'is_correct' => false],
                    ['answer' => 'жазда', 'is_correct' => true],
                ]
            ],
            [
                'question' => 'Көмекші есім қатысқан сөйлем',
                'level_question' => 1,
                'topic_id' => 1,
                'subject_id' => 1,
                'grade_id' => 5,
                'answers' => [
                    ['answer' => 'Далада жаңбыр жауып тұр.', 'is_correct' => false],
                    ['answer' => 'Үйдің іші адамға лық толды.', 'is_correct' => true],
                    ['answer' => 'Табиғатты тамашалауға келдік.', 'is_correct' => false],
                    ['answer' => 'Қылыштың жүзі жарқ етті.', 'is_correct' => false],
                    ['answer' => 'Еркебұлан күліп жібере жаздады.', 'is_correct' => false],
                ]
            ],
        ];

        $questionsData = collect($questions)->map(function ($item) use ($now) {
            return [
                'question' => $item['question'],
                'level_question' => $item['level_question'],
                'topic_id' => $item['topic_id'],
                'subject_id' => $item['subject_id'],
                'grade_id' => $item['grade_id'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::table('questions')->insert($questionsData);

        $insertedQuestions = DB::table('questions')
            ->whereIn('question', collect($questions)->pluck('question'))
            ->get()
            ->keyBy('question');

        $answersData = [];

        foreach ($questions as $item) {
            $questionId = $insertedQuestions[$item['question']]->id;

            foreach ($item['answers'] as $answer) {
                $answersData[] = [
                    'question_id' => $questionId,
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('answers')->insert($answersData);
    }
}
