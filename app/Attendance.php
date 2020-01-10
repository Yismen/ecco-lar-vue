<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $dates = ['date'];

    protected $fillable = ['employee_id', 'user_id', 'code_id', 'comments', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reporter()
    {
        return $this->user();
    }

    public function attendance_code()
    {
        return $this->belongsTo(AttendanceCode::class, 'code_id');
    }

    public function getDateAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function getCodesListAttribute()
    {
        return AttendanceCode::all();
    }

    public function getEmployeesListAttribute()
    {
        return auth()->user()->supervisors->load(['employees' => function($query) {
            return $query->actives()->sorted();
        }])->map(function($item, $key) {
            return $item->employees;
        })->collapse();
    }
}