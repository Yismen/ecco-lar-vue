<?php

/**
 * Roles Routes
 */

Route::bind('role', function ($role) {
    return App\Role::whereName($role)
        ->with(['permissions' => function ($query) {
            $query->orderBy('resource');
        }])
        ->with(['users' => function ($query) {
            $query->orderBy('name');
        }])
        ->with(['menus' => function ($query) {
            $query->orderBy('display_name');
        }])
        ->firstOrFail();
});

Route::resource('roles', 'RolesController');
