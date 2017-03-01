<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class EscalClient extends Model implements SluggableInterface
{
    use SluggableTrait;
    /**
     * mass assignable
     */
    protected $fillable = ['name'];

    /**
     * Slugable fields implementation
     * @var [array]
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'on_update'  => true,
    ];

    /**
     * ==========================================
     * Relationships
     */
    
    /**
     * ========================================
     * Methods
     */
    
    /**
     * ==========================================
     * Scopes
     */
    
    /**
     * ======================================
     * Accessors
     */
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }
    
    /**
     * =======================================
     * Mutators
     */
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords($name);
    }
}
