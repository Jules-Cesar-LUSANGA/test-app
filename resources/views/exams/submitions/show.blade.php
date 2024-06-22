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
                        <form action="{{ route('exams.responses.set', $exam) }}" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Reponses</h1>

                            <div class="mt-4">
                                @foreach ($responses as $response)
                                    <div class="pl-0 p-4">
                                        <div class="flex justify-between">
                                            <h2 class="text-lg font-semibold">{{ $loop->iteration . '. ' . $response->question->content }}</h2>
                                        </div>
                                        <div class="mt-2">

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