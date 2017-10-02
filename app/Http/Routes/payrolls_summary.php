<?php

/**
 * Roles Routes
 */
Route::get('payrolls_summary/import_from_excel', 'PayrollSummariesController@importDataFromExcel');
Route::post('payrolls_summary/import_from_excel', 'PayrollSummariesController@postImportDataFromExcel');
Route::get('payrolls_summary/by_payroll_id/{payroll_id}', 'PayrollSummariesController@byPayrollID')->name('admin.payrolls_summary.by_payroll_id');
// Route::post('payrolls_summary/import_from_excel', 'PayrollSummariesController@postImportDataFromExcel');

Route::bind('payrolls_summary', function($id) {
	return App\PayrollSummary::with('employee.bankAccount')
        ->with('employee.position.department')
        ->findOrFail($id);
});

Route::resource('payrolls_summary', 'PayrollSummariesController', [
    'except'=>['edit']
]);




