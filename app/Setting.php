<?php

namespace App;

use App\DainsysModel as Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
