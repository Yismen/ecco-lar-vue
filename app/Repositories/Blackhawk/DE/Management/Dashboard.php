<?php

namespace App\Repositories\Blackhawk\DE\Management;

use App\Repositories\Employees\Departments\Count;

class Dashboard
{
    public static function dashboard($name)
    {
        return [
            'employees' => Count::getCount($name),
            'positions' => Count::byPositions($name)
        ];
    }
}
