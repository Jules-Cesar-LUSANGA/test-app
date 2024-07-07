<x-app-layout pageTitle="Toutes mes évaluations">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">  
                <div class="col-span-1 flex items-center">
                    <p class="font-medium">*</p>
                </div>
                <div class="col-span-3 flex items-center">
                    <p class="font-medium">Titre</p>
                </div>
                <div class="col-span-1 hidden items-center sm:flex">
                    <p class="font-medium">Date</p>
                </div>
            </div>
                      
                @foreach ($presentations as $presentation)
                    
                    <div class="grid grid-cols-8 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-1 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $loop->iteration }}</p>
                        </div>
                        <div class="col-span-3 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">
                                <a href="{{ route('exams.submittions.show', $presentation) }}" class="text-meta-5">{{ $presentation->exam->course_name }}</a>
                            </p>
                        </div>
                        <div class="col-span-1 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $presentation->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

          </div>

    </div>

</x-app-layout>
