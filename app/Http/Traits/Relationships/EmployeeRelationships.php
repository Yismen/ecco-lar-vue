<?php

namespace App\Http\Traits\Relationships;

trait EmployeeRelationships
{
    /**
     * many to many relationship with the department model
     *
     * @return [array] [departments related to current Employee]
     */
    public function ars()
    {
        return $this->belongsTo('App\Ars');
    }

    public function afp()
    {
        return $this->belongsTo('App\Afp');
    }

    public function bankAccount()
    {
        return $this->hasOne('App\BankAccount');
    }

    public function socialSecurity()
    {
        return $this->hasOne('App\SocialSecurity');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    
    public function gender()
    {
        return $this->belongsTo('App\Gender', 'gender_id');
    }
    
    public function nationalities()
    {
        return $this->belongsToMany('App\Nationality');
    }
    
    public function position()
    {
        return $this->belongsTo('App\Position', 'position_id');
    }
    
    public function marital()
    {
        return $this->belongsTo('App\Marital', 'marital_id');
    }
    
    public function addresses()
    {
        return $this->hasOne('App\Address', 'employee_id');
    }

    public function productions()
    {
        return $this->hasMany('App\Production');
    }

    public function hours()
    {
        return $this->hasMany('App\Hour');
    }

    public function logins()
    {
        return $this->hasMany('App\Login');
    }

    public function card()
    {
        return $this->hasOne('App\Card');
    }

    public function punch()
    {
        return $this->hasOne('App\Punch');
    }

    public function termination()
    {
        return $this->hasOne('App\Termination');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Supervisor');
    }
}