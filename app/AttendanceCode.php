<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceCode extends Model
{
    protected $fillable = ['name', 'color', 'absence'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'code_id');
    }
}
