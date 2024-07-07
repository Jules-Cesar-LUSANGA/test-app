<x-app-layout :pageTitle="$exam->course_name">
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

        
    @teacher()
        <div class="mt-4 flex items-center justify-end">
            
            @notPresented($exam)
                <div>
                    
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
            @else
                <x-primary-link href="{{ route('exams.submittions.get', $exam) }}">Soumissions</x-primary-link>
            @endnotPresented

        </div>

        {{-- Add modals --}}
        <x-questions.modals.qcm-question :exam="$exam"/>
        <x-questions.modals.simple-question :exam="$exam"/>

    @endteacher


    {{-- Show questions --}}

    <div class="mt-4">
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
                                        @notPresented($exam)
                                        <div class="flex items-center">
                                            <a href="{{ route('questions.edit', $question) }}" class="text-blue-500">Edit</a>
                                            <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Delete</button>
                                            </form>
                                        </div>
                                        @endnotPresented
                                    </div>
                                    <div class="mt-2">
                                        @if ($question->qcm == true)
                                            <ul class="pl-4">
                                                @foreach ($question->assertions as $assertion)
                                                    <li class="flex items-center justify-between mt-1">
                                                        <div>
                                                            <label for="assertion" @class(['font-bold text-blue-500' => $assertion->isAnswer == true])>{{ $assertion->content }}</label>
                                                        </div>
                                                        @notPresented($exam)
                                                        <form action="{{ route('assertion.IsAnswer', $assertion) }}" method="post">
                                                            @csrf
                                                            <input type="submit" value="Bonne réponse" class="py-1 px-3 bg-{{ $assertion->isAnswer == true ? 'red' : 'cyan' }}-600 rounded">
                                                        </form>
                                                        @endnotPresented
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                    
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>

    </div>

</x-app-layout>
