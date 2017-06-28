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

Route::get('users/force_reset/{user}', 'UsersController@force_reset')->name('admin.users.force_reset');
Route::post('users/force_reset/{user}', 'UsersController@force_change')->name('admin.users.force_change');
Route::post('users/update_settings/{user}', 'UsersController@updateSettings')->name('admin.users.update_settings');

Route::resource('users', 'UsersController');
