<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = ['employee_id', 'name', 'date', 'unique_id', 'regulars', 'nightly', 'holidays', 'training'];

    protected $dates = ['date'];
    // Relationships =============================================
    public function employees()
    {
        return $this->belongsTo('App\Employees');
    }
    // Methods ===================================================
    
    // Scopes ====================================================
    
    // Accessors =================================================
    
    // Mutators ==================================================
    
}
