<x-evaluation-layout :title="$exam->course_name" :code="$exam->code" :duration="$exam->duration" :timeLeft="$timeLeft" :description="$exam->description">

    <div class="py-6">
        <form action="{{ route('exams.responses.set', $exam) }}" id="submitExam" method="POST">
            @csrf
            <h1 class="text-2xl font-semibold">Questions</h1>

            <div class="my-4">
                @foreach ($questions as $question)
                    <div class="pl-0 px-4 mb-3">
                        <div class="flex justify-between">
                            <h2 class="text-lg font-semibold">{{ "{$loop->iteration}.  {$question->content} ({$question->points} pts)" }}</h2>
                        </div>
                        <div class="mt-2">
                            @if ($question->qcm == true)
                                <ul class="pl-4">
                                    @foreach ($question->assertions as $assertion)
                                        <li class="my-1">
                                            <input type="checkbox" name="question{{ $question->id }}-assertion-{{ $assertion->id }}" class="mr-2">
                                            <label for="assertion" @class(['font-bold text-blue-500' => $assertion->isAnswer == true and (auth()->user()->role_id == 2)])>{{ $assertion->content }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <input type="text" required name="question{{ $question->id }}" class="w-full border border-gray-200 p-2" placeholder="Answer">
                            @endif
        
                        </div>
                    </div>
                @endforeach
            </div>
            
            <x-primary-button class="bg-blue-800 rounded">Soumettre</x-primary-button>
            
        </form>
    </div>

    <script>
        // Interdire le clic droit
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Interdire certaines touches
        document.addEventListener('keydown', function(e) {
            // Liste des touches à interdire
            var forbiddenKeys = ['Alt', 'Control', 'Shift', 'Meta', 'Fn'];

            // Si la touche est dans la liste des touches interdites, ou si c'est une lettre et que l'élément ciblé n'est pas un input, interdire la touche
            if (forbiddenKeys.includes(e.key) || (e.key.match(/^[A-Za-z]$/) && e.target.tagName !== 'INPUT')) {
                e.preventDefault();
            }
        });
        
    </script>

</x-evaluation-layout>
