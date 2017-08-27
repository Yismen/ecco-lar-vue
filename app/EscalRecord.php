<?php

namespace App;

use App\User;
use App\EscalClient;
use App\EscalationHour;
use Illuminate\Database\Eloquent\Model;

class EscalRecord extends Model
{
    protected $fillable = ['tracking', 'escal_client_id', 'is_bbb', 'insert_date'];

    protected $dates = ['insert_date'];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $with = ['escal_client'];
    // protected $appends = ['client'];

    /**
     * ==========================================
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo('App\User')
            ->select(['name', 'id']);
    }

    public function hour()
    {
        return $this->belongsTo('App\EscalationHour', 'escal_client_id', 'client_id', 'user_id', 'user_id');
    }

    public function escal_client()
    {
        return $this->belongsTo('App\EscalClient');
    }

    public function getClientAttribute()
    {
        return $this->escal_client;
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
