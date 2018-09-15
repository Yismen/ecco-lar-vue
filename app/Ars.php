<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ars extends Model
{
    use Sluggable;

    protected $table = 'arss';


    protected $fillable = ['name'];
    
    public function sluggable() {
        return [
            'slug' => [
                'source' => ['name'],
                'onUpdate' => true
            ]
        ];
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = trim(ucwords($name));
    }
    
}
