<?php

// generate payroll (create method)
    // Hours + downtimes
    // Payment type fix
// Close Payroll (store method)
    // Save to Payrolls summary table
Route::get('payrolls/import_from_excel', 'Payroll\SummaryController@importDataFromExcel');
Route::post('payrolls/import_from_excel', 'Payroll\SummaryController@postImportDataFromExcel');
Route::get('payrolls/by_payroll_id/{payroll_id}', 'Payroll\SummaryController@byPayrollID')->name('payrolls.by_payroll_id');

Route::get('payrolls/generate', 'Payroll\GenerateController@generate')->name('payrol.generate');
Route::post('payrolls/generate', 'Payroll\GenerateController@handleGenerate');

Route::get('payrolls/prepare', 'Payroll\GenerateController@prepare');
Route::post('payrolls/filter-positions-by-department', 'Payroll\GenerateController@filterPositionsByDepartment');

Route::post('payrolls/generate/filter', 'Payroll\GenerateController@filter');
Route::post('payrolls/close', 'Payroll\GenerateController@close');

Route::bind('payroll', function($id) {
	return App\Payroll::find($id);
});

Route::resource('payrolls', 'Payroll\PayrollController');






