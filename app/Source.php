<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Source extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
