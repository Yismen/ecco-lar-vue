<?php


	/**
	 * menus routes
	 * ------------------------------------------------------
	 */


/**
 * ===========================================================
 * Menus
 */
Route::bind('menus', function($menu){
	return App\Menu::whereName($menu)
		->with('roles')
		->firstOrFail();
});
Route::resource('menus', 'MenusController');

// /**
//  * menus index route
//  */
// Route::get('menus', [
// 	'as'=>'menus.index',
// 	'uses'=>'MenusController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_viewer'],
// ]);

// /**
//  * menus create route
//  */
// Route::get('menus/create', [
// 	'as'=>'menus.create',
// 	'uses'=>'MenusController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_editor'],
// ]);

// /**
//  * menus store route
//  */
// Route::post('menus', [
// 	'as'=>'menus.store',
// 	'uses'=>'MenusController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_editor'],
// ]);


// Route::bind('menus', function($name){
// 	return App\Menu::whereName($name)->with('roles')->firstOrFail();
// });

// // Route::resource('menus', 'menus', [

// // ]);

// /**
//  * menus show route
//  */
// Route::get('menus/{menus}', [
// 	'as'=>'menus.show',
// 	'uses'=>'MenusController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_viewer'],
// ]);

// /**
//  * menus edit route
//  */
// Route::get('menus/{menus}/edit', [
// 	'as'=>'menus.edit',
// 	'uses'=>'MenusController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_editor'],
// ]);

// /**
//  * menus update route
//  */
// Route::put('menus/{menus}', [
// 	'as'=>'menus.update',
// 	'uses'=>'MenusController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_editor'],
// ]);

// /**
//  * menus destroy route
//  */
// Route::delete('menus/{menus}', [
// 	'as'=>'menus.destroy',
// 	'uses'=>'MenusController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['menus_editor'],
// ]);


