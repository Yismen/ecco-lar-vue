<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ars extends Model implements SluggableInterface
{
    use Sluggable;

    protected $table = 'ars';


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
    
    // Methods ===================================================
    
    // Scopes ====================================================
    
    // Accessors =================================================
    
    // Mutators ==================================================
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = trim(ucwords($name));
    }
    
}