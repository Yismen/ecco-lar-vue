<?php

/**
 * Guest routes here
 */
Route::get('date_calc', ['as' => 'date_calc.index', 'uses' => 'DateCalcController@index']);
Route::get('date_calc/from_today', ['as' => 'date_calc.diff_from_today', 'uses' => 'DateCalcController@diffFromToday']);
Route::get('date_calc/range_diff', ['as' => 'date_calc.range_diff', 'uses' => 'DateCalcController@rangeDiff']);
Route::get('notes', 'NotesController@index')->name('notes.index');

Route::get('/{path}', 'HomeController@index')->where('path', '(admin|home|)');
Auth::routes();

/**
 * App Routes
 * Beyond this point users must be logged in.
 * Roles and permissions are applied here and at the controls level.
 */
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::group(['middleware' => 'auth'], function () {
        foreach (File::allFiles(__DIR__ . '/Web/Auth') as $partial) {
            require $partial;
        }
    });
});
