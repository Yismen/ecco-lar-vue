<?php

// generate payroll (create method)
    // Hours + downtimes
    // Payment type fix
// Close Payroll (store method)
    // Save to Payrolls summary table
Route::get('payrolls/generate', 'GeneratePayrollsController@generate');
Route::post('payrolls/generate', 'GeneratePayrollsController@handleGenerate');

Route::get('payrolls/prepare', 'GeneratePayrollsController@prepare');
Route::post('payrolls/filter-positions-by-department', 'GeneratePayrollsController@filterPositionsByDepartment');

Route::post('payrolls/generate/filter', 'GeneratePayrollsController@filter');
Route::post('payrolls/close', 'GeneratePayrollsController@close');

Route::bind('payrolls', function($id) {
	return App\Payroll::find($id);
});

Route::resource('payrolls', 'PayrollsController');






