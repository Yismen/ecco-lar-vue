<?php

namespace App\Repositories\Employees;

use App\Employee;

class VipRepo
{
    public function vips()
    {
        return Employee::actives()
            ->sorted()
            ->vips();
    }

    public function noVips()
    {
        return Employee::actives()
            ->sorted()
            ->noVips();
    }
}
