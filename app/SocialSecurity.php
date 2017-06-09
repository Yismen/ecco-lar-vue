<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{    
    protected $fillable = ['number'];

    // Relationships =============================================
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

}
