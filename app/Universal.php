<?php

namespace App;

use App\DainsysModel as Model;

class Universal extends Model
{
    protected $dates = ['since'];

    protected $fillable = ['employee_id', 'since'];

    /**
     * A vip belongs to an employee.
     *
     * @return relation one to one
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
