<x-app-layout pageTitle="Utilisateurs" pageLinkText="Ajouter un utilisateur" :pageLinkUrl="route('users.create')">
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="grid grid-cols-8 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">  
                <div class="col-span-1 flex items-center">
                    <p class="font-medium">*</p>
                </div>
                <div class="col-span-3 flex items-center">
                    <p class="font-medium">Nom complet</p>
                </div>
                <div class="col-span-1 hidden items-center sm:flex">
                    <p class="font-medium">Status</p>
                </div>
                <div class="col-span-2 flex items-center">
                    <p class="font-medium">Email</p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium"></p>
                </div>

            </div>
                      
                @foreach ($users as $user)
                    
                    <div class="grid grid-cols-8 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-1 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $loop->iteration }}</p>
                        </div>
                        <div class="col-span-3 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $user->name }}</p>
                        </div>
                        <div class="col-span-1 hidden items-center sm:flex">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $user->role->name }}</p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="text-sm font-medium text-black dark:text-white">{{ $user->email }}</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="mr-3 text-meta-5">Editer</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach

            
          </div>



    </div>

    <div>
        {{ $users->links() }}
    </div>

</x-app-layout>