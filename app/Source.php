<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Source extends Model
{
    use Sluggable;

    protected $fillable = ['name'];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function productions()
    {
        return $this->hasMany('App\Production');
    }
    
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
    
    /**
     * =======================================
     * Mutators
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }
}
