<?php

/**
 * ===========================================================
 * Permissions
 */
Route::bind('permission', function ($name) {
    return App\Permission::
        whereName($name)
        ->with('roles')
        ->firstOrFail();
});
Route::resource('permissions', 'PermissionsController');

// /**
//  * permissions index route
//  */
// Route::get('permissions', [
// 	'as'=>'permissions.index',
// 	'uses'=>'PermissionsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_viewer'],
// ]);

// /**
//  * permissions create route
//  */
// Route::get('permissions/create', [
// 	'as'=>'permissions.create',
// 	'uses'=>'PermissionsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_editor'],
// ]);

// /**
//  * permissions store route
//  */
// Route::post('permissions', [
// 	'as'=>'permissions.store',
// 	'uses'=>'PermissionsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_editor'],
// ]);

// Route::bind('permissions', function($name){
// 	return App\Permission::whereName($name)->with('roles')->firstOrFail();
// });

// // Route::resource('permissions', 'permissions', [

// // ]);

// /**
//  * permissions show route
//  */
// Route::get('permissions/{permissions}', [
// 	'as'=>'permissions.show',
// 	'uses'=>'PermissionsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_viewer'],
// ]);

// /**
//  * permissions edit route
//  */
// Route::get('permissions/{permissions}/edit', [
// 	'as'=>'permissions.edit',
// 	'uses'=>'PermissionsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_editor'],
// ]);

// /**
//  * permissions update route
//  */
// Route::put('permissions/{permissions}', [
// 	'as'=>'permissions.update',
// 	'uses'=>'PermissionsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_editor'],
// ]);

// /**
//  * permissions destroy route
//  */
// Route::delete('permissions/{permissions}', [
// 	'as'=>'permissions.destroy',
// 	'uses'=>'PermissionsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['permissions_editor'],
// ]);
