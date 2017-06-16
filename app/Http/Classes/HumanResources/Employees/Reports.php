<?php

namespace App\Http\Classes\HumanResources\Employees;

use App\Employee;

class Reports
{

    public function dgt3($year)
    {
        return Employee::select([
            'id', 'first_name', 'second_first_name', 'last_name', 'second_last_name', 'hire_date', 'personal_id', 'passport', 'date_of_birth', 'gender_id', 'position_id'
            ])
            ->whereYear('hire_date', '<=', $year)
            ->with('termination')
            ->where(function($query) use ($year) {
                return $query->has('termination', false)
                    ->orWhereHas('termination', function($query) use ($year){
                        return $query->whereYear('termination_date', '>=', $year);
                    });
            })
            ->with('socialSecurity')
            // ->with('nationality')
            ->with('position.payment')
            ->with('gender')

            // ->whereMonth('hire_date', '=', $month)
            // ->orWhereYear('ter', '=', $year));
            ;
    }

    public function dgt4($year, $month)
    {
        return Employee::select([
            'id', 'first_name', 'second_first_name', 'last_name', 'second_last_name', 'hire_date', 'personal_id', 'passport'
            ])
            ->with('termination')
            ->where(function($query)  use ($year, $month){
                return $query->whereYear('hire_date', '=', $year)
                    ->whereMonth('hire_date', '=', $month);
            })
            ->orWhereHas('termination', function($query) use ($year, $month) {
                return $query->whereYear('termination_date', '=', $year)
                    ->whereMonth('termination_date', '=', $month);
            });
    }
}