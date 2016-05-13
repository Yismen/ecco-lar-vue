<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ==========================================
     * Relationships
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    /**
     * ========================================
     * Methods
     */
    
    public function owns($model)
    {
        return $this->id == $model->user_id;
    }
    
    /**
     * ==========================================
     * Scopes
     */
    
    /**
     * ======================================
     * Accessors
     */ 

    public function getRolesListAttribute()
    {   
        return \Auth::user()->is_admin
            ? \App\Role::with('menus')->get()
            : $this->roles()->get();
    }
    
    /**
     * =======================================
     * Mutators
     */
}
