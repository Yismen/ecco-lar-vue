<?php

namespace App;

use Carbon\Carbon;
use App\DainsysModel as Model;

class Holiday extends Model
{
    protected $dates = ['date'];

    protected $fillable = ['date', 'name', 'description'];

    public function getNameAttribute($name){
        return ucwords($name);
    }

    public function setNameAttribute($name){
        return $this->attributes['name'] = ucwords($name);
    }

    public function getDescriptionAttribute($description){
        return ucfirst($description);
    }

    public function setDescriptionAttribute($description){
        return $this->attributes['description'] = ucfirst($description);
    }

    public function scopeSinceManyMonthsAgo($query, $months = 6)
    {
        $date = Carbon::now()->subMonths($months)->startOfMonth();

        return $query->whereDate('date', '>=', $date);
    }
}
