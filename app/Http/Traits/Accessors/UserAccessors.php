<?php

namespace App\Http\Traits\Accessors;

use App\Role;

trait UserAccessors
{
    
    public function getRolesListAttribute()
    {   
        // $roles = \Auth::user()->is_admin ? $roles : $this->roles();
        return \Auth::user()->is_admin
            ? Role::orderBy('display_name')
                ->with(['menus'=>function($query){
                    return $query->orderBy('display_name');
                }])
                ->get()
            : $this->roles()
                ->orderBy('display_name')
                ->with(['menus'=>function($query){
                    return $query->orderBy('display_name');
                }])
                ->get();
    }

    public function getActiveListAttribute()
    {   
        return ['1'=>'Active User','0' => 'Inactive'];
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['is_active'];
    }

    public function getAdminListAttribute()
    {   
        return ['0' => 'Not Admin', '1'=>'Admin User'];
    }

    public function getLayoutAttribute()
    {
        return 'skin-black';
    }

}