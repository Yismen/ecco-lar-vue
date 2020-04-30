<?php

namespace App;

use App\DainsysModel as Model;

class Bank extends Model
{
    protected $fillable = ['name'];

    // Relationships =============================================
    public function accounts()
    {
        return $this->hasMany('App\BankAccount');
    }

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
