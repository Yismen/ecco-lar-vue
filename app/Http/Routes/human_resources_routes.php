<?php


	/**
	 * human_resources routes
	 * ------------------------------------------------------
	 */


/**
 * human_resources index route
 */
Route::get('human_resources', [
	'as'=>'human_resources.index',
	'uses'=>'HumanResourcesController@index',	
]);

// /**
//  * human_resources create route
//  */
// Route::get('human_resources/create', [
// 	'as'=>'human_resources.create',
// 	'uses'=>'HumanResourcesController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_editor'],
// ]);

// /**
//  * human_resources store route
//  */
// Route::post('human_resources', [
// 	'as'=>'human_resources.store',
// 	'uses'=>'HumanResourcesController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_editor'],
// ]);


// Route::bind('human_resources', function($username){
// 	return App\Profile::whereUsername($username)->firstOrFail();
// });

// // Route::resource('human_resources', 'HumanResourcesController', [

// // ]);

// /**
//  * human_resources show route
//  */
// Route::get('human_resources/{human_resources}', [
// 	'as'=>'human_resources.show',
// 	'uses'=>'HumanResourcesController@show',
// 	// 'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_viewer'],
// ]);

// /**
//  * human_resources edit route
//  */
// Route::get('human_resources/{human_resources}/edit', [
// 	'as'=>'human_resources.edit',
// 	'uses'=>'HumanResourcesController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_editor'],
// ]);

// /**
//  * human_resources update route
//  */
// Route::put('human_resources/{human_resources}', [
// 	'as'=>'human_resources.update',
// 	'uses'=>'HumanResourcesController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_editor'],
// ]);

// /**
//  * human_resources destroy route
//  */
// Route::delete('human_resources/{human_resources}', [
// 	'as'=>'human_resources.destroy',
// 	'uses'=>'HumanResourcesController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['human_resources_editor'],
// ]);


