<x-action-section>
    <x-slot name="title">
        {{ __('Historique d’activité de :name', ['name' => $user->name]) }}
    </x-slot>
    <x-slot name="description">
        {{ __('Manage and log out your active sessions on other browsers and devices.') }}
    </x-slot>
    <x-slot name="content">
@if ($activities->isEmpty())
    <p>Aucune activité enregistrée.</p>
@else
    <ul class="space-y-2">
        @foreach ($activities as $activity)
            <li class="p-3 bg-gray-100 rounded-lg">
                <strong>{{ $activity->created_at->format('d/m/Y H:i') }}</strong> :
                {{ $activity->description }}
                (par {{ $activity->causer?->name ?? 'Système' }})
            </li>
        @endforeach
    </ul>
@endif
    </x-slot>
</x-action-section>
