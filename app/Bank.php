<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name'];

    // Relationships =============================================
    public function accounts()
    {
        return hasMany('App\BankAccount');
    }
    // Methods ===================================================
    
    // Scopes ====================================================
    
    // Accessors =================================================
    
    // Mutators ==================================================
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
