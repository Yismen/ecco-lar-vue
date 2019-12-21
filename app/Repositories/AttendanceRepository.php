<?php

namespace App\Repositories;

use App\Attendance;
use Carbon\Carbon;

class AttendanceRepository
{
    public function all()
    {
        $date = request('date') ?? Carbon::now()->format('Y-m-d');

        return Attendance::with([
                'employee', 'reporter', 'attendance_code'
            ])->whereDate('date', $date)
            ->get();
    }
}