<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PaymentFrequency extends Model  implements SluggableInterface
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
