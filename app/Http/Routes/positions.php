<?php

/**
 * Positions Routes
 * ------------------------------------------------
 */

Route::bind('positions', function($id){
	return App\Position::whereId($id)
		->with('departments')
		->with('payments')
		->firstOrFail();
});

Route::resource('positions', 'PositionsController');

// /**
//  * positions index route
//  */
// Route::get('positions', [
// 	'as'=>'positions.index',
// 	'uses'=>'PositionsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_viewer'],
// ]);

// /**
//  * positions create route
//  */
// Route::get('positions/create', [
// 	'as'=>'positions.create',
// 	'uses'=>'PositionsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_editor'],
// ]);

// /**
//  * positions store route
//  */
// Route::post('/positions', [
// 	'as'=>'positions.store',
// 	'uses'=>'PositionsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_editor'],
// ]);

// Route::bind('positions', function($id){
// 	return App\Position::whereId($id)
// 		->with('departments')
// 		->with('payments')
// 		->firstOrFail();
// });


// // Route::resource('positions', 'PositionsController', [
	
// // ]);

// /**
//  * positions show route
//  */
// Route::get('positions/{positions}', [
// 	'as'=>'positions.show',
// 	'uses'=>'PositionsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_viewer'],
// ]);

// /**
//  * positions edit route
//  */
// Route::get('/positions/{positions}/edit', [
// 	'as'=>'positions.edit',
// 	'uses'=>'PositionsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_editor'],
// ]);

// /**
//  * positions update route
//  */
// Route::put('/positions/{positions}', [
// 	'as'=>'positions.update',
// 	'uses'=>'PositionsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_editor'],
// ]);

// /**
//  * positions destroy route
//  */
// Route::delete('/positions/{positions}', [
// 	'as'=>'positions.destroy',
// 	'uses'=>'PositionsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['positions_editor'],
// ]);


