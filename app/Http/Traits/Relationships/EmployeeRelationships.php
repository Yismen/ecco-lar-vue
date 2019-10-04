<?php

namespace App\Http\Traits\Relationships;

trait EmployeeRelationships
{
    public function address()
    {
        return $this->hasOne('App\Address');
    }

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

    public function department()
    {
        return $this->hasManyThrough('App\Department', 'App\Position', 'department_id', 'position_id');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender', 'gender_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Nationality');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function marital()
    {
        return $this->belongsTo('App\Marital', 'marital_id');
    }

    public function productions()
    {
        return $this->hasMany('App\Production');
    }

    public function hours()
    {
        return $this->hasMany('App\Hour');
    }

    public function loginNames()
    {
        return $this->hasMany('App\LoginName')
            ->orderBy('login');
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

    /**
     * An employee can have one shift.
     *
     * @return [relationship] [The shift belonging to the current employee]
     */
    public function shift()
    {
        return $this->hasMany('App\Shift');
    }

    /**
     * An employee can have one schedule.
     *
     * @return [relationship] [The schedule belonging to the current employee]
     */
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Supervisor');
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function socialSecurity()
    {
        return $this->hasOne('App\SocialSecurity');
    }

    public function payrollAdditionals()
    {
        return $this->hasMany('App\PayrollAdditional');
    }

    public function payrollDiscounts()
    {
        return $this->hasMany('App\PayrollDiscount');
    }

    public function payrollIncentives()
    {
        return $this->hasMany('App\PayrollIncentive');
    }

    public function vip()
    {
        return $this->hasOne('App\Vip');
    }
}
