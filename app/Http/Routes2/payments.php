<?php

/**
 * payments Routes
 * ------------------------------------------------
 */


/**
 * payments index route
 */
Route::get('payments', [
	'as'=>'payments.index',
	'uses'=>'PaymentsController@index',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_viewer'],
]);

/**
 * payments create route
 */
Route::get('payments/create', [
	'as'=>'payments.create',
	'uses'=>'PaymentsController@create',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_editor'],
]);

/**
 * payments store route
 */
Route::post('/payments', [
	'as'=>'payments.store',
	'uses'=>'PaymentsController@store',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_editor'],
]);

Route::bind('payments', function($id){
	return App\Payment::whereId($id)
		// ->with('departments')
		// ->with('payments')
		->firstOrFail();
});


// Route::resource('payments', 'PaymentsController', [
	
// ]);

/**
 * payments show route
 */
Route::get('payments/{payments}', [
	'as'=>'payments.show',
	'uses'=>'PaymentsController@show',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_viewer'],
]);

/**
 * payments edit route
 */
Route::get('/payments/{payments}/edit', [
	'as'=>'payments.edit',
	'uses'=>'PaymentsController@edit',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_editor'],
]);

/**
 * payments update route
 */
Route::put('/payments/{payments}', [
	'as'=>'payments.update',
	'uses'=>'PaymentsController@update',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_editor'],
]);

/**
 * payments destroy route
 */
Route::delete('/payments/{payments}', [
	'as'=>'payments.destroy',
	'uses'=>'PaymentsController@destroy',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['payments_editor'],
]);


