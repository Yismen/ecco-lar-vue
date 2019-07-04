<?php

namespace App\Http\Controllers\Api\Performances;

use App\Employee;
use App\DowntimeReason;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\DowntimeReasonsResource;

class DowntimesController extends Controller
{
    public function reasons()
    {
        $downtime_reasons = DowntimeReason::get();

        return DowntimeReasonsResource::collection($downtime_reasons);
    }

    public function employees()
    {
        $projects = Employee::with('supervisor')->get();

        return EmployeeResource::collection($projects);
    }
}
