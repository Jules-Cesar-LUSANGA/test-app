@teacher
    @php
        $pageTitle = "Réponses de l'étudiant {$student->name}"
    @endphp
@else
    @php
        $pageTitle = "Réponses"
    @endphp
@endteacher

<x-app-layout :pageTitle="$pageTitle">
    
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <div class="flex justify-between">
                    <h1 class="text-2xl font-semibold">{{ $exam->course_name }}</h1>
                    <p class="text-gray-500">Durée : {{ $exam->duration }} minutes</p>
                </div>
                <div>
                    <p class="text-gray-500">{{ $exam->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">

        @foreach ($submitions as $submition)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-3">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                
                    <div>
                        <form action="{{ route('exams.submittions.set-points', $submition) }}" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Reponses</h1>

                            <div class="my-4">
                                
                                {{-- Faire la somme des points --}}
                                @php
                                    $points = 0;
                                @endphp

                                @foreach ($submition->responses as $response)

                                    @php
                                        $points += $response->points
                                    @endphp

                                    <div class="pl-0 p-2">
                                        <div class="flex justify-between">
                                            <h2 class="text-lg font-semibold">{{ "{$loop->iteration}. {$response->question->content} ({$response->question->points} pts)" }}</h2>
                                        </div>
                                        <div class="mt-2 pl-4">

                                            @if ($response->question->qcm == true)
                                                @foreach ($response->assertions as $assertion)

                                                    @php
                                                        // Check if this is the right response
                                                        $isAnswer = $assertion->questionAssertion->isAnswer;
                                                    @endphp
                                                    
                                                    <p @class(['font-bold', 'text-blue-500' => $isAnswer, 'text-red-500' => $isAnswer == false])>
                                                        {{ $assertion->questionAssertion->content }}
                                                    </p>
                                                @endforeach                                              

                                            @else
                                                <p>
                                                    {{ $response->content }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        <div class="mts-4">

                                        @qcm($response->question)
                                            <x-text-input id="points{{ $response->question->id }}" class="block mt-1" type="hidden" min="0" name="points[]" :value="old('points', $response->question->qcm == true ? $response->getGoodAssertions() : $response->points)" required />
                                            <h2>Points : {{ $response->getGoodAssertions() }}</h2>
                                    
                                        @else
                                            @if ($submition->finished == false)
                                                @teacher
                                                    <x-input-label for="points{{ $response->question->id }}" :value="__('Points')" />
                                                    <x-text-input id="points{{ $response->question->id }}" class="block mt-1 disabled" type="text" min="0" name="points[]" :value="old('points', $response->question->qcm == true ? $response->getGoodAssertions() : $response->points)" required />
                                                    <x-input-error :messages="$errors->get('points')" class="mt-2" />
                                                @endteacher
                                            @else
                                                <h2>Points : {{ $response->points }}
                                            @endif  
                                        @endqcm
                                            
                                        </div>
                                        
                                    </div>
                                @endforeach
                            </div>

                            @if ($submition->finished == false)
                                @teacher
                                    <x-primary-button>Enregistrer la côte</x-primary-button>
                                @endteacher
                            @else
                                <h2 class="font-bold text-2xl">Côte : {{ "{$points}/{$presentation->exam->totalPoints()}" }}</h2>
                            @endif
                            
                        </form>                        
                    </div>
                
                </div>
            </div>
        @endforeach

    </div>

</x-app-layout>