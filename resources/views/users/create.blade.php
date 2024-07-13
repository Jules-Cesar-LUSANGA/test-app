<x-app-layout>
    
    <div class="flex justify-center items-center">
        <form method="POST" action="{{ route('users.store') }}" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @csrf

            <h2 class="font-bold text-lg mb-3">Ajouter un nouvel utilisateur</h2>

            <div class="block md:flex">
                <!-- Name -->
                <div class="w-full mr-4 mt-4">
                    <x-input-label for="name" :value="__('Nom complet')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="w-full  md:ml-4 mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="block md:flex">
                <!-- Status -->
                <div class="w-full mr-4 mt-4">
                    <x-input-label for="role_id" :value="__('Status')" />
                
                    <x-input-select name="role_id" id="role_id">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="w-full md:ml-4 mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
                
            <x-primary-button class="mt-4">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </form>
    </div>

</x-app-layout>