<?php

Route::get('/payroll-incentives/by-date/{date}', 'PayrollIncentivesController@byDate')->name('payroll-incentives.by-date');
Route::get('/payroll-incentives/import', 'PayrollIncentivesController@import')->name('payroll-incentives.import');
Route::post('/payroll-incentives/import', 'PayrollIncentivesController@handleImport')->name('payroll-incentives.handle-import');
Route::get('/payroll-incentives/date/{date}/employee/{employee_id}', 'PayrollIncentivesController@details')->name('payroll-incentives.details');

Route::bind('payroll-incentive', function ($id) {
    return App\PayrollIncentive::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-incentives', 'PayrollIncentivesController');
