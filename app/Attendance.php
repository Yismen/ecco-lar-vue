<?php

namespace App;

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
}
