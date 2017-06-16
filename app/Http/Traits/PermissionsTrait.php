<?php

namespace App\Http\Traits;

use App\Permission;

trait PermissionsTrait
{
    /**
     * validate the request
     * @param  object $request    contaiains all the user's imputs
     * @param  object $permission is the current permission being updated.
     * @return instance             of the class.
     */
    public function validateRequest($request, $permission)
    {
        $this->validate($request, [
            'name'         => 'required|unique:permissions,name,'.$permission->id.',id',
            'display_name' => 'required',
            'roles_list'   => 'required|array|exists:roles,id',
        ]);

        return $this;
    }

    /**
     * handle the process of creating the menu item
     * 
     * @param  [object] $permission     [description]
     * @param  [object] $request [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    private function createPermission($permission, $request)
    {
        $this->permission = $permission->create($request->all());

        return $this->syncRoles($this->permission, $request->get('roles_list'));
    }

    /**
     * handle the process of creating the menu item
     * 
     * @param  [object] $permission     [description]
     * @param  [object] $request [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    private function updatePermission($permission, $request)
    {
        $permission->update($request->all());

        return $this->syncRoles($permission, $request->get('roles_list'));
    }

    /**
     * sync the roles model with the array selected by the user
     * 
     * @param  Menu   $permission  [description]
     * @param  Array  $roles [description]
     * @return [type]        [description]
     */
    private function syncRoles(Permission $permission, Array $roles = null)
    {
        return $permission->roles()
            ->sync((array) $roles);  
    }
}