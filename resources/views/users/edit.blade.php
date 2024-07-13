<x-app-layout>
    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user) }}" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @csrf
            @method('PUT')
            
            <h2 class="font-bold text-lg mb-3">Modifier les informations</h2>

            <!-- Name -->
            <div class="mb-3">
                <x-input-label for="name" :value="__('Nom complet')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <div class="block md:flex mb-3">
                <!-- Email Address -->
                <div class="w-full mr-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Status -->
                <div class="w-full ml-0 md:ml-4">
                    <x-input-label for="role_id" :value="__('Status')" />
                
                    <x-input-select name="role_id" id="role_id" >
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected($role->id == $user->role_id)>{{ $role->name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                </div>
            </div>
                
            <x-primary-button>
                {{ __('Enregistrer') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>