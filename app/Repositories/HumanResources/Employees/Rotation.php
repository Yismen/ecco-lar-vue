<?php

namespace App\Repositories\HumanResources\Employees;

use Carbon\Carbon;

class Rotation
{
    private $months;
    private $months_list;
    private $entrances_by_month;
    private $outages_by_month;
    private $now;

    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function render(int $months = 5)
    {

        $this->entrances_by_month = $this->entrancesByMonth();
        $this->outages_by_month = $this->outagesByMonth();
    }

    public function entrancesByMonth()
    {
        return Employee::select(DB::raw('year(`hire_date`) as year, monthname(`hire_date`) as monthname, month(`hire_date`) as month, COUNT(`id`) as count'))
            ->where('hire_date', '>=', $months_ago)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }
    
}