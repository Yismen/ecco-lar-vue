<?php

/**
 * Roles Routes
 */
Route::get('payrolls/import_from_excel', 'PayrollsController@importDataFromExcel');
Route::post('payrolls/import_from_excel', 'PayrollsController@postImportDataFromExcel');

Route::bind('payrolls', function($id) {
	return App\Payroll::find($id);
});

Route::resource('payrolls', 'PayrollsController');




