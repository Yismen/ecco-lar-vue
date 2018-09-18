<?php

namespace App\Repositories\HumanResources\Employees;

use App\Employee;
use Illuminate\Support\Facades\DB;

class Aging
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function range($from, $to, $as = 'between')
    {
        return $this->employee
            ->select(DB::raw('select count(id) '));
    }

    public function zeroToThreeMonths()
    {
    }
}
