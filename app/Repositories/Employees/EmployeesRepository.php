<?php

namespace App\Repositories;

use App\Employee;


class EmployeesRepository
{
    public static function getAll()
    {
        $employees = Employee::with('positions')
        ->paginate(10)
        // ->get();
        ->appends(['status' => $status, 'search' => $search]);
    }
}
