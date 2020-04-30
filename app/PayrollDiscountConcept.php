<?php

namespace App;

use App\DainsysModel as Model;

class PayrollDiscountConcept extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
