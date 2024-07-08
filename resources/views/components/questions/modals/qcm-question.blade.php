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

        <div class="mt-6 hidden" id="assertionsContainer">
            <x-input-label value="{{ __('Assertions') }}" />

            <ul id="assertions" class="mt-1">
                
            </ul>
        </div>

        <div class="mt-6 flex justify-between">
            
            <x-secondary-button type="button" id="addAssertion" class="hidden">
                {{ __('Ajouter une assertion') }}
            </x-secondary-button>

            <x-primary-button class="hidden mx-4" id="createQCM-Button">
                {{ __('Ajouter la question') }}
            </x-primary-button>

            <x-danger-button type="button" onclick="window.add_qcm_question.close();">
                {{ __('Annuler') }}
            </x-danger-button>

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
        assertionInput.setAttribute('placeholder', 'Contenu de l\'assertion');
        assertionInput.setAttribute('class', 'w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm');

        li.appendChild(assertionInput)

        assertions.appendChild(li)
    });


    const contentQCM = document.getElementById('contentQCM')

    contentQCM.addEventListener('keyup', function()
    {
        if (contentQCM.value.length > 5) {
            document.getElementById('assertionsContainer').classList.remove('hidden')
            addAssertion.classList.remove('hidden')
        } else {
            addAssertion.classList.add('hidden')
            document.getElementById('createQCM-Button').classList.add('hidden');
        }
    })

    addAssertion.addEventListener('click', function(){
        document.getElementById('createQCM-Button').classList.remove('hidden');
    })
</script>