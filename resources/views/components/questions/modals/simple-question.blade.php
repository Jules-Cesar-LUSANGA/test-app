@props(['exam'])

<x-modal name="add_question" focusable>
    <form method="post" action="{{ route('questions.store', $exam) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create a simple question') }}
        </h2>

        <div class="mt-6">
            <x-input-label for="content" value="{{ __('Question') }}" />

            <x-text-input
                id="content"
                name="content"
                type="text"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Question') }}"
            />

            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>