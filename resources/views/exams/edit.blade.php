<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier : {{ $exam->course_name }}
        </h2>
    </x-slot>

    {{-- Edit exam --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="course_name" class="block text-gray-700 text-sm font-bold mb-2">Titre : </label>
                            <input type="text" name="course_name" id="course_name" value="{{ $exam->course_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="attempts" class="block text-gray-700 text-sm font-bold mb-2">Tentatives : </label>
                            <input type="number" name="attempts" id="attempts" value="{{ $exam->attempts }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">Durée : </label>
                            <input type="number" name="duration" id="duration" value="{{ $exam->duration }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $exam->description }}</textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <x-primary-button>Modifier</x-primary-button>
                            <a href="{{ route('exams.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>