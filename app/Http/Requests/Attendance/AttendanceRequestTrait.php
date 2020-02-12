<?php

namespace App\Http\Requests\Attendance;

use App\Rules\DateBetweenRule;
use Carbon\Carbon;

trait AttendanceRequestTrait
{
    public function fields()
    {
        return [
            'date' => [
                'required',
                'date',
                new DateBetweenRule(Carbon::now()->subDays(10), Carbon::now())
            ],
            // 'user_id' => 'required|exists:users,id',
            'employee_id' =>'required',
            'employee_id.*' => [
                'required',
                'exists:employees,id'
            ],
            'code_id' => 'required|exists:attendance_codes,id',
                       
        ];
    }
}
