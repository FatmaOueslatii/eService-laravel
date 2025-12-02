<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UsersExport implements FromCollection ,
                             WithHeadings,
                             WithMapping,
                             ShouldAutoSize,
                             WithStyles
{
    protected $search;
    protected $sortField;
    protected $sortDirection;
    protected $searchRole;

    public function __construct($search, $searchRole, $sortField, $sortDirection)
    {
        $this->search        = $search;
        $this->searchRole    = $searchRole;
        $this->sortField     = $sortField;
        $this->sortDirection = $sortDirection;
    }
    public function collection()
    {
        return User::with('roles')
            ->when(filled($this->search), function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when(filled($this->searchRole), function ($query) {
                $query->role($this->searchRole);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get(); // récupère toutes les lignes filtrées
    }
        /** Colonnes Excel */
    public function headings(): array
    {
        return [
            'ID',
            'Nom complet',
            'Email',
            'Téléphone',
            'Date création',
        ];
    }

    /** Mapping : définir ce que chaque ligne contient */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone ?? '---',
            $user->created_at ? $user->created_at->format('d-m-Y H:i') : '',
        ];
    }

    /** Styles Excel */
    public function styles(Worksheet $sheet)
    {
        return [
            // La ligne des headings devient en gras
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
