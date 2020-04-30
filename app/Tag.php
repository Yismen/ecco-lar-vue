<?php

namespace App;

use App\DainsysModel as Model;

class Tag extends Model
{
    /**
     * List of fields that can be updated/from a form
     *
     * @fillable [array]
     */
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
