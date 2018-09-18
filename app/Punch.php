<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punch extends Model
{
    protected $fillable = ['employee_id', 'punch'];

    /**
     * -----------------------------------------------------------
     * Relationships
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    /**
     * ---------------------------------------------------
     * Accessors
     */
    public function getEmployeeListAttribute()
    {
        $employees = $this->employee()->pluck('id');

        if ($employees->count() > 0) {
            return $employees[0];
        }
    }

    public function getEmployeesListAttribute()
    {
        $employees = \App\Employee::orderBy('first_name')
            ->get();

        return $employees->pluck('fullName', 'id');
    }
}
