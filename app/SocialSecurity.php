<?php

namespace App;

use App\DainsysModel as Model;

class SocialSecurity extends Model
{
    protected $fillable = ['number'];

    // Relationships =============================================
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
