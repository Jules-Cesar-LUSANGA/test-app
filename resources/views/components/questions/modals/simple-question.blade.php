@props(['exam'])

<x-modal name="add_question" focusable>
    <form method="post" action="{{ route('questions.store', $exam) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Ajouter une question simple') }}
        </h2>

        <div class="mt-3 grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="content" value="{{ __('Question') }}" />
                <x-text-input
                    id="content"
                    name="content"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Question') }}"
                />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="points" value="{{ __('Points') }}" />
                <x-text-input
                    id="points"
                    name="points"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Points ex. : 2.5') }}"
                />
                <x-input-error :messages="$errors->get('points')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                {{ __('Ajouter') }}
            </x-primary-button>
            
            <x-danger-button class="ms-3" type="button" onclick="window.add_question.close();">
                {{ __('Annuler') }}
            </x-danger-button>            
        </div>
    </form>
</x-modal>