<?php

namespace App\Repositories\Attendances;

use App\Attendance;
use App\AttendanceCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AttendanceEmployeesRepository
{
    protected $current_user;

    protected $employee;

    public function __construct(int $employee, bool $current_user = true)
    {
        $this->current_user = $current_user == true ? auth()->user()->id : '%';

        $this->employee = $employee;
    }


    public function data()
    {
        return AttendanceCode::query()
            ->whereHas('attendances', function($query) {
                $query->where('employee_id', $this->employee)
                        ->whereDate('date', '>=',Carbon::now()->subMonths(2)->startOfMonth() );
            })
            ->with(['attendances' => function($query) {
                $query->where('employee_id', $this->employee)
                ->whereDate('date', '>=',Carbon::now()->subMonths(2)->startOfMonth() );
            }])
            ->get()
            ;
    }

    public function codes()
    {
        return AttendanceCode::get();
    }
}