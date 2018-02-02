<?php

Route::bind('menu', function($menu){
	return App\Menu::whereName($menu)
		->with('roles')
		->firstOrFail();
});
Route::resource('menus', 'MenusController');
