<?php

namespace App\Repositories;

use App\Department;
use App\Employee;
use App\Gender;
use App\Position;
use App\Project;
use App\Site;
use App\Supervisor;

class BirthdaysRepository
{
    protected function query()
    {
        return Employee::actives()->filter(request()->all())
            ->orderByRaw('Day(date_of_birth) ASC')
        ;
    }

    public static function today()
    {
        $static = new self();
        $date = now();

        return $static->query()
            ->whereMonth('date_of_birth', $date->month)
            ->whereDay('date_of_birth', $date->day)
            ;
    }

    public static function thisMonth()
    {
        $static = new self();
        $date = now();

        return $static->query()
            ->whereMonth('date_of_birth', $date->month)
            ;
    }

    public static function lastMonth()
    {
        $static = new self();
        $date = now()->subMonth();

        return $static->query()
            ->whereMonth('date_of_birth', $date->month)
            ;
    }

    public static function nextMonth()
    {
        $static = new self();
        $date = now()->addMonth();

        return $static->query()
            ->whereMonth('date_of_birth', $date->month)
            ;
    }
}