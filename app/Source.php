<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Source extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['name'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        // 'on_update'   => true,
    ];

	/**
     * ==========================================
     * Relationships
     */
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
