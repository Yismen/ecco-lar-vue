<?php

namespace App\Repositories;

use App\Attendance;

class AttendanceRepository
{
    public function all()
    {
        return Attendance::get();
    }
}