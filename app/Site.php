<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function performances()
    {
        return $this->hasManyThrough(Performance::class, Employee::class);
    }
}
