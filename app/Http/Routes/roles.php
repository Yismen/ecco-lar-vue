<?php

/**
 * Roles Routes
 */

Route::bind('roles', function($role){
	return App\Role::whereName($role)
				->with(['perms' => function($query){
					$query->orderBy('permissions.display_name');
				}])
				->with(['users'=>function($query){
					$query->orderBy('users.name');
				}])
				->with(['menus'=>function($query){
					$query->orderBy('menus.display_name');
				}])

				->firstOrFail();
});

Route::resource('roles', 'RolesController');

// 	/**
// 	 * roles routes
// 	 * ------------------------------------------------------
// 	 */


// /**
//  * roles index route
//  */
// Route::get('roles', [
// 	'as'=>'roles.index',
// 	'uses'=>'RolesController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor','roles_viewer'],
// ]);

// /**
//  * roles create route
//  */
// Route::get('roles/create', [
// 	'as'=>'roles.create',
// 	'uses'=>'RolesController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor'],
// ]);

// /**
//  * roles store route
//  */
// Route::post('roles', [
// 	'as'=>'roles.store',
// 	'uses'=>'RolesController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor'],
// ]);


// Route::bind('roles', function($name){
// 	return App\Role::whereName($name)
// 		->with('users')
// 		->with('menus')
// 		->with('perms')
// 		->firstOrFail();
// });

// // Route::resource('roles', 'roles', [

// // ]);

// /**
//  * roles show route
//  */
// Route::get('roles/{roles}', [
// 	'as'=>'roles.show',
// 	'uses'=>'RolesController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor','roles_viewer'],
// ]);

// /**
//  * roles edit route
//  */
// Route::get('roles/{roles}/edit', [
// 	'as'=>'roles.edit',
// 	'uses'=>'RolesController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor'],
// ]);

// /**
//  * roles update route
//  */
// Route::put('roles/{roles}', [
// 	'as'=>'roles.update',
// 	'uses'=>'RolesController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor'],
// ]);

// /**
//  * roles destroy route
//  */
// Route::delete('roles/{roles}', [
// 	'as'=>'roles.destroy',
// 	'uses'=>'RolesController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['roles_editor'],
// ]);




