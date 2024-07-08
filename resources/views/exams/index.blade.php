<x-app-layout pageTitle="Evaluations" pageLinkText="Créer une évaluation" :pageLinkUrl="route('exams.create')">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        *
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Duree
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('exams.show', $exam) }}" class="text-blue-500 font-bold hover:underline">{{ $exam->course_name }}</a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $exam->code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $exam->duration }} m
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::substr($exam->created_at, 0, 10) }}
                        </td>
                        <td class="px-6 py-4">
                            @notPresented($exam)
                                <a href="{{ route('exams.edit', $exam->id) }}" class="mr-3 text-blue-500 font-bold hover:underline">Editer</a>
                                <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold hover:underline">Supprimer</button>
                                </form>
                            @endnotPresented
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-app-layout>