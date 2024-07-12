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
            @teacher
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda praesentium nihil, modi fuga accusantium natus earum, ut suscipit mollitia ipsa officia. Quas dolorem, repudiandae aut laboriosam neque expedita officiis possimus!
            @else
                <div>
                    <form action="{{ route('exams.launch') }}" method="post" class="bg-white p-3 rounded-md shadow-md flsex items-center">
                        @csrf
                        <x-input-label for="code" class="block mb-3" value="Code de l'évaluation" />
                        <div class="flex items-center">
                            <x-text-input id="code" type="text" name="code"  value="{{ old('code') }}"  autofocus required/>
                            <x-primary-button class="ml-3">Lancer</x-primary-button>
                        </div>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </form>
                </div>
            @endteacher
        @endstudent

    </div>
</x-app-layout>
