<?php

namespace App;

use App\DainsysModel as Model;

class TypeOfHour extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['type',  'display_name'];
}
