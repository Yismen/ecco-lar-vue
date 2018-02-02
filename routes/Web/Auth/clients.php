<?php

/**
 * clients Routes
 * ------------------------------------------------
 */
// Route::get('clients/{clients}/employees/{employees}', function($login, $employee){
// 	return $employee;
// });

// Route::get('profiles/{profiles}/articles/{articles}', function($login, $employee){
// 	return $login;
// });
// 
Route::bind('clients', function($id){
	return App\Client::whereId($id)
		->firstOrFail();
});


Route::resource('clients', 'ClientsController', [
	
]);

/**
 * clients index route
 */
// Route::get('clients', [
// 	'as'=>'clients.index',
// 	'uses'=>'ClientsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_viewer'],
// ]);

// /**
//  * clients create route
//  */
// Route::get('clients/create', [
// 	'as'=>'clients.create',
// 	'uses'=>'ClientsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_editor'],
// ]);

// /**
//  * clients store route
//  */
// Route::post('/clients', [
// 	'as'=>'clients.store',
// 	'uses'=>'ClientsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_editor'],
// ]);

// Route::bind('clients', function($id){
// 	return App\Client::whereId($id)
// 		->firstOrFail();
// });


// Route::resource('clients', 'ClientsController', [
	
// ]);

// /**
//  * clients show route
//  */
// Route::get('clients/{clients}', [
// 	'as'=>'clients.show',
// 	'uses'=>'ClientsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_viewer'],
// ]);

// /**
//  * clients edit route
//  */
// Route::get('/clients/{clients}/edit', [
// 	'as'=>'clients.edit',
// 	'uses'=>'ClientsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_editor'],
// ]);

// /**
//  * clients update route
//  */
// Route::put('/clients/{clients}', [
// 	'as'=>'clients.update',
// 	'uses'=>'ClientsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_editor'],
// ]);

// /**
//  * clients destroy route
//  */
// Route::delete('/clients/{clients}', [
// 	'as'=>'clients.destroy',
// 	'uses'=>'ClientsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['clients_editor'],
// ]);


