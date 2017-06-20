<?php

namespace App\Repositories;

use App\Employee;
use App\Department;

class Employees
{
    public function actives()
    {
        return Employee::actives();
    }

    public function inactives()
    {
        return Employee::inactives();
    }

    public function byDepartment($department)
    {
        return $department->employees();
    }

    public function employeesByDepartment($id)
    {
        return Department::with(['employees' => function($query){
            return $query->orderBy('first_name', 'asc', 'second_first_name', 'asc')->actives();
        }])->findOrFail($id);
    }
}