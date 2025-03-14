<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Тест нәтижелері
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Тест тапсырушы</h3>
                <p><strong>ФИО:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Орташа балл:</strong> {{ $averageScore }}%</p>
            </div>
        </div>
    </div>
</x-app-layout>
