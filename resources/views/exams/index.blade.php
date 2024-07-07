<x-app-layout pageTitle="Evaluations" pageLinkText="Créer une évaluation" :pageLinkUrl="route('exams.create')">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="grid grid-cols-7 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">  
                <div class="col-span-1 flex items-center">
                    <p class="font-medium">*</p>
                </div>
                <div class="col-span-3 flex items-center">
                    <p class="font-medium">Titre</p>
                </div>
                <div class="col-span-1 hidden items-center">
                    <p class="font-medium">Duree</p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium">Code</p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium"></p>
                </div>

            </div>
                      
                @foreach ($exams as $exam)
                    
                    <div class="grid grid-cols-8 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-1 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $loop->iteration }}</p>
                        </div>
                        <div class="col-span-3 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">
                                <a href="{{ route('exams.show', $exam) }}" class="mr-3 text-meta-5">{{ $exam->course_name }}</a>
                            </p>
                        </div>
                        <div class="col-span-1 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $exam->duration }} mins</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $exam->code }}</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            @notPresented($exam)
                                <a href="{{ route('exams.edit', $exam->id) }}" class="mr-3 text-meta-5">Editer</a>
                                <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">Supprimer</button>
                                </form>
                            @endnotPresented
                        </div>
                    </div>
                @endforeach

          </div>

    </div>

</x-app-layout>