<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Внешний ключ на пользователя
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Внешний ключ на вопрос
            $table->foreignId('answer_id')->nullable()->constrained()->onDelete('cascade'); // Внешний ключ на ответ (может быть NULL)
            $table->boolean('is_correct')->default(false); // Верность ответа
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
