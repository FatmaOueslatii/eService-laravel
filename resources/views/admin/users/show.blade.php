<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de l’utilisateur : ') }} <span class="text-indigo-600">{{ $user->name }}</span>
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nom :</label>
                    <p class="text-gray-900">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email :</label>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Rôle :</label>
                    <p class="text-gray-900">{{ $user->role->label ?? 'Non défini' }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Date de création :</label>
                    <p class="text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow">
                        Modifier
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
