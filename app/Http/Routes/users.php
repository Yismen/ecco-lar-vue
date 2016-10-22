<?php

/**
 * ===========================================================
 * Users
 */
Route::bind('users', function($username){	
	return App\User::whereUsername($username)
		->with('roles.perms')
		->firstOrFail();
});
Route::resource('users', 'UsersController');
// Route::resource('users', 'UsersController', ['except' => [
//     'create', 'store'
// ]]);
