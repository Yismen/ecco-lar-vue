<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Note extends Model implements SluggableInterface
{
	use SluggableTrait;
  use SoftDeletes;

	protected $sluggable = [
		'build_from' => 'title',
		'save_to'    => 'slug',
    'on_update' => true,
	];

    /**
     * mass assignable
     */
    protected $fillable = [
      'title',
      'body',
      'tags'
    ];

    /**
     * Attributes that should be mutated as dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

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
    public function getTagListAttribute()
    {
      $tags = explode(',', $this->tags);
      return (object)$tags;
    }

    public function getTitleAttribute($title)
    {
      return ucwords($title);
    }
   	
   	/**
   	 * =======================================
   	 * Mutators
   	 */
    public function setTitleAttribute($title)
    {
      return $this->attributes['title'] = ucwords($title);
    }
    

    
}
