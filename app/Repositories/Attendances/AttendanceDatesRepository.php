<?php

namespace App\Repositories\Attendances;

use App\Attendance;
use App\AttendanceCode;
use Carbon\Carbon;

class AttendanceDatesRepository
{
    protected $current_user;

    protected $date;

    /**
     * Return data and dates for all attendances for a given date
     *
     * @param Carbon\date $date
     * @param boolean $current_user false to query data for all users
     */
    public function __construct(Carbon $date, bool $current_user = true)
    {
        $this->current_user = $current_user == true ? auth()->user()->id : '%';

        $this->date = $date;
    }


    public function data()
    {
        return AttendanceCode::query()
            ->withCount(['attendances' => function($query) {
                return $query->whereDate('date', $this->date)
                    ->where('user_id', 'like', $this->current_user);
            }])
            ->whereHas('attendances', function($query){
                $query->whereDate('date', $this->date)
                ->where('user_id', 'like', $this->current_user);
            })
            ->get();
    }

    public function dates()
    {
        return Attendance::groupBy('date')
            ->select('date')
            ->where('user_id', $this->current_user)
            ->limit(50)
            ->latest('date')
            ->get();
    }

}