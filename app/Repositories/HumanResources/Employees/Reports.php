<?php

namespace App\Repositories\HumanResources\Employees;

use App\Employee;
use Carbon\Carbon;

class Reports
{
    /**
     * List of the lasts 5 years
     * @var array
     */
    public $last_five_years;

    public $months_of_the_year  = [
        1  => 'January',
        2  => 'February',
        3  => 'March',
        4  => 'April',
        5  => 'May',
        6  => 'June',
        7  => 'July',
        8  => 'August',
        9  => 'September',
        10 => 'Octuber',
        11 => 'November',
        12 => 'December',
    ];

    public function __construct()
    {
        $currentYear = Carbon::now()->year;
        $years = [];

        for ($year=$currentYear; $year > $currentYear-5; $year--) { 
            $years[$year] = $year;
        }

        $this->last_five_years = $years;
    }

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