<?php

Route::get('/payroll-incentives/by-date/{date}', 'PayrollIncentivesController@byDate')->name('admin.payroll-incentives.by-date');
Route::get('/payroll-incentives/import', 'PayrollIncentivesController@import')->name('admin.payroll-incentives.import');
Route::post('/payroll-incentives/import', 'PayrollIncentivesController@handleImport')->name('admin.payroll-incentives.handle-import');
Route::get('/payroll-incentives/date/{date}/employee/{employee_id}', 'PayrollIncentivesController@details')->name('admin.payroll-incentives.details');

Route::bind('payroll-incentives', function($id){
    return App\PayrollIncentive::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-incentives', 'PayrollIncentivesController');