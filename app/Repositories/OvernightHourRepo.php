<?php

namespace App\Repositories;

use App\Employee;
use App\OvernightHour;

class OvernightHourRepo
{
    public function all()
    {
        return OvernightHour::with('employee');
    }

    public function employees()
    {
        return Employee::recents()
            ->sorted()
            ->with('overnightHours');
    }
}
