<?php

/**
 * productions Routes
 * ------------------------------------------------
 */
// Route::get('productions/{productions}/employees/{employees}', function($login, $employee){
// 	return $employee;
// });

// Route::get('profiles/{profiles}/articles/{articles}', function($login, $employee){
// 	return $login;
// });
// 
Route::get('productions/show_date/{date}', ['as'=>'admin.productions.show_date', 'uses'=>'ProductionsController@show_date']);
Route::get('productions/show_employee/{employee}', ['as'=>'admin.productions.show_employee', 'uses'=>'ProductionsController@show_employee']);

Route::bind('productions', function($id){

	return App\Production::whereId($id)
		->with('source')
		->firstOrFail();
});

Route::resource('productions', 'ProductionsController');
/**
 * productions index route
 */




// Route::get('productions', [
// 	'as'=>'productions.index',
// 	'uses'=>'ProductionsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_viewer'],
// ]);

// Route::get('productions/show_date/{date}', [
// 	'as'=>'productions.show_date',
// 	'uses'=>'ProductionsController@show_date',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_viewer'],
// ]);

// Route::get('productions/show_employee/{employee_id}', [
// 	'as'=>'productions.show_employee',
// 	'uses'=>'ProductionsController@show_employee',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_viewer'],
// ]);

// /**
//  * productions create route
//  */
// Route::get('productions/create', [
// 	'as'=>'productions.create',
// 	'uses'=>'productionsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_editor'],
// ]);

// /**
//  * productions store route
//  */
// Route::post('/productions', [
// 	'as'=>'productions.store',
// 	'uses'=>'productionsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_editor'],
// ]);

// Route::bind('productions', function($id){
// 	return App\Production::whereId($id)
// 		->with('employee')
// 		->firstOrFail();
// });


// // Route::resource('productions', 'productionsController', [
	
// // ]);

// /**
//  * productions show route
//  */
// Route::get('productions/{productions}', [
// 	'as'=>'productions.show',
// 	'uses'=>'productionsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_viewer'],
// ]);

// /**
//  * productions edit route
//  */
// Route::get('/productions/{productions}/edit', [
// 	'as'=>'productions.edit',
// 	'uses'=>'productionsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_editor'],
// ]);

// /**
//  * productions update route
//  */
// Route::put('/productions/{productions}', [
// 	'as'=>'productions.update',
// 	'uses'=>'productionsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_editor'],
// ]);

// /**
//  * productions destroy route
//  */
// Route::delete('/productions/{productions}', [
// 	'as'=>'productions.destroy',
// 	'uses'=>'productionsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['productions_editor'],
// ]);


