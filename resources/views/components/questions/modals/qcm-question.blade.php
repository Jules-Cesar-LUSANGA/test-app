@props(['exam'])

<x-modal name="add_qcm_question" focusable>
    <form method="post" action="{{ route('questions.storeQcm', $exam) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ajouter une question à choix multiples') }}
        </h2>

        <div class="mt-6 grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="contentQCM" value="{{ __('Question') }}" />
                <x-text-input
                    id="contentQCM"
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

        <div class="mt-6">
            <h4>Assertions</h4>

            <ul id="assertions">
                
            </ul>
        </div>

        <div class="mt-6 flex justify-end">
            
            <x-primary-button class="ms-3 hidden" type="button" id="addAssertion">
                {{ __('Ajouter une assertion') }}
            </x-primary-button>

            <x-primary-button class="ms-3 hidden" id="createQCM-Button">
                {{ __('Ajouter la question') }}
            </x-primary-button>

            <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                {{ __('Annuler') }}
            </x-secondary-button>

        </div>
    </form>
</x-modal>

<script>
    const addAssertion = document.getElementById("addAssertion")
    const assertions = document.getElementById('assertions')

    addAssertion.addEventListener('click', function(){
        const li = document.createElement('li');
        li.setAttribute('class', 'mb-3 flex justify-between items-center')

        const assertionInput = document.createElement('input');

        assertionInput.setAttribute('name', 'assertions[]');
        assertionInput.setAttribute('type', 'text');
        assertionInput.setAttribute('placeholder', 'Type assertion content');
        assertionInput.setAttribute('class', 'w-full rounded');

        li.appendChild(assertionInput)

        assertions.appendChild(li)
    });


    const contentQCM = document.getElementById('contentQCM')

    contentQCM.addEventListener('keyup', function()
    {
        if (contentQCM.value.length > 5) {
            addAssertion.classList.remove('hidden')
            document.getElementById('createQCM-Button').classList.remove('hidden');
        } else {
            addAssertion.classList.add('hidden')
            document.getElementById('createQCM-Button').classList.add('hidden');
        }
    })
</script>