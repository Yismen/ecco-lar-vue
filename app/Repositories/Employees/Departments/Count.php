<?php

namespace App\Repositories\Employees\Departments;

use App\Employee;
use App\Position;

class Count
{
    public static function getCount($department = '%')
    {
        return Employee::actives()
            ->whereHas('position', function ($query) use ($department) {
                return $query->whereHas('department', function ($query) use ($department) {
                    $query->where('department', $department);
                });
            })->count();
    }

    public static function byPositions($department = '%')
    {
        return Position::withCount('employees')->whereHas('department', function ($query) use ($department) {
            return $query->where('department', $department);
        })->get() ;
    }
}
