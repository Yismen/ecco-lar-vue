<?php

namespace App;

use App\DainsysModel as Model;

class AppSetting extends Model
{
    protected $fillable = ['skin', 'layout', 'mini', 'collapse'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
