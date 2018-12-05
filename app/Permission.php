<?php

namespace App;

use Spatie\Permission\Models\Permission as EmpatiePermission;

class Permission extends EmpatiePermission
{
    protected $fillable = ['name', 'guard_name', 'resource'];

    protected $actions = [
            'view',
            'edit',
            'create',
            'destroy'
        ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = trim(str_slug($name));
    }

    public function setResourceAttribute($resource)
    {
        $this->attributes['resource'] = trim(str_slug($resource));
    }

    public function getRolesListAttribute()
    {
        return Role::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function createPermission($request)
    {
        if ($request->exists('not_resource')) {
            return $this->createNonResourcePermission($request);
        }

        return createResourcePermission($request);
    }

    public function updatePermission($request)
    {
        $resource = explode("-", str_slug($request->name), 2);
        $resource = count($resource) > 1 ? $resource[1] : $resource[0];

        $request->merge([
            'resource' => $resource
        ]);

        $this->update($request->only('name', 'resource'));

        $this->roles()->sync((array) $request->roles);

        return $this;
    }

    protected function getSelectedActions($actions)
    {
        if (in_array('all', $actions)) {
            return $this->actions;
        }

        $selected = [];

        foreach ($actions as $key => $value) {
            $selected[$value] = $value;
        }

        return $selected;
    }

    protected function getParsedPermission($action, $resource)
    {
        return $action. ' ' . $resource;
    }

    protected function createNonResourcePermission($request)
    {
        $permission = $this->create([
            'name' => $request->resource,
            'resource' => $request->resource,
        ]);

        $permission->roles()->sync((array) $request->roles);

        return $permission;
    }

    protected function createResourcePermission($request)
    {
        $actions = $this->getSelectedActions($request->actions);

        foreach ($actions as $action) {
            $permission_name = $this->getParsedPermission($action, $request->resource);

            $permission = $this->where('name', $permission_name)->first();

            if ($permission) {
                $permission->delete();
            }

            $permission = $this->create(['name' => $permission_name, 'resource' => trim($request->resource)]);

            $permission->roles()->sync((array) $request->roles);

            return $permission;
        }
    }
}
