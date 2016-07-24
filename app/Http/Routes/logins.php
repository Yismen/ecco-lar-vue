<?php

/**
 * logins Routes
 * ------------------------------------------------
 */
// Route::get('logins/{logins}/employees/{employees}', function($login, $employee){
// 	return $employee;
// });

// Route::get('profiles/{profiles}/articles/{articles}', function($login, $employee){
// 	return $login;
// });

/**
 * ===========================================================
 * Logins
 */
Route::bind('logins', function($login){	
	return App\Login::whereId($login)
		->with('employee')
		->with('system')
		->firstOrFail();
});
Route::resource('logins', 'LoginsController');

// Route::post('logins/updateAddress/{logins}', [
// 	'as'=>'logins.updateAddress',
// 	'uses'=>'LoginsController@updateAddress',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);

// Route::post('logins/updatePhoto/{logins}', [
// 	'as'=>'logins.updatePhoto',
// 	'uses'=>'LoginsController@updatePhoto',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);


// /**
//  * logins index route
//  */
// Route::get('logins', [
// 	'as'=>'logins.index',
// 	'uses'=>'LoginsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_viewer'],
// ]);

// /**
//  * logins create route
//  */
// Route::get('logins/create', [
// 	'as'=>'logins.create',
// 	'uses'=>'LoginsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);

// /**
//  * logins store route
//  */
// Route::post('/logins', [
// 	'as'=>'logins.store',
// 	'uses'=>'LoginsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);

// Route::bind('logins', function($id){
// 	return App\Login::whereId($id)
// 		->with('employee')
// 		->with('system')
// 		->firstOrFail();
// });


// // Route::resource('logins', 'LoginsController', [
	
// // ]);

// /**
//  * logins show route
//  */
// Route::get('logins/{logins}', [
// 	'as'=>'logins.show',
// 	'uses'=>'LoginsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_viewer'],
// ]);

// /**
//  * logins edit route
//  */
// Route::get('/logins/{logins}/edit', [
// 	'as'=>'logins.edit',
// 	'uses'=>'LoginsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);

// /**
//  * logins update route
//  */
// Route::put('/logins/{logins}', [
// 	'as'=>'logins.update',
// 	'uses'=>'LoginsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);

// /**
//  * logins destroy route
//  */
// Route::delete('/logins/{logins}', [
// 	'as'=>'logins.destroy',
// 	'uses'=>'LoginsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['logins_editor'],
// ]);


