<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modifier l’utilisateur : ') }} <span class="text-indigo-600">{{ $user->name }}</span>
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nom</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>
                    </div>

                    <!-- Nouveau mot de passe -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nouveau mot de passe (laisser vide si inchangé)</label>
                        <input type="password" name="password"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                    </div>

                    <!-- Confirmer mot de passe -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                    </div>

                    <!-- Rôle -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Rôle</label>
                        <select name="role_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>
                            <option value="">-- Sélectionner un rôle --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
