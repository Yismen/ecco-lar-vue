<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\Mutators\UserMutators;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Http\Traits\Accessors\UserAccessors;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Http\Traits\Relationships\UserRelationships;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use EntrustUserTrait, UserAccessors, UserRelationships, UserMutators;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'is_active', 'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('active', function(Builder $builder) {
    //         $builder->where('is_active', '=', 1);
    //     });
    // }
    
    public function owns($model)
    {
        return $this->id == $model->user_id;
    }

    public function userHasProfileOrCreate()
    {       
        if (Auth::check()) {
            if (Auth::user()->has('profile')) {
                return $this->profile;
            }
        }
        return false;
    }
    
}
