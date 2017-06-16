<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany('App\Employee', 'employee_id', 'id')->withPivot('employee_nationality');
    }

}
