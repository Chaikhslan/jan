<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $score }} / {{ $total }}
                    </h1>
                    <h3 class="text-2xl mt-2 text-gray-600 dark:text-gray-300">
                        {{ $percentage }}%
                    </h3>

                    <p class="mt-4 text-lg">
                        @if($percentage >= 70)
                            Отлично! Вы успешно прошли тест.
                        @else
                            Попробуйте еще раз для улучшения результата.
                        @endif
                    </p>

                    <form action="{{ route('question.reset') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                        <button type="submit"
                                class="px-4 py-2 rounded bg-indigo-500 text-black hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-500">
                            Пройти тест заново
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
