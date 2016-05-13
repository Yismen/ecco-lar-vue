<?php

/**
 * terminations Routes
 * ------------------------------------------------
 */


/**
 * terminations index route
 */
Route::get('terminations', [
	'as'=>'terminations.index',
	'uses'=>'TerminationsController@index',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_viewer'],
]);

/**
 * terminations create route
 */
Route::get('terminations/create', [
	'as'=>'terminations.create',
	'uses'=>'TerminationsController@create',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_editor'],
]);

/**
 * terminations store route
 */
Route::post('/terminations', [
	'as'=>'terminations.store',
	'uses'=>'TerminationsController@store',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_editor'],
]);

Route::bind('terminations', function($id){
	return App\Termination::whereId($id)
		->with('employee')
		->firstOrFail();
});


// Route::resource('terminations', 'TerminationsController', [
	
// ]);

/**
 * terminations show route
 */
Route::get('terminations/{terminations}', [
	'as'=>'terminations.show',
	'uses'=>'TerminationsController@show',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_viewer'],
]);

/**
 * terminations edit route
 */
Route::get('/terminations/{terminations}/edit', [
	'as'=>'terminations.edit',
	'uses'=>'TerminationsController@edit',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_editor'],
]);

/**
 * terminations update route
 */
Route::put('/terminations/{terminations}', [
	'as'=>'terminations.update',
	'uses'=>'TerminationsController@update',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_editor'],
]);

/**
 * terminations destroy route
 */
Route::delete('/terminations/{terminations}', [
	'as'=>'terminations.destroy',
	'uses'=>'TerminationsController@destroy',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['terminations_editor'],
]);


