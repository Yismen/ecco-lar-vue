<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $dates = ['date'];

    protected $fillable = ['date', 'name', 'description'];
}
