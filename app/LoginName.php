<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginName extends Model
{
    protected $fillable = ['login', 'employee_id'];

    /**
     * -------------------------------------------------------
     * Relatioships
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    /**
     * --------------------------------------------
     * Accessors
     */
    public function getEmployeesListAttribute()
    {
        $employees = Employee::orderBy('first_name')->get();

        return $employees->pluck('fullName', 'id');
    }

    public function getSystemsListAttribute()
    {
        return \App\System::pluck('name', 'id');
    }

    /**
     * ----------------------------------------
     * Mutators
     */
    public function setLoginAttribute($login)
    {
        $this->attributes['login'] = trim($login);
    }
}
