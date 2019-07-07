<?php

namespace App\Http\Controllers\Api\Performances;

use App\Schedule;
use App\LoginName;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\LoginNameResource;

class EmployeesController extends Controller
{
    public function loginNames()
    {
        $login_names = LoginName::with([
            'employee.supervisor',
        ])
        ->get();

        return LoginNameResource::collection($login_names);
    }

    public function schedules()
    {
        $schedules = Schedule::with('employee.supervisor')
            ->orderBy('employee_id')
            ->whereHas('employee', function ($query) {
                return $query->whereDoesntHave('termination');
            })
            ->get();

        return ScheduleResource::collection($schedules);
    }
}
