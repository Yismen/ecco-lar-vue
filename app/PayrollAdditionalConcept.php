<?php

namespace App;

use App\DainsysModel as Model;

class PayrollAdditionalConcept extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
