    @php

        $role = $user->getRoleNames()->first(); // 'admin', 'agent', 'client'

        $dashboardRoute = match ($role) {
            'admin' => route('admin.dashboard'),
            'agent' => route('agent.dashboard'),
            'client' => route('client.dashboard'),
            default => route('welcome'),
        };



        // Vérification de l'état actif
        $isDashboardActive = ($currentRoute === $dashboardRoute);
        $isUsersActive = ($user->hasRole('admin') && $currentRoute === 'admin.users.index');
        $isServiceActive = ($user->hasRole('admin') && $currentRoute === 'admin.services');
    @endphp

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link href="{{ $dashboardRoute }}"
                        class="
                    font-semibold transition
                    {{-- Classe fixe si actif, ou hover si inactif --}}
                    {{ $isDashboardActive
                       ? 'text-indigo-600'
                       : 'text-gray-700 dark:text-gray-600 hover:text-indigo-600'
                    }}
                ">
                Dashboard
            </x-nav-link>

        @role('admin')
                <x-nav-link href="{{ route('admin.users.index') }}"
                            class="
                        font-semibold transition
                        {{-- Classe fixe si actif, ou hover si inactif --}}
                        {{ $isUsersActive
                           ? 'text-indigo-600'
                           : 'text-gray-700 dark:text-gray-600 hover:text-indigo-600'
                        }}
                    ">
                      <span class="inline-block align-middle mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                      </span>
                    Users
                </x-nav-link>

                <x-nav-link href="{{ route('admin.services') }}"
                        class="
                        font-semibold transition
                        {{-- Classe fixe si actif, ou hover si inactif --}}
                        {{ $isServiceActive
                           ? 'text-indigo-600'
                           : 'text-gray-700 dark:text-gray-600 hover:text-indigo-600'
                        }}
                    ">
                      <span class="inline-block align-middle mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M2.879 7.121A3 3 0 0 0 7.5 6.66a2.997 2.997 0 0 0 2.5 1.34 2.997 2.997 0 0 0 2.5-1.34 3 3 0 1 0 4.622-3.78l-.293-.293A2 2 0 0 0 15.415 2H4.585a2 2 0 0 0-1.414.586l-.292.292a3 3 0 0 0 0 4.243ZM3 9.032a4.507 4.507 0 0 0 4.5-.29A4.48 4.48 0 0 0 10 9.5a4.48 4.48 0 0 0 2.5-.758 4.507 4.507 0 0 0 4.5.29V16.5h.25a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75v-3.5a.75.75 0 0 0-.75-.75h-2.5a.75.75 0 0 0-.75.75v3.5a.75.75 0 0 1-.75.75h-4.5a.75.75 0 0 1 0-1.5H3V9.032Z" />
                </svg>
            </span>
                Services
            </x-nav-link>
        @endrole
    </div>
