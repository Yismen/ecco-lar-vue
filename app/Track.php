<?php

namespace App;

use App\DainsysModel as Model;

class Track extends Model
{
    protected $fillable = ['user_id', 'before', 'after'];

    public function trackable()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
