<x-app-layout pageTitle="Toutes mes évaluations">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Titre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presentations as $presentation)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('exams.submittions.show', $presentation) }}" class="text-blue-500 font-bold hover:underline">{{ $presentation->exam->course_name }}</a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $presentation->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
