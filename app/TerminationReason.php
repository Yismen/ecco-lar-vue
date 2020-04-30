<?php

namespace App;

use App\DainsysModel as Model;

class TerminationReason extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['reason', 'description'];

    public function setReasonAttribute($reason)
    {
        return $this->attributes['reason'] = ucwords(trim($reason));
    }
}
