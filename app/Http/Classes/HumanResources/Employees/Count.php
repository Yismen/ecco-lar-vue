<?php

namespace App\Http\Classes\HumanResources\Employees;

use App\Employee;
use Carbon\Carbon;
use App\Department;
use Illuminate\Support\Facades\DB;

class Count
{
    public static function byDepartment()
    {
        return Department::select(['id', 'department'])
            ->orderBy('department')
            ->with(['positions' => function($query){
                return $query->select('department_id','id', 'name')
                    ->whereHas('employees', function($query) {
                        return $query->actives();
                    })
                    ->withCount(['employees' => function($query){
                        return $query->actives();
                    }]);
            }]);
    }

}

