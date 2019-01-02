<?php

namespace App\Http\Traits\Accessors;

use App\Role;
use Cache;

trait UserAccessors
{

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

    public function getRolesListAttribute()
    {
        return Role::get(['name', 'id']);
    }
}
