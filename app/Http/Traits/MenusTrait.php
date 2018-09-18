<?php

namespace App\Http\Traits;

use App\Menu;
use App\Role;
use App\Permission;
use Cache;

trait MenusTrait
{
    public function validateRequest($request, $menu)
    {
        $this->validate($request, [
            'name' => 'required|unique:menus,name,' . $menu->id . ',id',
            'display_name' => 'required|unique:menus,display_name,' . $menu->id . ',id',
            'roles_list' => 'required'
        ]);

        return $this;
    }

    /**
     * handle the process of creating the menu item
     *
     * @param  [object] $menu     [description]
     * @param  [object] $requests [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    private function createMenu($menu, $requests, $permission)
    {
        $menu = $menu->create($requests->all());

        Cache::forget('menues_for_user_' . auth()->user()->id);

        $this->createPermissions($menu, $permission);

        return $this->syncRoles($menu, $requests->get('roles_list'));
    }

    /**
     * handle the process of creating the menu item
     *
     * @param  [object] $menu     [description]
     * @param  [object] $requests [description]
     * @return [process]           [the action of syncing the menu-roles]
     */
    private function updateMenu($menu, $requests)
    {
        $menu->update($requests->all());

        Cache::forget('menues_for_user_' . auth()->user()->id);

        return $this->syncRoles($menu, $requests->get('roles_list'));
    }

    /**
     * sync the roles model with the array selected by the user
     *
     * @param  Menu   $menu  [description]
     * @param  Array  $roles [description]
     * @return [type]        [description]
     */
    private function syncRoles(Menu $menu, array $roles = null)
    {
        return $menu->roles()->sync((array) $roles);
    }

    private function createPermissions($menu, Permission $permission)
    {
        $this->permission = $permission;

        $this->createPermission($menu->name, 'view');
        $this->createPermission($menu->name, 'create');
        $this->createPermission($menu->name, 'edit');
        $this->createPermission($menu->name, 'destroy');

        return $this;
    }

    public function createPermission($menu_name, $name)
    {
        $names = [
            'create' => ' Creator',
            'view' => ' Viewer',
            'edit' => ' Editor',
            'destroy' => ' Remover',
        ];

        $menu_name = str_replace(['_', '-', '.'], ' ', $menu_name);

        $permission = [
            'name' => str_slug($name . ' ' . $menu_name, $separator = '_'),
            'display_name' => ucwords($menu_name . $names[$name]),
            'description' => ucwords('Can ' . $name . ' ' . $menu_name . '\'s items'),
        ];

        return $this->permission->create($permission);
    }

    private function destroyPermissions($menu, Permission $permission)
    {
        /**
         * Editor Role
         */
        $editor = $permission->whereName('edit_' . $menu->name)->first();

        if ($editor) {
            $editor->delete();
        }

        /**
         * Editor Role
         */

        $viewer = $permission->whereName('view_' . $menu->name)->first();

        if ($viewer) {
            $viewer->delete();
        }
        /**
         * Destroy Role
         */
        $destroyer = $permission->whereName('destroy_' . $menu->name)->first();
        /**
         * Create Role
         */
        $destroyer = $permission->whereName('create_' . $menu->name)->first();

        if ($destroyer) {
            $destroyer->delete();
        }
    }
}
