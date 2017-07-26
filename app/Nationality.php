<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->belongsToMany('App\Employee')
            ->select([
                'id', 'first_name', 'second_first_name', 'last_name', 'second_last_name', 'photo'
            ])
            ;
    }

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(
            strtolower(
                trim($name, " ")
            )
        );
    }

}
