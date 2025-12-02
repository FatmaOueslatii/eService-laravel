<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function exportUsersExcel()
    {
        return Excel::download(
            new UsersExport(
                request()->search,
                request()->searchRole,
                request()->sortField,
                request()->sortDirection),
            'users.xlsx'
        );
    }

    public function exportUsersPdf()
    {
        $data = (new UsersExport(
            request()->search,
            request()->searchRole,
            request()->sortField,
            request()->sortDirection
        ))->collection();

        $pdf = Pdf::loadView('pdf.users', ['users' => $data]);

        return $pdf->download('users.pdf');
    }
}
