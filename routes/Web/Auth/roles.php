<?php

/**
 * Roles Routes
 */

Route::bind('role', function ($role) {
    return App\Role::whereName($role)
                ->with(['perms' => function ($query) {
                    $query->orderBy('permissions.display_name');
                }])
                ->with(['users' => function ($query) {
                    $query->orderBy('users.name');
                }])
                ->with(['menus' => function ($query) {
                    $query->orderBy('menus.display_name');
                }])

                ->firstOrFail();
});

Route::resource('roles', 'RolesController');
