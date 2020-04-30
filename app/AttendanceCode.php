<?php

namespace App;

use App\DainsysModel as Model;

class AttendanceCode extends Model
{
    protected $fillable = ['name', 'color', 'absence'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'code_id');
    }

    protected function getNameAttribute($name)
    {
        return ucwords(trim($name));
    }
}
