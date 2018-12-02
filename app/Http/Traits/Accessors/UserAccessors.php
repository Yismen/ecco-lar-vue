<?php

namespace App\Http\Traits\Accessors;

use App\Role;
use Cache;

trait UserAccessors
{
    public function getRolesListAttribute()
    {
        return Cache::rememberForever('menus', function () {
            return \Auth::user()->is_admin
            ? Role::with(['menus' => function ($query) {
                return $query;
            }])->get()
            : $this->roles()
                ->with(['menus' => function ($query) {
                    return $query;
                }])->get();
        });
    }

    public function getActiveListAttribute()
    {
        return ['1' => 'Active User', '0' => 'Inactive'];
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['is_active'];
    }

    public function getAdminListAttribute()
    {
        return ['0' => 'Not Admin', '1' => 'Admin User'];
    }

    public function getLayoutAttribute()
    {
        return 'skin-black';
    }
}
