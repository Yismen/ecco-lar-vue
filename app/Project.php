<?php

namespace App;

use App\DainsysModel as Model;

class Project extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    public $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function performances()
    {
        return $this->hasManyThrough(Performance::class, Campaign::class);
    }

    public function isNotDowntimes($query)
    {
        return $query;
    }
}
