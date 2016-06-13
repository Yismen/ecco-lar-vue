<?php

/**
 * ===========================================================
 * Users
 */
Route::bind('users', function($username){	
	return App\User::whereUsername($username)
		->with('roles')
		->firstOrFail();
});

Route::resource('users', 'UsersController');


// /**
//  * users index route
//  */
// Route::get('users', [
// 	'as'=>'users.index',
// 	'uses'=>'UsersController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor', 'users_viewer'],
// ]);

// /**
//  * users create route
//  */
// Route::get('users/create', [
// 	'as'=>'users.create',
// 	'uses'=>'UsersController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor'],
// ]);

// /**
//  * users store route
//  */
// Route::post('users', [
// 	'as'=>'users.store',
// 	'uses'=>'UsersController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor'],
// ]);


// Route::bind('users', function($username){
// 	return App\User::whereUsername($username)->with('roles')->firstOrFail();
// });

// // Route::resource('users', 'users', [

// // ]);

// /**
//  * users show route
//  */
// Route::get('users/{users}', [
// 	'as'=>'users.show',
// 	'uses'=>'UsersController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor', 'users_viewer'],
// ]);

// /**
//  * users edit route
//  */
// Route::get('users/{users}/edit', [
// 	'as'=>'users.edit',
// 	'uses'=>'UsersController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor'],
// ]);

// /**
//  * users update route
//  */
// Route::put('users/{users}', [
// 	'as'=>'users.update',
// 	'uses'=>'UsersController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor'],
// ]);

// /**
//  * users destroy route
//  */
// Route::delete('users/{users}', [
// 	'as'=>'users.destroy',
// 	'uses'=>'UsersController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['users_editor'],
// ]);


// // 