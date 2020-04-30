<?php

namespace App;

use App\DainsysModel as Model;

class Card extends Model
{
    protected $fillable = ['card', 'employee_id'];

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

    /**
     * get employees with no cards added
     * @return [type] [description]
     */
    public function getEmployeesListAttribute()
    {
        $employees = \App\Employee::orderBy('first_name')
            ->get();

        return $employees->pluck('fullName', 'id');
    }

    /**
     * --------------------------------------------------
     * Scopes
     */
    public function scopeUnassigned($query)
    {
        return $query->has('employee', false);
    }
}
