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
                    
                    <div class="mb-3">
                        <x-input-label for="content" :value="__('Question content')" />
                        <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $question->content)" required autofocus autocomplete="content" />
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        Save
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>