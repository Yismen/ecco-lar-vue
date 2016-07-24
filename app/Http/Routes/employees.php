<?php

/**
 * ===========================================================
 * Employees
 */

// Route::geat('employees/search/', [
// 	'as'=>'admin.employees.search',
// 	'uses'=>'EmployeesController@search',
// ]);
// 
Route::post('employees/logins/{employees}', ['as'=>'admin.employees.login.create', 'uses'=>'EmployeesController@createLogin']);

Route::post('employees/logins/{employees}/update', ['as'=>'admin.employees.login.update', 'uses'=>'EmployeesController@updateLogin']);

Route::post('employees/reactivate/{employees}', ['as'=>'admin.employees.reactivate','uses'=>'EmployeesController@reactivate']);

Route::post('employees/terminations/{employees}', ['as'=>'admin.employees.termination','uses'=>'EmployeesController@updateTermination']);

Route::post('employees/updateAddress/{employees}', ['as'=>'admin.employees.updateAddress','uses'=>'EmployeesController@updateAddress']);

Route::post('employees/updateCard/{employees}', ['as'=>'admin.employees.updateCard','uses'=>'EmployeesController@updateCard']);

Route::post('employees/updatePunch/{employees}', ['as'=>'admin.employees.updatePunch','uses'=>'EmployeesController@updatePunch']);

Route::post('employees/updatePhoto/{employees}', ['as'=>'admin.employees.updatePhoto','uses'=>'EmployeesController@updatePhoto']);


// Route::get('datatables/employees', ['as'=>'admin.employees.datatables-list', 'uses'=>'EmployeesController@dataTables']);
Route::get('employees', ['as'=>'admin.employees.datatables-list', 'uses'=>'EmployeesController@index']);

/**
 * 
 */
Route::bind('employees', function($id){
	return App\Employee::whereId($id)
		->with('department')
		->with('maritals')
		->with('positions')
		->with('genders')
		->with('addresses')
		->with('logins')
		->firstOrFail();
});
Route::resource('employees', 'EmployeesController');



// Route::group(['prefix'=>'api'], function(){
// 	Route::bind('employees', function($id){
// 		return App\Employee::whereId($id)
// 			->with('department')
// 			->with('maritals')
// 			->with('positions')
// 			->with('genders')
// 			->with('addresses')
// 			->with('logins')
// 			->firstOrFail();
// 	});
// 	Route::resource('employees', 'EmployeesController');
// });