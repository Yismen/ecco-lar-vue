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

Route::get('users/reset', 'UsersController@reset')->name('admin.users.reset');
Route::post('users/reset', 'UsersController@change')->name('admin.users.change');

Route::resource('users', 'UsersController');
