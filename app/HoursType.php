<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HoursType extends Model  implements SluggableInterface
{   
    use Sluggable;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];
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

   public function employee()
   {
       return $this->belongsTo('App\Employee');
   }
   
   // Methods ===================================================
   
   // Scopes ====================================================
   
   // Accessors =================================================
   
   // Mutators ==================================================
   


}
