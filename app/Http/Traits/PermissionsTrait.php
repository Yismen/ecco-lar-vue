<?php

namespace App\Http\Traits;

use App\Permission;

trait PermissionsTrait
{
    /**
     * handle the process of creating the menu item
     *
     * @param  [object] $permission     [description]
     * @param  [object] $request [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    private function createPermission($permission, $request)
    {
        $methods = [
            'view' => 'Permission to view ',
            'edit' => 'Permission to edit ',
            'create' => 'Permission to create ',
            'destroy' => 'Permission to destroy '
        ];
        $selected = [];

        if (in_array('all', $request->permission)) {
            $selected = $methods;
        } else {
            foreach ($request->permission as $value) {
                $selected[$value] = $methods[$value];
            }
        }

        foreach ($selected as  $key => $value) {
            $plural_resource = str_plural($request->resource);
            $name = $key . '_' . $plural_resource;
            if ($exists = $permission->where('name', $name)->first()) {
                $permission = $exists;
            } else {
                $permission = new Permission;
                $permission->name = $name;
                $permission->display_name = trim(ucwords($plural_resource . ': ' . $value));
                $permission->description = $methods[$key] . $plural_resource;
            }
            // dd($permission, $selected);
            $permission->save();
        }

        return $this->syncRoles($permission, $request->roles_list);
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
        return $this->createPermission($permission, $request);
    }

    /**
     * sync the roles model with the array selected by the user
     *
     * @param  Menu   $permission  [description]
     * @param  Array  $roles [description]
     * @return [type]        [description]
     */
    private function syncRoles(Permission $permission, array $roles = null)
    {
        return $permission->roles()
            ->sync((array) $roles);
    }
}
