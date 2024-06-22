<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @student
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                    <div class="p-6 text-gray-900">
                        <x-input-label for="code" value="Code de l'évaluation" />
                        <form action="{{ route('exams.show-with-code') }}" method="post" class="flex items-center justify-between">
                            @csrf

                            <div class="w-3/4">
                                <x-text-input id="code" class="block w-full mt-1" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>

                            <x-primary-button>Accéder à l'évaluation</x-primary-button>
                        </form>
                    </div>
                </div>

            @endstudent

        </div>
    </div>
</x-app-layout>
