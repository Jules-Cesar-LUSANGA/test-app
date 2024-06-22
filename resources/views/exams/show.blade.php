<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $exam->course_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex justify-between">
                            <h1 class="text-2xl font-semibold">{{ $exam->course_name . " (" . $exam->code . ")" }}</h1>
                            <p class="text-gray-500">Durée : {{ $exam->duration }} minutes</p>
                        </div>
                        <div>
                            <p class="text-gray-500">{{ $exam->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        @teacher()
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 flex items-center justify-between">
                
                <a href="{{ route('exams.submittions.get', $exam) }}" class="text-white font-bold border px-2 py-1 rounded-lg bg-cyan-800">Soumissions</a>

                <div class="flex justify-end">
                    
                    <x-primary-button 
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add_qcm_question')"
                        class="mx-2"
                    >
                        Ajouter une question QCM
                    </x-primary-button>

                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add_question')"
                    >
                        Ajouter une simple question
                    </x-primary-button>

                </div>
            </div>

            {{-- Add modals --}}
            <x-questions.modals.qcm-question :exam="$exam"/>
            <x-questions.modals.simple-question :exam="$exam"/>

        @endteacher


        {{-- Show questions --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <form action="{{ route('exams.responses.set', $exam) }}" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Questions</h1>

                            <div class="my-4">
                                @foreach ($exam->questions as $question)
                                    <div class="pl-0 px-4">
                                        <div class="flex justify-between">
                                            <h2 class="text-lg font-semibold">{{ "{$loop->iteration}.  {$question->content} ({$question->points} pts)" }}</h2>
                            
                                            @teacher
                                                <div class="flex items-center">
                                                    <a href="{{ route('questions.edit', $question) }}" class="text-blue-500">Edit</a>
                                                    <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500">Delete</button>
                                                    </form>
                                                </div>
                                            @endteacher
                                        </div>
                                        <div class="mt-2">
                                            @if ($question->qcm == true)
                                                <ul class="pl-4">
                                                    @foreach ($question->assertions as $assertion)
                                                        <li class="flex items-center justify-between mt-1">
                                                            <div>
                                                                @student
                                                                    <input type="checkbox" name="question{{ $question->id }}-assertion-{{ $assertion->id }}" class="mr-2">
                                                                @endstudent
                                                                <label for="assertion" @class(['font-bold text-blue-500' => $assertion->isAnswer == true and (auth()->user()->role_id == 2)])>{{ $assertion->content }}</label>
                                                            </div>
                                                            @teacher()
                                                            <form action="{{ route('assertion.IsAnswer', $assertion) }}" method="post">
                                                                @csrf
                                                                <input type="submit" value="Bonne réponse" class="py-1 px-3 bg-{{ $assertion->isAnswer == true ? 'red' : 'cyan' }}-600 rounded">
                                                            </form>
                                                            @endteacher
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                @student
                                                    <input type="text" required name="question{{ $question->id }}" class="w-full border border-gray-200 p-2" placeholder="Answer">
                                                @endstudent
                                            @endif
                        
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @student
                                <x-primary-button>Soumettre</x-primary-button>
                            @endstudent
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
