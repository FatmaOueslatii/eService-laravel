<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class UsersAction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public ?User $selectedUser = null;
    public bool $showModal = false;

    public string $search = '';
    public string $searchRole = ''; // nom du rôle Spatie

    public Collection $roles;

    public function mount(): void
    {
        // Liste des rôles Spatie
        $this->roles = Role::pluck('label', 'name'); // ["admin" => "admin", ...]
    }

    // Export PDF
    public function exportPdf()
    {
        try {
            $users = User::with('roles')
                ->when($this->search !== '', function (Builder $query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->searchRole !== '', fn($query)
                    => $query->role($this->searchRole))

                ->get();

            $pdf = Pdf::loadView('pdf.users', ['users' => $users]);

            $this->dispatch('show-toast', [
                'message' => 'Téléchargement PDF...',
                'type' => 'success',
            ]);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'users_list.pdf');

        } catch (\Throwable $e) {
            $this->dispatch('show-toast', [
                'message' => 'Erreur PDF ❌',
                'type' => 'error',
            ]);
        }
    }

    public function showUser($id)
    {
        $this->selectedUser = User::with('roles')->findOrFail($id);
        $this->dispatch('open-user-modal');
    }

    public function closeModal()
    {
        $this->selectedUser = null;
    }

    public function render()
    {
        $users = User::with('roles')
            ->when($this->search !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->when($this->searchRole !== '', function ($query) {
                $query->role($this->searchRole); // Spatie filtre correctement
            })
            ->orderBy('name')
            ->paginate(4);

        return view('livewire.users-action', [
            'users' => $users,
        ]);
    }



    public function updating($key): void
    {
        if (in_array($key, ['search', 'searchRole'])) {
            $this->resetPage();
        }
    }
}
