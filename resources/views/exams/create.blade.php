<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Exam
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('exams.store') }}" method="post">
                @csrf

                <div>
                    <x-input-label for="course_name" :value="__('Course name')" />
                    <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="old('course_name')" required autofocus autocomplete="course_name" />
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="duration" :value="__('Duration')" />
                    <x-text-input id="duration" class="block mt-1 w-full" type="number" min="0" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea-input id="description" class="block mt-1 w-full" name="description" :value="old('description')" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>