<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class HoursType extends Model  implements SluggableInterface
{   
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];
   protected $fillable = ['name'];

   // Relationships =============================================
   public function employee()
   {
       return $this->belongsTo('App\Employee');
   }
   
   // Methods ===================================================
   
   // Scopes ====================================================
   
   // Accessors =================================================
   
   // Mutators ==================================================
   


}
