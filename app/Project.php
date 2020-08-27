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
    public $fillable = ['name', 'client_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function performances()
    {
        return $this->hasManyThrough(Performance::class, Campaign::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getClientsListAttribute()
    {
        return Client::orderBy('name')->pluck('name', 'id');
    }

    public function isNotDowntimes($query)
    {
        return $query;
    }
}
