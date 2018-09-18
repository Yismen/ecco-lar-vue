<?php

namespace App\Repositories\HumanResources;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Birthdays
{
    protected static $carbon;

    public static function byMonth($month)
    {
        return Employee::actives()
            ->orderBy(DB::raw('MONTH(`date_of_birth`)'))
            ->orderBy(DB::raw('DAY(`date_of_birth`)'))
            ->whereMonth('date_of_birth', '=', $month);
    }

    public static function onDate($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();

        return static::byMonth($date->month)
            ->whereDay('date_of_birth', '=', $date->day)
            ->with('position');
    }

    public static function lastMonth()
    {
        return static::byMonth(Carbon::now()->subMonth()->month);
    }

    public static function currentMonth()
    {
        return static::byMonth(Carbon::now()->month);
    }

    public static function nextMonth()
    {
        return static::byMonth(Carbon::now()->addMonth()->month);
    }
}
