<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdditionalConcept extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
