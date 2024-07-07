<x-app-layout pageTitle="Soumissions : {{ $exam->course_name }}">
    
    <x-slot name="pageButton">
        <form action="{{ route('exams.another-chance', $exam) }}" method="post">
            @csrf
            <x-primary-button>Refaire l'évaluation</x-primary-button>
        </form>
    </x-slot>
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">  
                <div class="col-span-1 flex items-center">
                    <p class="font-medium">*</p>
                </div>
                <div class="col-span-3 flex items-center">
                    <p class="font-medium">Nom de l'étudiant</p>
                </div>
                <div class="col-span-1 hidden items-center sm:flex">
                    <p class="font-medium">Date</p>
                </div>
            </div>
                      
                @foreach ($exam->presentations as $presentation)
                    
                    <div class="grid grid-cols-8 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-1 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $loop->iteration }}</p>
                        </div>
                        <div class="col-span-3 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">
                                <a href="{{ route('exams.submittions.show', $presentation) }}" class="text-meta-5">{{ $presentation->user->name }}</a>
                            </p>
                        </div>
                        <div class="col-span-1 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $presentation->updated_at }}</p>
                        </div>
                    </div>
                @endforeach

          </div>

    </div>

</x-app-layout>