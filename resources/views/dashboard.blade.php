<x-app-layout pageTitle="Dashboard">
    <div>
        @student
            
            <div>
                <form action="{{ route('exams.show-with-code') }}" method="post" class="bg-white p-3 rounded-md shadow-md">
                    @csrf
                    <x-input-label for="code" class="block mb-3" value="Code de l'évaluation à présenter" />
                    <div>
                        <x-text-input id="code" type="text" class="w-full md:w-min mb-3 md:mb-0" name="code"  value="{{ old('code') }}"  autofocus required/>
                        <x-primary-button>Accéder</x-primary-button>
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </form>
            </div>

        @else
            <div>
                <form action="{{ route('exams.launch') }}" method="post" class="bg-white p-3 rounded-md shadow-md">
                    @csrf
                    <x-input-label for="code" class="block mb-3" value="Code de l'évaluation à lancer" />
                    <div>
                        <x-text-input id="code" type="text" class="w-full md:w-min mb-3 md:mb-0" name="code"  value="{{ old('code') }}"  autofocus required/>
                        <x-primary-button>Lancer</x-primary-button>
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </form>
            </div>
        @endstudent

    </div>

    @if (Auth::user()->role_id != 4)
        <h2 class="font-bold text-2xl mt-3">
            Statistiques
        </h2>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 my-3">
        @admin
            <div class="bg-gradient-to-r from-blue-200 to-blue-400 border rounded-lg p-4">
                <p class="text-lg font-semibold text-center text-gray-900">Total Utilisateurs</p>
                <p class="text-gray-700 text-center text-lg font-bold">{{ $users }}</p>
            </div>

            <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                <p class="text-lg text-center font-semibold text-gray-900">Enseignants</p>
                <p class="text-gray-700 text-center text-lg font-bold">{{ $teachers }}</p>
            </div>
                                                                                                                                                                                                                                        
            <div class="bg-gradient-to-r from-yellow-200 to-yellow-400 border rounded-lg p-4">
                <p class="text-lg text-center font-semibold text-gray-900">Etudiants</p>
                <p class="text-gray-700 text-center text-lg font-bold">{{ $students }}</p>
            </div>

            <div class="bg-gradient-to-r from-indigo-200 to-indigo-400 border rounded-lg p-4">
                <p class="text-lg text-center font-semibold text-gray-900">Surveillants</p>
                <p class="text-gray-700 text-center text-lg font-bold">{{ $supervisors }}</p>
            </div>
        @else
            @teacher
                <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                    <p class="text-lg text-center font-semibold text-gray-900">Evaluations</p>
                    <p class="text-gray-700 text-center text-lg font-bold">{{ $exams }}</p>
                </div>
            @else
                @student
                    <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                        <p class="text-lg text-center font-semibold text-gray-900">Evaluations présentées</p>
                        <p class="text-gray-700 text-center text-lg font-bold">{{ $exams }}</p>
                    </div>
                @endstudent 
            @endteacher
        @endadmin
    </div>
</x-app-layout>
