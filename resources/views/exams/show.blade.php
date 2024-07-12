<x-app-layout>
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="py-6 px-10">
                <div class="text-black">
                    <div class="lg:flex justify-between">
                        <h1 class="text-2xl font-semibold mb-3">{{ $exam->course_name . " (" . $exam->code . ")" }}</h1>
                        <p class="lg:text-gray-500 mb-3 lg:mb-0 font-bold lg:font-normal">Durée : {{ $exam->duration }} minutes</p>
                    </div>
                    <div>
                        <p class="text-gray-500">{{ $exam->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        
        @teacher()
            <div class="mt-4 flex items-center justify-end">
                
                @notLaunched($exam)
                    <form action="{{ route('exams.launch') }}" method="post" class="flex">
                        @csrf
                        <input type="hidden" name="code" value="{{ $exam->code }}">
                        <x-secondary-button type="submit" class="md:mx-2 mb-3">Lancer</x-secondary-button>
                    </form>

                    @notPresented($exam)
                        <div>
                            <x-primary-button 
                                onclick="window.add_qcm_question.showModal();"
                                class="md:mx-2 mb-3"
                            >
                                Ajouter une question QCM
                            </x-primary-button>

                            <x-primary-button
                                class="md:mx-2 mb-3"
                                onclick="window.add_question.showModal();"
                            >
                                Ajouter une simple question
                            </x-primary-button>

                        </div>
                    @endnotPresented
                @else
                    <x-primary-link href="{{ route('exams.submittions.get', $exam) }}">Soumissions</x-primary-link>
                @endnotLaunched

            </div>

            {{-- Add modals --}}
            <x-questions.modals.qcm-question :exam="$exam"/>
            <x-questions.modals.simple-question :exam="$exam"/>

        @endteacher


        {{-- Show questions --}}

        <div class="mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-6 px-10 bg-white border-b border-gray-200">
                    <div>
                        <form action="{{ route('exams.responses.set', $exam) }}" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Questions</h1>

                            <div class="my-4">
                                @foreach ($exam->questions as $question)
                                    <div class="pl-0 px-4">
                                        <div class="lg:flex items-center">
                                            <h2 class="text-lg font-semibold">{{ "{$loop->iteration}.  {$question->content} ({$question->points} pts)" }}</h2>
                                            @notLaunched($exam)
                                            <div class="flex items-center lg:ml-4">
                                                <a href="{{ route('questions.edit', $question) }}" class="text-blue-500 font-bold hover:underline mr-4">Modifier</a>
                                                <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 font-bold hover:underline">Supprimer</button>
                                                </form>
                                            </div>
                                            @endnotLaunched
                                        </div>
                                        <div class="mt-2">
                                            @if ($question->qcm == true)
                                                <ul class="pl-4">
                                                    @foreach ($question->assertions as $assertion)
                                                        <li class="flex items-center mt-1">
                                                            @notLaunched($exam)
                                                                <form action="{{ route('assertion.IsAnswer', $assertion) }}" method="post" id="assertionForm">
                                                                    @csrf
                                                                    <input 
                                                                        @checked($assertion->isAnswer == true)
                                                                        type="checkbox" 
                                                                        class="mr-3" 
                                                                        id="assertion{{ $loop->iteration }}" 
                                                                        onchange="this.closest('form').submit();" />
                                                                </form>
                                                            @endnotLaunched
                                                            <x-input-label for="assertion{{ $loop->iteration }}" @class(['text-blue-500' => $assertion->isAnswer == true])>{{ $assertion->content }}</x-input-label>
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
