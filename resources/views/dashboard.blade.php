<x-app-layout pageTitle="Dashboard">
    <div>
        @student
            
            <div>
                <form action="{{ route('exams.show-with-code') }}" method="post" class="bg-white p-3 rounded-md shadow-md flex items-center">
                    @csrf
                    <x-input-label for="code" class="mb-3" value="Code de l'évaluation" />
                    <div class="flex items-center">
                        <x-text-input id="code" type="text" name="code" value="{{ old('code') }}" autofocus required/>
                        <x-primary-button class="ml-3">Accéder</x-primary-button>
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </form>
            </div>

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
        @endstudent

    </div>
    <div>
        @admin
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                    <div class="bg-gradient-to-r from-blue-200 to-blue-400 border rounded-lg p-4">
                        <p class="text-lg font-semibold text-center text-gray-900">Total Utilisateurs</p>
                        <p class="text-gray-700 text-center text-lg">{{ $users }}</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                    <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                        <p class="text-lg text-center font-semibold text-gray-900">Enseignants</p>
                        <p class="text-gray-700 text-center text-lg">{{ $teachers }}</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                    <div class="bg-gradient-to-r from-yellow-200 to-yellow-400 border rounded-lg p-4">
                        <p class="text-lg text-center font-semibold text-gray-900">Etudiants</p>
                        <p class="text-gray-700 text-center text-lg">{{ $students }}</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                    <div class="bg-gradient-to-r from-indigo-200 to-indigo-400 border rounded-lg p-4">
                        <p class="text-lg text-center font-semibold text-gray-900">Surveillants</p>
                        <p class="text-gray-700 text-center text-lg">{{ $supervisors }}</p>
                    </div>
                </div>
            </div>
        @else
            @teacher
                <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                    <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                        <p class="text-lg text-center font-semibold text-gray-900">Evaluations</p>
                        <p class="text-gray-700 text-center text-lg">{{ $exams }}</p>
                    </div>
                </div>
            @else
                @student
                    <div class="w-full md:w-1/2 xl:w-1/4 p-6">
                        <div class="bg-gradient-to-r from-green-200 to-green-400 border rounded-lg p-4">
                            <p class="text-lg text-center font-semibold text-gray-900">Evaluations présentées</p>
                            <p class="text-gray-700 text-center text-lg">{{ $exams }}</p>
                        </div>
                    </div>
                @endstudent 
            @endteacher
        @endadmin
    </div>
</x-app-layout>
