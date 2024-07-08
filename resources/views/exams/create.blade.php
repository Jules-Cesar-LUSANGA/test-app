<x-app-layout pageTitle="Créer une évaluation">
    
    <div class="flex justify-center">
        <form action="{{ route('exams.store') }}" method="post" class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @csrf
            <div>
                <x-input-label for="course_name" :value="__('Titre')" />
                <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="old('course_name')" required autofocus autocomplete="course_name" />
                <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
            </div>
            <div class="flex mt-4">
                <div class="w-full mr-2">
                    <x-input-label for="attempts" :value="__('Tentatives')" />
                    <x-text-input id="attempts" class="block mt-1 w-full" type="number" name="attempts" :value="old('attempts', 1)" min="1" required autofocus autocomplete="attempts" />
                    <x-input-error :messages="$errors->get('attempts')" class="mt-2" />
                </div>
                <div class="w-full ml-2">
                    <x-input-label for="duration" :value="__('Durée')" />
                    <x-text-input id="duration" class="block mt-1 w-full" type="number" min="0" name="duration" :value="old('duration')" min="1" required autofocus autocomplete="duration" />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea-input id="description" class="block mt-1 w-full" name="description" :value="old('description')" required autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Enregistrer') }}
                </x-primary-button>

                <x-danger-link class="ms-3" href="{{ route('exams.index') }}">
                    {{ __('Annuler') }}
                </x-danger-link>
            </div>
        </form>
    </div>
    
</x-app-layout>