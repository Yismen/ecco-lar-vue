<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    protected $fillable = ['date', 'employee_id', 'name', 'hours', 'reason_id', 'type_id'];

    // Relationships =============================================
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function reason()
    {
        return $this->belongsTo('App\Reason');
    }

    // Methods ===================================================

// Scopes ====================================================

// Accessors =================================================

// Mutators ==================================================
}
