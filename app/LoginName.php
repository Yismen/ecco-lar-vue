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
        return Employee::select('id', 'first_name', 'second_first_name', 'last_name', 'second_last_name')
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->get()
                    ->pluck('fullName', 'id');
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
