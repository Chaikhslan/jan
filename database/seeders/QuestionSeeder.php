<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Ертегілерді мазмұны жағынан үш топқа бөліп қарастырған ғалым',
                'level_question' => 1,
                'topic_question' => 'Фреймворки',
                'subject' => 'Әдебиет',
                'answers' => [
                    ['answer' => 'С. Мұқанов', 'is_correct' => false],
                    ['answer' => 'Ш. Уәлиханов', 'is_correct' => false],
                    ['answer' => 'З. Қабдолов', 'is_correct' => true], // ✅ Правильный ответ
                    ['answer' => 'М. Әуезов', 'is_correct' => false],
                    ['answer' => 'А. Байтұрсынұлы', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'Что такое Blade в Laravel?',
                'level_question' => 2,
                'topic_question' => 'Laravel',
                'subject' => 'Шаблонизаторы',
                'answers' => [
                    ['answer' => 'CSS-фреймворк', 'is_correct' => false],
                    ['answer' => 'Система миграций', 'is_correct' => false],
                    ['answer' => 'Шаблонизатор', 'is_correct' => true], // ✅ Правильный ответ
                    ['answer' => 'База данных', 'is_correct' => false],
                ]
            ],
        ];

        foreach ($questions as $item) {
            // Создаем вопрос
            $question = Question::create([
                'question' => $item['question'],
                'level_question' => $item['level_question'],
                'topic_question' => $item['topic_question'],
                'subject' => $item['subject']
            ]);

            // Добавляем ответы
            foreach ($item['answers'] as $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct']
                ]);
            }
        }
    }
}
