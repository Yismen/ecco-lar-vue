<?php

/**
 * Roles Routes
 */
Route::get('payrolls_temp/import_from_excel', 'PayrollsTempController@importDataFromExcel');
Route::post('payrolls_temp/import_from_excel', 'PayrollsTempController@postImportDataFromExcel');

Route::bind('payrolls_temp', function($id) {
	return App\Payroll::find($id);
});

Route::resource('payrolls_temp', 'PayrollsTempController');




