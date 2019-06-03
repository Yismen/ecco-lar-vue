<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminationType extends Model
{
    protected $fillable = ['name', 'description'];

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
