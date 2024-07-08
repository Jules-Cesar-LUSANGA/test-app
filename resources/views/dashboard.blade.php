<x-app-layout pageTitle="Dashboard">
    <div>
        @student
            
            <div>
               <form action="{{ route('exams.show-with-code') }}" method="post">
                    @csrf
                    <div id="evaluationCodeForm" class="bg-white p-3 overflow-hidden shadow-sm sm:rounded-lg mt-3">
                        <x-input-label for="code" :value="__('Password')" />
                        <input id="code" type="text" name="code" class="mt-1 rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" value="{{ old('code') }}" required autofocus/>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </form>
            </div><x-primary-button>Accéder à l'évaluation</x-primary-button>

        @else
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad porro aperiam cupiditate saepe ipsum corporis, quam, eum consectetur, nihil natus ab sint hic aut totam laborum quidem tenetur deleniti doloribus?
            Inventore itaque odio reiciendis? Sint nesciunt possimus cum iusto exercitationem, id dolore quasi totam. Deserunt qui dolorem aperiam possimus facere id et officia quo, velit, voluptatum unde ipsa illo molestias.
            Aut autem voluptatum quas exercitationem, rem minima tempore suscipit alias odit blanditiis, fugiat magnam cupiditate odio commodi saepe dolorum repudiandae voluptas tempora. Exercitationem repellendus, illum temporibus fugit atque illo officia.
        @endstudent

    </div>
</x-app-layout>
