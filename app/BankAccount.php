<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['bank_id', 'account_number'];

    // Relationships =============================================
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
    // Methods ===================================================
    
    // Scopes ====================================================
    
    // Accessors =================================================
    
    // Mutators ==================================================
    
}
