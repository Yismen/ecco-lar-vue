<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = ['employee_id', 'name', 'date', 'unique_id', 'regulars', 'nightly', 'holidays', 'training', 'overtime'];

    protected $dates = ['date'];
    // Relationships =============================================
    public function employee()
    {
        return $this->belongsTo('App\Employee')->select('id', 'position_id', 'first_name', 'second_first_name', 'last_name', 'second_last_name');
    }
    // Methods ===================================================
    
    // Scopes ====================================================
    
    // Accessors =================================================
    
    // Mutators ==================================================
}
