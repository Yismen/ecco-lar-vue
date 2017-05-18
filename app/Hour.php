<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = ['employee_id', 'name', 'date', 'regulars', 'overtime', 'nightly', 'holidays', 'training'];
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
