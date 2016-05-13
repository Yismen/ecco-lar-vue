<?php

/**
 * punches Routes
 * ------------------------------------------------
 */
// Route::get('punches/{punches}/employees/{employees}', function($login, $employee){
// 	return $employee;
// });

// Route::get('profiles/{profiles}/articles/{articles}', function($login, $employee){
// 	return $login;
// });

/**
 * punches index route
 */
Route::get('punches', [
	'as'=>'punches.index',
	'uses'=>'PunchesController@index',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_viewer'],
]);

/**
 * punches create route
 */
Route::get('punches/create', [
	'as'=>'punches.create',
	'uses'=>'PunchesController@create',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_editor'],
]);

/**
 * punches store route
 */
Route::post('/punches', [
	'as'=>'punches.store',
	'uses'=>'PunchesController@store',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_editor'],
]);

Route::bind('punches', function($punch){
	return App\Punch::wherePunch($punch)
		->with('employee')
		->firstOrFail();
});


// Route::resource('punches', 'PunchesController', [
	
// ]);

/**
 * punches show route
 */
Route::get('punches/{punches}', [
	'as'=>'punches.show',
	'uses'=>'PunchesController@show',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_viewer'],
]);

/**
 * punches edit route
 */
Route::get('/punches/{punches}/edit', [
	'as'=>'punches.edit',
	'uses'=>'PunchesController@edit',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_editor'],
]);

/**
 * punches update route
 */
Route::put('/punches/{punches}', [
	'as'=>'punches.update',
	'uses'=>'PunchesController@update',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_editor'],
]);

/**
 * punches destroy route
 */
Route::delete('/punches/{punches}', [
	'as'=>'punches.destroy',
	'uses'=>'PunchesController@destroy',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['punches_editor'],
]);


