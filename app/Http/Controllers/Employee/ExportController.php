<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Employees as EmployeesExport;

class ExportController extends Controller
{
    /**
     * Allows to export employees to excel by status
     *
     * @param string $status
     * @return download file
     */
    public function toExcel($status)
    {
        return Excel::download(new EmployeesExport($status), 'employees.xlsx');
    }
}
