<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit question {{ $question->content }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded shadow-lg p-6">
                <form action="{{ route('questions.update', $question) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex justify-between mb-3">
                        <div class="w-full mr-3">
                            <x-input-label for="content" :value="__('Contenu de la question')" />
                            <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $question->content)" required autofocus autocomplete="content" />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="points" :value="__('Points')" />
                            <x-text-input id="points" class="block mt-1 w-full" type="text" name="points" :value="old('points', $question->points)" required autofocus autocomplete="content" />
                            <x-input-error :messages="$errors->get('points')" class="mt-2" />
                        </div>
                    </div>

                    <x-primary-button>
                        Enregistrer
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>