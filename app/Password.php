<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Password extends Model
{
    use SluggableTrait;

    /**
     * Sluggable Object
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'on_update' => true,
    ];

    /**
     * mass assignable
     */
    protected $fillable = ['slug', 'title', 'url', 'username', 'password'];

    /**
     * ==========================================
     * Relationships
     */
    public function modelName()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
     * ========================================
     * Methods
     */
    
    /**
     * ==========================================
     * Scopes
     */
    
    public function ScopeForCurrentUser($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }
    
    /**
     * ======================================
     * Accessors
     */
    
    /**
     * =======================================
     * Mutators
     */
}
