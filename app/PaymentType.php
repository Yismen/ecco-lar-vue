<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PaymentType extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }
}
