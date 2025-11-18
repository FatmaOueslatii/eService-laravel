<div class="space-y-4 bg-gradient-to-r from-indigo-300 to-purple-400">
    <!-- Barre de recherche et actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-4">
        <!-- Recherche -->
        <div class="flex items-center space-x-2 w-full sm:w-1/3 bg-white border border-gray-200 rounded-lg px-3 py-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 text-gray-400 flex-shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <circle cx="11" cy="11" r="8" stroke-linecap="round" stroke-linejoin="round" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <input wire:model.live.debounce="search"
                   type="text"
                   placeholder="Rechercher un utilisateur..."
                   class="w-full border-0 focus:ring-0 focus:outline-none text-base text-gray-700 placeholder-gray-400 bg-transparent"
            />
        </div>


        <div class="flex items-center space-x-3 bg-white border border-gray-200 rounded-xl px-4 py-3 w-full md:w-auto">
            <!-- Icône -->
            <div class="flex items-center justify-center bg-blue-100 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 text-blue-600"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 12h12M10 20h4" />
                </svg>
            </div>

            <!-- Label -->
            <label for="role" class="text-sm font-medium text-gray-700 hidden sm:inline">
                Rôle :
            </label>

            <!-- Sélecteur -->
            <div class="relative w-full md:w-48">
                <select
                    id="role"
                    wire:model.live.debounce.500ms="searchRole"
                    class="block w-full appearance-none rounded-lg border border-gray-300 bg-white
                   text-sm text-gray-700 py-2 px-3 pr-8 leading-tight
                   focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    <option value="" class="text-gray-400 hidden sm:inline">Tous les rôles</option>
                    @foreach($roles as $name => $label)
                        <option value="{{ $name }}">{{ $label }}</option>
                    @endforeach
                </select>

                <!-- Flèche -->
                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>


        <!-- Boutons d'export -->
        <div class="flex space-x-2">

            <button
                wire:click="exportPdf"
                class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg shadow-sm transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2v20h12V2z" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="9" y1="22" x2="9" y2="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="15" y1="22" x2="15" y2="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                PDF
            </button>

            {{-- Bouton Excel --}}
            <button
                wire:click="exportExcel"
                class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg shadow-sm transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16v16H4z" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 9l6 6M15 9l-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Excel
            </button>
            </div>


    </div>

    <!-- Table des utilisateurs -->

    <div class="relative overflow-x-auto  sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-400 dark:text-gray-700">

            <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2 border">Nom</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Rôle</th>
            <th class="px-4 py-2 border">Crée le </th>
            <th class="py-3 px-4 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse(($users ?? []) as $user)

            <tr class="border hover:bg-gray-100">
                                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                                        <td class="px-4 py-2 border">{{ $user->roleLabel() ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3 px-4 text-center flex justify-center space-x-2">
                                            <button
                                                wire:click="showUser({{ $user->id }})"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-semibold flex items-center space-x-1"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span class="hidden sm:inline">Afficher</span>
                                            </button>

                                        <!-- Modifier -->
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs font-semibold flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="hidden sm:inline">Modifier</span>
                                        </a>

                                        <!-- Supprimer -->

                                            <button
                                                x-data
                                                x-on:click.prevent="$dispatch('confirm-delete', { id: {{ $user->id }} })"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-semibold flex items-center space-x-1"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="10" y1="11" x2="10" y2="17" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="14" y1="11" x2="14" y2="17" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span class="hidden sm:inline">Supprimer</span>
                                            </button>


                                        </td>

                                    </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun utilisateur trouvé.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

        <div class="m-4">
{{--            {{ $users?->links() }}--}}
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>

        <!-- Modale de confirmation suppression -->
        <div
            x-data="{ open: false, userId: null }"
            x-on:confirm-delete.window="open = true; userId = $event.detail.id;"
            x-cloak
        >
            <!-- Overlay -->
            <div
                x-show="open"
                x-transition.opacity.duration.300ms
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
            >
                <!-- Modal Container -->
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden"
                >
                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Confirmation</h2>
                        <button
                            @click="open = false"
                            class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors duration-200"
                            aria-label="Fermer"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="px-6 py-5">
                        <p class="text-sm text-gray-700">Voulez-vous vraiment supprimer cet utilisateur ?</p>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                        <button
                            type="button"
                            @click="open = false"
                            class="px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg
                           transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            Annuler
                        </button>

                        <form :action="`/admin/users/${userId}`" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            >
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @if (session('toast'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('show-toast', {
                    detail: {
                        message: "{{ session('toast')['message'] }}",
                        type: "{{ session('toast')['type'] }}"
                    }
                }));
            });
        </script>
    @endif


    <!-- ✅ MODALE DÉTAIL UTILISATEUR -->

    <div
        x-data="{ open: false }"
        x-on:open-user-modal.window="open = true"
        x-cloak
    >
        <!-- Overlay -->
        <div
            x-show="open"
            x-transition.opacity.duration.300ms
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
        >
            <!-- Modal Container -->
            <div
                @click.outside=" $wire.closeModal()"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <span class="text-2xl">👤</span>
                        <span>Détails de l'utilisateur</span>
                    </h2>
                    <button
                        @click="open = false; $wire.closeModal()"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors duration-200"
                        aria-label="Fermer"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="px-6 py-5">
                    @if ($selectedUser)
                        <div class="space-y-3">
                            <div class="flex gap-3 py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600 min-w-[100px]">Nom :</span>
                                <span class="text-sm text-gray-900 font-medium">{{ $selectedUser->name }}</span>
                            </div>

                            <div class="flex gap-3 py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600 min-w-[100px]">Email :</span>
                                <span class="text-sm text-gray-900">{{ $selectedUser->email }}</span>
                            </div>

                            <div class="flex gap-3 py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600 min-w-[100px]">Rôle :</span>
                                <span class="text-sm text-gray-900">{{ $selectedUser->roleLabel() ?? '—' }}</span>
                            </div>

                            <div class="flex gap-3 py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600 min-w-[100px]">Créé le :</span>
                                <span class="text-sm text-gray-900">{{ $selectedUser->created_at->format('d/m/Y à H:i') }}</span>
                            </div>

                            <div class="flex gap-3 py-2">
                                <span class="text-sm font-medium text-gray-600 min-w-[100px]">Statut :</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $selectedUser->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $selectedUser->active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                {{ $selectedUser->active ? 'Actif' : 'Inactif' }}
                            </span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8">
                            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-gray-900 mb-4"></div>
                            <p class="text-gray-500 text-sm">Chargement des données...</p>
                        </div>
                    @endif
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                    <button
                        type="button"
                        @click="open = false; $wire.closeModal()"
                        class="px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg
                           transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    >
                        Fermer
                    </button>

                    @if ($selectedUser)
                        <a
                            href="{{ route('admin.users.edit', $selectedUser->id) }}"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Modifier
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>



</div>
