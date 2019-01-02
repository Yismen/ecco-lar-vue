<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['name', 'start', 'end'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
