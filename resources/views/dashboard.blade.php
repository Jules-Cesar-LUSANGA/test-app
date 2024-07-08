<x-app-layout pageTitle="Dashboard">
    <div>
        @student
            
            <div>
               <form action="{{ route('exams.show-with-code') }}" method="post" class="bg-white p-3 rounded-md shadow-md flsex items-center">
                    @csrf
                    <x-input-label for="code" class="block mb-3" value="Code de l'évaluation" />
                    <div class="flex items-center">
                        <x-text-input id="code" type="text" name="code"  value="{{ old('code') }}"  autofocus required/>
                        <x-primary-button class="ml-3">Accéder</x-primary-button>
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />

                    
                </form>
            </div>

        @else
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad porro aperiam cupiditate saepe ipsum corporis, quam, eum consectetur, nihil natus ab sint hic aut totam laborum quidem tenetur deleniti doloribus?
            Inventore itaque odio reiciendis? Sint nesciunt possimus cum iusto exercitationem, id dolore quasi totam. Deserunt qui dolorem aperiam possimus facere id et officia quo, velit, voluptatum unde ipsa illo molestias.
            Aut autem voluptatum quas exercitationem, rem minima tempore suscipit alias odit blanditiis, fugiat magnam cupiditate odio commodi saepe dolorum repudiandae voluptas tempora. Exercitationem repellendus, illum temporibus fugit atque illo officia.
        @endstudent

    </div>
</x-app-layout>
