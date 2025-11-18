<div>
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search Service</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817
                                  4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live="searchService" type="text" id="simple-search"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                           placeholder="Search Service...">
                </div>
            </form>
        </div>

        <div>
            <select wire:model.live="searchUser"
                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0
                           border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0
                           focus:border-gray-200 peer">
                <option value="0">Choose one User</option>
                @foreach($users as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </select>
        </div>
    </div>

<!-- Liste des services -->
    <div class="p-4">
        <table class="min-w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Service Name</th>
                <th scope="col" class="px-6 py-3">Label</th>
                <th scope="col" class="px-6 py-3">Users</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $service)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $service->name }}</td>
                    <td class="px-6 py-4">{{ $service->label }}</td>
                    <td class="px-6 py-4">
                        {{ $service->users->pluck('name')->join(', ') ?: '—' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</div>
