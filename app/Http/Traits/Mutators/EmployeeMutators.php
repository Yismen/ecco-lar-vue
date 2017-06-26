<?php

namespace App\Http\Traits\Mutators;

use Carbon\Carbon;

trait EmployeeMutators
{
    /**
     * transform the first name attribute before saving to the database
     * @param [string] $first_name [employee's first name]
     */
    public function setFirstNameAttribute($first_name)
    {
        $this->attributes['first_name'] = ucwords(trim($first_name));
    }

    public function setSecondFirstNameAttribute($second_first_name)
    {
        $this->attributes['second_first_name'] = ucwords(trim($second_first_name));
    }

    /**
     * trim and change to ucwords the last name before saving to the database
     *
     * @param [string] $last_name [employee's last name]
     */
    public function setLastNameAttribute($last_name)
    {
        $this->attributes['last_name'] = ucwords(trim($last_name));
    }

    public function setSecondLastNameAttribute($second_last_name)
    {
        $this->attributes['second_last_name'] = ucwords(trim($second_last_name));
    }

    /**
     * make sure date of birth is saved as an instance of carbon
     * 
     * @param [type] $date_of_birth [description]
     */
    public function setHireDateAttribute($hire_date)
    {
        $this->attributes['hire_date'] = Carbon::parse($hire_date)->format('Y-m-d');
    }

    /**
     * make sure date of birth is saved as an instance of carbon
     * 
     * @param [type] $date_of_birth [description]
     */
    public function setDateOfBirthAttribute($date_of_birth)
    {
        $this->attributes['date_of_birth'] = Carbon::parse($date_of_birth);
    }
}