<?php

namespace App;

use Spatie\Permission\Models\Role as EmpatieRole;
use Illuminate\Support\Facades\Cache;

class Role extends EmpatieRole
{
    protected $fillable = ['name', 'guard_name'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower(trim(str_slug($name)));
    }

    /**
     * Get a list of the users associated with this role.
     *
     * @return [type] [description]
     */
    public function getUsersListAttribute()
    {
        return User::orderBy('name')->get();
    }

    /**
     * Return a list of permissions associated with this role.
     *
     * @return [type] [description]
     */
    public function getPermissionsListAttribute()
    {
        return Permission::orderBy('resource')->get();
    }

    /**
     * Return a list of menus associated with current role.
     *
     * @return [type] [description]
     */
    public function getMenusListAttribute()
    {
        return Menu::orderBy('name')->get();
    }

    public function createRole($request)
    {
        $role = $this->create($request->only('name'));

        Cache::forget('menus');
        Cache::forget('roles');

        $this->syncRelations($role, $request);

        return $role;
    }

    /**
     * handle the process of creating the menu item
     *
     * @param  [object] $menu     [description]
     * @param  [object] $request [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    public function updateRole($request)
    {
        $this->update($request->all());

        Cache::forget('roles');
        Cache::forget('menus');

        return $this->syncRelations($this, $request);
    }

    /**
     * sync the roles model with the array selected by the user
     *
     * @param  Menu   $menu  [description]
     * @param  Array  $roles [description]
     * @return [type]        [description]
     */
    protected function syncRelations($role, $request)
    {
        $role->users()->sync((array) $request->users);
        $role->permissions()->sync((array) $request->input('permissions'));
        $role->menus()->sync((array) $request->input('menus'));

        return $role;
    }
}
