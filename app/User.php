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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    /**
     * ========================================
     * Methods
     */
    
    public function owns($model)
    {
        return $this->id == $model->user_id;
    }

    public function userHasProfileOrCreate()
    {
        // if the user is logged in check if has profile, otherwies ask to create one.
        
        if (Auth::check()) {
            if (Auth::user()->has('profile')) {
                return $this->profile;
            }
        }
        return false;
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

    public function getActiveListAttribute()
    {   
        return ['0' => 'Inactive', '1'=>'Active User'];
    }

    public function getAdminListAttribute()
    {   
        return ['0' => 'Not Admin', '1'=>'Admin User'];
    }
    
    /**
     * =======================================
     * Mutators
     */
}
