<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Réponses à : {{ $exam->course_name }} | Par {{ $student->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <form action="{{ route('exams.submittions.set-points', $presentation) }}" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Reponses</h1>

                            <div class="my-4">
                                
                                {{-- Faire la somme des points --}}
                                @student
                                    @php
                                        $points = 0;
                                    @endphp
                                @endstudent

                                @foreach ($responses as $response)

                                    @student
                                        @php
                                            $points += $response->points
                                        @endphp
                                    @endstudent

                                    <div class="pl-0 p-2">
                                        <div class="flex justify-between">
                                            <h2 class="text-lg font-semibold">{{ $loop->iteration . '. ' . $response->question->content }}</h2>
                                        </div>
                                        <div class="mt-2 pl-4">

                                            @if ($response->question->qcm == true)
                                                
                                                @foreach ($response->assertions as $assertion)

                                                    @php
                                                        // Check if this is the right response
                                                        $isAnswer = $assertion->questionAssertion->isAnswer;
                                                    @endphp

                                                    @teacher
                                                        <p @class(['font-bold', 'text-blue-500' => $isAnswer, 'text-red-500' => $isAnswer == false])>
                                                            {{ $assertion->questionAssertion->content }}
                                                        </p>
                                                    @else
                                                        <p>
                                                            {{ $assertion->questionAssertion->content }}
                                                        </p>
                                                    @endteacher
                                                @endforeach                                              

                                            @else
                                                <p>
                                                    {{ $response->content }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        @teacher
                                            <div class="mts-4">
                                                <x-input-label for="points{{ $response->question->id }}" :value="__('Points')" />
                                                <x-text-input id="points{{ $response->question->id }}" class="block mt-1" type="text" min="0" name="points[]" :value="old('points', $response->points)" required autofocus autocomplete="duration" />
                                                <x-input-error :messages="$errors->get('points')" class="mt-2" />
                                            </div>
                                        @endstudent

                                    </div>
                                @endforeach
                            </div>
                            
                            @teacher
                                <x-primary-button>Enregistrer la côte</x-primary-button>
                            @else
                                <h2 class="font-bold text-2xl">Côte : {{ $points }}</h2>
                            @endteacher
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>