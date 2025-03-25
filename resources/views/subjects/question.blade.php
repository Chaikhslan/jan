<!-- resources/views/quiz.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('show_results'))
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Результаты теста</h3>
                    </div>
                    <div class="card-body text-center">
                        @php
                            $testAnswers = session('test_answers');
                            $score = 0;
                            $totalQuestions = count($testQuestions ?? []);

                            foreach ($testQuestions ?? [] as $question) {
                                $userAnswers = $testAnswers[$question['id']] ?? [];
                                $correctAnswers = $question['correctAnswers'];

                                $isCorrect = count($userAnswers) === count($correctAnswers) &&
                                             empty(array_diff($userAnswers, $correctAnswers)) &&
                                             empty(array_diff($correctAnswers, $userAnswers));

                                if ($isCorrect) {
                                    $score++;
                                }
                            }

                            $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;
                        @endphp

                        <h1 class="display-4">{{ $score }} / {{ $totalQuestions }}</h1>
                        <h3>{{ $percentage }}%</h3>

                        <p class="mt-4">
                            @if($percentage >= 70)
                                Отлично! Вы успешно прошли тест.
                            @else
                                Попробуйте еще раз для улучшения результата.
                            @endif
                        </p>

                        <form action="{{ route('question.reset') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary">Пройти тест заново</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Вопрос {{ $questionNumber }} из {{ $totalQuestions }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('question.submit', ['subject_id' => $subject_id]) }}" method="POST">
                        @csrf
                            <input type="hidden" name="question_id" value="{{ $question['id'] }}">

                            <div class="text-center mb-4">
                                <h4>{{ $question['question'] }}</h4>
                            </div>

                            <div class="options">
                                @foreach($question->answer as $option)
                                    <div class="form-check border rounded p-3 mb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="answers[{{ $question->id }}][]"
                                            id="option-{{ $option->id }}"
                                            value="{{ $option->id }}"
                                            {{ in_array($option->id, $selectedAnswers ?? []) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label w-100" for="option-{{ $option->id }}">
                                            {{ $option->answer }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button
                                    type="submit"
                                    name="action"
                                    value="prev"
                                    class="btn btn-outline-secondary"
                                    {{ $questionNumber <= 1 ? 'disabled' : '' }}
                                >
                                    <i class="fas fa-arrow-left"></i> Предыдущий
                                </button>

                                <button type="submit" name="action" value="next" class="btn btn-primary">
                                    @if($questionNumber < $totalQuestions)
                                        Следующий <i class="fas fa-arrow-right"></i>
                                    @else
                                        Завершить тест
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
