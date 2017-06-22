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
    
    public static function rotationbyMonths(int $months)
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
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    private static function outByMonths($months, $today, $months_ago)
    {
        return Termination::select(DB::raw('year(termination_date) as year, monthname(termination_date) as monthname, month(termination_date) as month, COUNT(id) as exits'))
            ->whereBetween('termination_date',  [$months_ago, $today])
            ->orderBy('month')
            ->groupBy('month')
            ->get();
    }

    /**
     * [byDepartmentPositionGender description]
     * @return [type] [description]
     */
    public static function byDepartment()
    {
        if (Cache::has('employees_by_department')) {
            return Cache::get('employees_by_department');
        }

        $cached = Department::
            withCount(['employees' => function($query) {
                return $query
                    ->actives()
                    // ->select(DB::raw('employees.gender_id'))
                    // ->groupBy(['employees.gender_id'])
                    // ->with('gender')
                    // ->orderBy('gender_id', 'ASC')
                    ;

            }])
            ->orderBy('employees_count', "Desc")
            ->whereHas('employees', function($query) {
                return $query->actives();
            })
            ->get();

        
        Cache::put('employees_by_department', $cached, 120);

        return $cached; 
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

