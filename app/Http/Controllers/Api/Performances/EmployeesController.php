<?php

namespace App\Http\Controllers\Api\Performances;

use App\Schedule;
use App\LoginName;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function schedules(Request $request)
    {
        $daysago = $request->daysago ?? 90;

        $schedules = Schedule::with('employee.supervisor')
            ->orderBy('employee_id')
            ->orderBy('date')
            ->whereDate('date', '>=', Carbon::now()->subDays((int) $daysago))
            ->whereDate('date', '<=', Carbon::now()->subDays(1))
            ->whereHas('employee', function ($query) {
                return $query->whereDoesntHave('termination');
            })
            ->get();

        return ScheduleResource::collection($schedules);
    }
}
