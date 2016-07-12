<?php

/**
 * ===========================================================
 * Employees
 */

// Route::geat('employees/search/', [
// 	'as'=>'admin.employees.search',
// 	'uses'=>'EmployeesController@search',
// ]);
use Yajra\Datatables\Facades\Datatables;

Route::post('employees/reactivate/{employees}', [
	'as'=>'admin.employees.reactivate',
	'uses'=>'EmployeesController@reactivate',
]);

Route::post('employees/terminations/{employees}', [
	'as'=>'admin.employees.termination',
	'uses'=>'EmployeesController@updateTermination',
]);

Route::post('employees/updateAddress/{employees}', [
	'as'=>'admin.employees.updateAddress',
	'uses'=>'EmployeesController@updateAddress',
]);

Route::post('employees/updateCard/{employees}', [
	'as'=>'admin.employees.updateCard',
	'uses'=>'EmployeesController@updateCard',
]);

Route::post('employees/updatePunch/{employees}', [
	'as'=>'admin.employees.updatePunch',
	'uses'=>'EmployeesController@updatePunch',
]);

Route::post('employees/updatePhoto/{employees}', [
	'as'=>'admin.employees.updatePhoto',
	'uses'=>'EmployeesController@updatePhoto',
]);

// use Yajra\Datatables\Facades\Datatables;


Route::get('datatables/employees', function(){

	return Datatables::eloquent(
		App\Employee::query()
			->with('positions')
			->with('termination')
	)->make(true);
});



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