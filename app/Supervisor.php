<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = ['name', 'active'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
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
