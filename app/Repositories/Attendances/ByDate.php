<?php

namespace App\Repositories\Attendances;

use App\Attendance;
use App\AttendanceCode;

class ByDate
{
    public function data($options)
    {
        return $attendances = AttendanceCode::query()
            ->withCount(['attendances' => function($query) use ($options) {
                return $query->whereDate('date', $options['date'])
                    ->where('user_id', $options['user_id']);
            }])
            ->whereHas('attendances', function($query) use ($options) {
                $query->whereDate('date', $options['date'])
                    ->where('user_id', $options['user_id']);
            })
            ->get();
    }
    public function dates($options)
    {
        return Attendance::groupBy('date')
            ->select('date')
            ->where('user_id', $options['user_id'])
            ->limit(50)
            ->latest('date')
            ->get();
    }
}