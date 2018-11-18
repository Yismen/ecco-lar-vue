<?php

/**
 * Roles Routes
 */

Route::bind('role', function ($role) {
    return App\Role::whereName($role)
                ->with(['permissions' => function ($query) {
                    $query->orderBy('permissions.name');
                    return $query;
                }])
                ->with(['users' => function ($query) {
                    $query->orderBy('users.name');
                }])
                ->with(['menus' => function ($query) {
                    $query->orderBy('menus.display_name');
                    return $query;
                }])

                ->firstOrFail();
});

Route::resource('roles', 'RolesController');
