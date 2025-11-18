<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

#[Title('Show Services with corresponding Users')]
class ShowService extends Component
{
    use WithPagination;

    public string $searchService = "";
    public int $searchUser = 0;

    public Collection $users;

    public function mount(): void
    {
        // Liste des utilisateurs (id => name)
        $this->users = User::pluck('name', 'id');
    }

    public function render()
    {
        $services = Service::with('users')
            ->when($this->searchService !== '', fn (Builder $query) =>
            $query->where('name', 'like', '%' . $this->searchService . '%')
            )
            ->when($this->searchUser > 0, fn (Builder $query)
            =>$query->whereHas('users', fn ($q)
            => $q->where('id', $this->searchUser))
            )
            ->paginate(3);

        return view('livewire.show-service', [
            'services' => $services,
        ])->layout('layouts.app');
    }
    public function updating($key): void
    {
        if ($key === 'searchService' || $key === 'searchUser') {
            $this->resetPage();
        }
    }
}
