<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Menu extends Model
{
    protected $fillable = ['name', 'display_name', 'description', 'icon'];

    protected $guarded = [];

    /**
     * a module belongs to many roles
     *
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRolesListAttribute()
    {
        return $roles =  Role::pluck('name', 'id')->toArray();
    }

    // public function setNameAttribute($name)
    // {
    //     return $this->attributes['name'] = str_slug($name, '-');
    // }

    public function setDisplayNameAttribute($display_name)
    {
        return $this->attributes['display_name'] = ucwords($display_name);
    }

    public function addMenu($request)
    {        
        $name = $this->parseName($request);

        if ($exists = $this->where('name', $request->name)->get()) {
            foreach ($exists as $model) {
                $model->delete();
            }
        }

        $menu = $this->create($request->only(['name', 'display_name', 'description', 'icon']));

        $this->createPermissions($name);

        Cache::forget('menus');

        $menu->roles()->sync((array) $request->roles);

        return $menu;
    }

    public function updateMenu($request)
    {
        $name = $this->parseName($request);

        $this->update($request->only(['name', 'display_name', 'description', 'icon']));

        Cache::forget('menus');

        $this->roles()->sync((array) $request->roles);

        return $this;
    }

    public function removeMenu()
    {
        $this->delete();

        Cache::forget('menus');

        $name = starts_with($this->name, 'admin/') ?
            str_slug(explode('admin/', $this->name, 2)[1]) :
            $this->name;

        $permissions = Permission::where('resource', $name)->get();

        foreach($permissions as $permission) {
            $permission->delete();
        }
    }

    private function parseName($request)
    {
        $name = str_slug($request->name);


        if (starts_with($request->name, 'admin')) {
            $name = str_slug(explode('admin', $name, 2)[1]);
        }
        
        $request->merge(['name' => $name]);
        if ($request->is_admin) {
            $request->merge(['name' => 'admin/'. $request->name]);
        }

        return $name;
    }

    private function createPermissions($name)
    {        
        $names = ['create', 'view', 'edit', 'destroy'];

        foreach ($names as $key => $value) {
            $new_name = $value.'-'.$name;

            if (! Permission::where('name', $new_name)->first()) {
                Permission::create([
                    'name' => $new_name, 
                    'resource' => $name
                ]);
            }
        }
    }
}
