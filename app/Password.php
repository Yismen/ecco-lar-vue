<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Password extends Model
{
    use Sluggable;

    /**
     * mass assignable
     */
    protected $fillable = ['slug', 'title', 'url', 'username', 'password'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

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
