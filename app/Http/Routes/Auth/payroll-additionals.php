<?php

Route::get('/payroll-additionals/by-date/{date}', 'PayrollAdditionalsController@byDate')->name('admin.payroll-additionals.by-date');
Route::get('/payroll-additionals/import', 'PayrollAdditionalsController@import')->name('admin.payroll-additionals.import');
Route::post('/payroll-additionals/import', 'PayrollAdditionalsController@handleImport')->name('admin.payroll-additionals.handle-import');
Route::get('/payroll-additionals/date/{date}/employee/{employee_id}', 'PayrollAdditionalsController@details')->name('admin.payroll-additionals.details');

Route::bind('payroll-additionals', function($id){
    return App\PayrollAdditional::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-additionals', 'PayrollAdditionalsController');