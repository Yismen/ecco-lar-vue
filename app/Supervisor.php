<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

	/**
     * ==========================================
     * Relationships
     */
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
    
    /**
     * ========================================
     * Methods
     */
    
    /**
     * ==========================================
     * Scopes
     */
    
    /**
     * ======================================
     * Accessors
     */
    
    /**
     * =======================================
     * Mutators
     */

}
