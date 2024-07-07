<x-app-layout pageTitle="Dashboard">
    <div>
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
        @else
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad porro aperiam cupiditate saepe ipsum corporis, quam, eum consectetur, nihil natus ab sint hic aut totam laborum quidem tenetur deleniti doloribus?
            Inventore itaque odio reiciendis? Sint nesciunt possimus cum iusto exercitationem, id dolore quasi totam. Deserunt qui dolorem aperiam possimus facere id et officia quo, velit, voluptatum unde ipsa illo molestias.
            Aut autem voluptatum quas exercitationem, rem minima tempore suscipit alias odit blanditiis, fugiat magnam cupiditate odio commodi saepe dolorum repudiandae voluptas tempora. Exercitationem repellendus, illum temporibus fugit atque illo officia.
        @endstudent

    </div>
</x-app-layout>
