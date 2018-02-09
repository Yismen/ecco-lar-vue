<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Note extends Model
{
    use Sluggable;

    /**
     * mass assignable
     */
    protected $fillable = [
      'title',
      'body',
      'tags'
    ];

    protected $appends = ['tag_list'];

    /**
     * Attributes that should be mutated as dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
          'slug' => [
              'source' => 'title',
              'onUpdate' => true,
          ]
      ];
    }

    public function getTagListAttribute()
    {
        $tags = explode(',', $this->tags);

        $output = [];

        foreach ($tags as $value) {
            $value = trim($value);
            $value = ucfirst($value);
            array_push($output, $value);
        }

        return $this->attributes['tag_list'] = (object)$output;
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
