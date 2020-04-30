<?php

namespace App;

use App\DainsysModel as Model;

class Curve extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['days_in_production_limit', 'goal_percentage_required'];
}
