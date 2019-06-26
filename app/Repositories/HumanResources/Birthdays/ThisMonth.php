<?php

namespace App\Repositories\HumanResources\Birthdays;

use App\Repositories\HumanResources\HumanResourcesInterface;
use Carbon\Carbon;
use App\Employee;

class ThisMonth implements HumanResourcesInterface
{
    protected $carbon;

    public function __construct()
    {
        $this->carbon = new Carbon;
    }
    public function setup()
    {
        return Employee::actives()
            ->whereMonth('date_of_birth', $this->carbon->month);
    }

    public function count()
    {
        return $this->setup()->count();
    }

    public function list()
    {
        return $this->setup()
            ->orderByRaw('Day(date_of_birth)')
            ->get();
    }
}
