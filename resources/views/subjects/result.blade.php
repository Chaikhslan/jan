@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Результаты теста</h3>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="display-4">{{ $score }} / {{ $total }}</h1>
                        <h3>{{ $percentage }}%</h3>

                        <p class="mt-4">
                            @if($percentage >= 70)
                                Отлично! Вы успешно прошли тест.
                            @else
                                Попробуйте еще раз для улучшения результата.
                            @endif
                        </p>

                        <form action="{{ route('test.reset') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary">Пройти тест заново</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

