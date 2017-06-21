<?php

namespace App\Repositories;

use App\Employee;
use App\Position;
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
            return $query->orderBy('first_name', 'asc', 'second_first_name', 'asc')->actives()
                ->with('position.department');
        }])->findOrFail($id);
    }

    public function employeesByPosition($id)
    {
        return Position::with(['employees' => function($query){
            return $query->orderBy('first_name', 'asc', 'second_first_name', 'asc')->actives()
                ->with('position.department');
        }])->findOrFail($id);
    }
}