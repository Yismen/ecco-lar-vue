<?php

Route::get('departments/list', 'DepartmentsController@getList');

Route::bind('department', function ($id) {
    return App\Department::whereId($id)
        ->with(['positions' => function ($query) {
            $query->orderBy('name');
        }])
        // ->with('employees')
        ->firstOrFail();
});

Route::resource('departments', 'DepartmentsController');

/**
 * departments index route
//  */
// Route::get('departments', [
// 	'as'=>'departments.index',
// 	'uses'=>'DepartmentsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_viewer'],
// ]);

// /**
//  * departments create route
//  */
// Route::get('departments/create', [
// 	'as'=>'departments.create',
// 	'uses'=>'DepartmentsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_editor'],
// ]);

// /**
//  * departments store route
//  */
// Route::post('/departments', [
// 	'as'=>'departments.store',
// 	'uses'=>'DepartmentsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_editor'],
// ]);

// Route::bind('departments', function($id){
// 	return App\Position::whereId($id)
// 		->with('departments')
// 		->with('payments')
// 		->firstOrFail();
// });

// // Route::resource('departments', 'DepartmentsController', [

// // ]);

// /**
//  * departments show route
//  */
// Route::get('departments/{departments}', [
// 	'as'=>'departments.show',
// 	'uses'=>'DepartmentsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_viewer'],
// ]);

// /**
//  * departments edit route
//  */
// Route::get('/departments/{departments}/edit', [
// 	'as'=>'departments.edit',
// 	'uses'=>'DepartmentsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_editor'],
// ]);

// /**
//  * departments update route
//  */
// Route::put('/departments/{departments}', [
// 	'as'=>'departments.update',
// 	'uses'=>'DepartmentsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_editor'],
// ]);

// /**
//  * departments destroy route
//  */
// Route::delete('/departments/{departments}', [
// 	'as'=>'departments.destroy',
// 	'uses'=>'DepartmentsController@destroy',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['departments_editor'],
// ]);
