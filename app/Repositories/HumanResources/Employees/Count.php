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
        $months_ago = Carbon::today()->subMonths($months);

        return DB::raw(value);

        return Employee::select(DB::raw('year(`hire_date`) as year, monthname(`hire_date`) as monthname, month(`hire_date`) as month, COUNT(`id`) as count'))
            ->where('hire_date', '>=', $months_ago)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }
    
    public static function inByMonths(int $months)
    {
        $months_ago = Carbon::today()->subMonths($months);

        return Employee::select(DB::raw('year(`hire_date`) as year, monthname(`hire_date`) as monthname, month(`hire_date`) as month, COUNT(`id`) as count'))
            ->where('hire_date', '>=', $months_ago)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public static function outByMonths($months)
    {
        $months_ago = Carbon::today()->subMonths($months);

        return Termination::select(DB::raw('year(`termination_date`) as year, monthname(`termination_date`) as monthname, month(`termination_date`) as month, COUNT(`id`) as count'))
            ->where('termination_date', '>=', $months_ago)
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

