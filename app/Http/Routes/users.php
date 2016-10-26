<?php

/**
 * ===========================================================
 * Users
 */
Route::bind('users', function($id){	
	return App\User::whereId($id)
		->with('roles.perms')
		->firstOrFail();
});
Route::resource('users', 'UsersController');
