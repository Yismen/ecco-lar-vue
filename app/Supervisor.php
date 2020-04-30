<?php

namespace App;

use App\DainsysModel as Model;

class Supervisor extends Model
{
    protected $fillable = ['name', 'active'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('id');
    }

    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, User::class);
    }

    public function getStatusAttribute()
    {
        return $this->active ? "Active" : "Inactive";
    }

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }

    public function scopeActives($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactives($query)
    {
        return $query->where('active', 0);
    }
}
