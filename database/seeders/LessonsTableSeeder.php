<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $lessons = [
            ['title' => 'Қазақ тілі 1 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/GGnXqIe74v4?si=ULqmdctpK60HW4Qi'],
            ['title' => 'Әдебиет 1 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/xbGHRGrXnHg?si=UKRgPxOzcitpQRmp'],
            ['title' => 'Қазақ тілі 2 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/3x4GzrfcQBY?si=uDeJ6yS8CqxHFCsl'],
            ['title' => 'Әдебиет 2 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/jMPyko3ByR0?si=g7XXnC7qdR4TTpxH'],
            ['title' => 'Қазақ тілі 3 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/1eXBzxtbPII?si=Qv_Y5nObecGjKjr3'],
            ['title' => 'Әдебиет 3 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/_Hz4dSqd15w?si=RURj0uJTuYgOZUgx'],
            ['title' => 'Қазақ тілі 4 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/jm5bAjiYF9g?si=3_9rFAr6gCEYrYs9'],
            ['title' => 'Әдебиет 4 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/0qg4A2msvLY?si=F2H4xWykTGF-r2zr'],
            ['title' => 'Қазақ тілі 5 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/W6fg6CjCxpQ?si=wqegSbTZ1zlCrNMx'],
            ['title' => 'Әдебиет 5 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/DR6b3ARvTiU?si=x9brEk1KalCKzlr8'],
            ['title' => 'Қазақ тілі 6 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/gHQOsUx1pak?si=ZzrbE6Jd0JXT8X5I'],
            ['title' => 'Әдебиет 6 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/YMAH3WOxhjk?si=gJdOLmY_SuzDumPe'],
            ['title' => 'Қазақ тілі 7 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/KnBLBGdaFvU?si=pkCsjHVe5w-lKBwg'],
            ['title' => 'Әдебиет 7 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/JmQaTbk5EiA?si=0e4G-ffi0kOrutME'],
            ['title' => 'Қазақ тілі 8 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/GGjEyjbOuYs?si=tbeHI7ohzQ_G2L5Q'],
            ['title' => 'Әдебиет 8 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/GGjEyjbOuYs?si=mIbZoCXyucwGhZ6Q'],
            ['title' => 'Қазақ тілі 9 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://www.youtube.com/watch?v=mQf1qBsfA_g'],
            ['title' => 'Әдебиет 9 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://www.youtube.com/watch?v=0VHq_73VMHk'],
            ['title' => 'Қазақ тілі 10 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/qu5ibPMAZ5s?si=18vmGIjtL0-Dj_zK'],
            ['title' => 'Әдебиет 10 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/ot7T_o5XU_Q?si=GG82X_ohqNeq8Xc9'],
            ['title' => 'Қазақ тілі 11 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/m7wb6yG0PXw?si=foIovEHMn0FnMXE3'],
            ['title' => 'Әдебиет 11 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/VpwIjEf7Qi4?si=3MnAKxmpSbg0WOmy'],
            ['title' => 'Қазақ тілі 12 сабақ', 'subject_id' => 1, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/j12HYyfBpcI?si=aEYhDVVUAZDz6LxU'],
            ['title' => 'Әдебиет 12 сабақ', 'subject_id' => 2, 'topic_id' => 1, 'grade_id' => 5, 'url' => 'https://youtu.be/lhhXHEGnom4?si=aJQFkSD9uZut9HI4'],
        ];

        foreach ($lessons as $lesson) {
            DB::table('lessons')->insert(array_merge($lesson, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]));
        }
    }
}
