<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Employees implements FromView, WithTitle, ShouldAutoSize
{
    protected $scope;

    public function __construct($scope)
    {
        $this->scope = $scope;
    }
    /**
     * : View
     *
     * @return Excel file
     */
    public function view(): View
    {
        $status = $this->scope;
        $employees =  Employee::orderBy('first_name')
            ->with('bankAccount')
            ->$status()
            ->get();

        return view('employees.excel.employees', compact('employees'));
    }

    public function title(): string
    {
        return "Employees";
    }
}