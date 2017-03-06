<?php

namespace App;

use App\EscalRecord;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

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

    public function escal_records()
    {
        return $this->hasMany(EscalRecord::class);
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
