<?php

namespace App\Repositories\HumanResources\Employees;

use App\Employee;
use Carbon\Carbon;
use App\Department;
use App\EscalRecord;
use App\Termination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Count
{
    
    public static function rotationbyMonths($months)
    {        
        $today = Carbon::today();
        $months_ago = Carbon::today()->subMonths($months - 1);

        return collect([
            'entrances' => self::inByMonths($months, $today, $months_ago), 
            'exits' => self::outByMonths($months, $today, $months_ago), 
        ]);
    }
    
    private static function inByMonths($months, $today, $months_ago)
    {
        return Employee::select(DB::raw('year(hire_date) as year, monthname(hire_date) as monthname, month(hire_date) as month, COUNT(employees.id) as entrances'))
            ->whereBetween('hire_date',  [$months_ago, $today])
            ->groupBy('year', 'month')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->get();
    }
    
    public static function byDepartmentAndAging()
    {
        return Department::
            orderBy('department', 'ASC')
            ->whereHas('employees', function($query) {
                return $query->actives();
            })
            ->withCount(['employees' => function($query) {
                return $query
                    ->actives();

            }])
            ->withCount(['employeesLastTreeMonths' => function($query) {
                return $query->actives();
            }])
            ->withCount(['employeesBetweenThreeAndSixMonths' => function($query) {
                return $query->actives();
            }])
            ->withCount(['employeesBetweenSixAndNimeMonths' => function($query) {
                return $query->actives();
            }])
            ->withCount(['employeesBetweenNimeMonthsAndAYear' => function($query) {
                return $query->actives();
            }])
            ->withCount(['employeesBetweenOneAndThreeYears' => function($query) {
                return $query->actives();
            }])
            ->withCount(['employeesOverThreeYears' => function($query) {
                return $query->actives();
            }]);
        ;
    }

    private static function outByMonths($months, $today, $months_ago)
    {
        return Termination::select(DB::raw('year(termination_date) as year, monthname(termination_date) as monthname, month(termination_date) as month, COUNT(id) as exits'))
            ->whereBetween('termination_date',  [$months_ago, $today])
            ->groupBy('year', 'month')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->get();
    }

    /**
     * [byDepartmentPositionGender description]
     * @return [type] [description]
     */
    public static function byDepartment()
    {
        return Department::
            withCount(['employees' => function($query) {
                return $query
                    ->actives();

            }])
            ->orderBy('employees_count', "Desc")
            ->whereHas('employees', function($query) {
                return $query->actives();
            })
            ->get();
    }
    /**
     * [byDepartmentPositionGender description]
     * @return [type] [description]
     */
    public static function byDepartmentPositionGender()
    {
        return Department::
            with(['positions' => function($query) {
                return $query
                    ->whereHas('employees', function($query) {
                        return $query->actives();
                    })
                    ->with(['employees' => function($query){
                        return $query->actives()
                            ->select(DB::raw('position_id, count(id) as employees_count, gender_id'))
                            ->with('gender')
                            ->groupBy(['position_id', 'gender_id'])
                            ->orderBy('position_id', 'ASC', 'gender_id', 'ASC')
                            ;
                    }]);
            }])
            ->whereHas('positions', function($query){
                return $query->whereHas('employees', function($query) {
                        return $query->actives();
                    });
            })
            ->orderBy('department');
    }

}

