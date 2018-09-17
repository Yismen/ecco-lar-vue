<?php

namespace App;

use App\Role;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name','display_name', 'description'];

    /**
     * a module belongs to many roles
     *
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    public function getRolesListAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    }
}

// use Illuminate\Database\Eloquent\Model;

// class Permission extends Model {

// 	//

// }
