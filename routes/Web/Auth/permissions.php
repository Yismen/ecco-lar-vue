<?php

Route::bind('permission', function ($name) {
    return App\Permission::
        whereName($name)
        ->with('roles')
        ->firstOrFail()->append('roles-list');
});
Route::resource('permissions', 'PermissionsController');