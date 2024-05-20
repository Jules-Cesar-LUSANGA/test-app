@props(['exam'])

<x-modal name="add_qcm_question" focusable>
    <form method="post" action="{{ route('questions.storeQcm', $exam) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create a qcm question') }}
        </h2>

        <div class="mt-6">
            <x-input-label for="contentQCM" value="{{ __('Question') }}" />

            <x-text-input
                id="contentQCM"
                name="content"
                type="text"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Question') }}"
            />

            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="mt-6">
            <h4>Assertions</h4>

            <ul id="assertions">
                
            </ul>
        </div>

        <div class="mt-6 flex justify-end">
            
            <x-primary-button class="ms-3 hidden" type="button" id="addAssertion">
                {{ __('Add assertion') }}
            </x-primary-button>

            <x-primary-button class="ms-3 hidden" id="createQCM-Button">
                {{ __('Create') }}
            </x-primary-button>

            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

        </div>
    </form>
</x-modal>