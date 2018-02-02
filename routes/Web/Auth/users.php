<?php

Route::bind('user', function($id){	
	return App\User::whereId($id)
		->with('roles.perms')
		->firstOrFail();
});

Route::get('users/reset', 'UsersController@reset')->name('users.reset');
Route::post('users/reset', 'UsersController@change')->name('users.change');

Route::get('users/force_reset/{user}', 'UsersController@force_reset')->name('users.force_reset');
Route::post('users/force_reset/{user}', 'UsersController@force_change')->name('users.force_change');
Route::post('users/update_settings/{user}', 'UsersController@updateSettings')->name('users.update_settings');

Route::resource('users', 'UsersController');
