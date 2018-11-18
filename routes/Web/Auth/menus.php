<?php

Route::bind('menu', function ($id) {
    return App\Menu::with('roles')
        ->findOrFail($id)->append('roles-list');
});
Route::resource('menus', 'MenusController');
