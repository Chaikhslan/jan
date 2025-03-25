<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Пәнді таңдаңыз') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <div class="p-4 border rounded-lg bg-gray-100">
                        <a href="{{ route('question.index', ['subject_id' => 1]) }}" class="text-blue-500 hover:underline">
                            Қазақ тілі тест
                        </a>
                    </div>
                    <div class="p-4 border rounded-lg bg-gray-100">
                        <a href="https://youtu.be/xbGHRGrXnHg?si=UKRgPxOzcitpQRmp" class="text-blue-500 hover:underline">
                            Әдебиет тест
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
