<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * List of fields that can be updated/from a form
     *
     * @fillable [array]
     */
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
