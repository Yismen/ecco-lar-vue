<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Afps extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    protected $fillable = ['name'];

    // Relationships =============================================
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
