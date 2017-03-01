<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EscalClient;
use App\User;

class EscalRecord extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['tracking', 'escal_client_id'];

    /**
     * ==========================================
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function escal_client()
    {
        return $this->belongsTo('App\EscalClient');
    }
    
    /**
     * ========================================
     * Methods
     */
    public function createForUser($request)
    {
        
    }
    
    /**
     * ==========================================
     * Scopes
     */
    
    /**
     * ======================================
     * Accessors
     */
    public function getEscalationsClientsAttribute()
    {
        return EscalClient::lists('name', 'id');
    }

    public function getEscalationsClientIdAttribute()
    {
        return $this->escal_client()->lists('id')->toArray();
    }
    
    /**
     * =======================================
     * Mutators
     */
}
