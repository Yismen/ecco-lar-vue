<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    protected $fillable = ['name'];

    /**
     * ---------------------------------------------------
     * Relationships
     * ------------------------------------------------
     */
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
