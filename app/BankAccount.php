<?php

namespace App;

use App\DainsysModel as Model;

class BankAccount extends Model
{
    protected $fillable = ['bank_id', 'account_number'];

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
