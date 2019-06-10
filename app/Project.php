<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
