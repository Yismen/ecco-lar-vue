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