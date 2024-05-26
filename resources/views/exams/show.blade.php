<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Exam of {{ $exam->course_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex justify-between">
                            <h1 class="text-2xl font-semibold">{{ $exam->course_name }}</h1>
                            <p class="text-gray-500">Duration: {{ $exam->duration }} minutes</p>
                        </div>
                        <div>
                            <p class="text-gray-500">{{ $exam->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        @teacher()
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="flex justify-end">
                    
                    <x-primary-button 
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add_qcm_question')"
                        class="mx-2"
                    >
                        Add Multiple Choice Question
                    </x-primary-button>

                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add_question')"
                    >
                        Add Simple Question
                    </x-primary-button>

                </div>
            </div>

        @endteacher


        {{-- Add modals --}}
        <x-questions.modals.qcm-question :exam="$exam"/>
        <x-questions.modals.simple-question :exam="$exam"/>

        {{-- Show created questions --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <form action="" method="POST">
                            @csrf
                            <h1 class="text-2xl font-semibold">Questions</h1>

                            <div class="mt-4">
                                @foreach ($exam->questions as $question)
                                    <div class="pl-0 p-4">
                                        <div class="flex justify-between">
                                            <h2 class="text-lg font-semibold">{{ $loop->iteration . '. ' . $question->content }}</h2>
                            
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
                                                <ul>
                                                    @foreach ($question->assertions as $assertion)
                                                        <li class="flex items-center justify-between mt-2">
                                                            <div>
                                                                @student
                                                                    <input type="checkbox" name="assertion" class="mr-2">
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
                                                    <input type="text" name="question{{ $question->id }}" class="w-full border border-gray-200 p-2" placeholder="Answer">
                                                @endstudent
                                            @endif
                        
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @student
                                <x-primary-button>Submit</x-primary-button>
                            @endstudent
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
