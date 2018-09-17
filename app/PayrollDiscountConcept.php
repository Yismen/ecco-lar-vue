<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollDiscountConcept extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
