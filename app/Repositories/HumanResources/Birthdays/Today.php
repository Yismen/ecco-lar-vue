<?php

namespace App\Repositories\HumanResources\Birthdays;

use App\Repositories\HumanResources\HumanResourcesInterface;
use Carbon\Carbon;
use App\Employee;

class Today implements HumanResourcesInterface
{
    protected $carbon;

    public function __construct()
    {

        $this->carbon = new Carbon;
    }
    public function setup()
    {
        return Employee::actives()
            ->whereMonth('date_of_birth', $this->carbon->month)
            ->whereDay('date_of_birth', $this->carbon->day);
    }

    public function count()
    {
        return $this->setup()->count();
    }

    public function list()
    {
        return $this->setup()
            ->with(['site', 'project', 'position', 'supervisor'])
            ->get();
    }
}
