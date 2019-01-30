<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = ['name'];

    /**
     * ---------------------------------------------------
     * Relationships
     * ------------------------------------------------
     */
    public function employees()
    {
        return $this->belongsTo('App\Employee', 'gender_id');
    }
}
