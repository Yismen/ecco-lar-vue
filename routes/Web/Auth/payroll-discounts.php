<?php

Route::get('/payroll-discounts/by-date/{date}', 'PayrollDiscountsController@byDate')->name('payroll-discounts.by-date');
Route::get('/payroll-discounts/import', 'PayrollDiscountsController@import')->name('payroll-discounts.import');
Route::post('/payroll-discounts/import', 'PayrollDiscountsController@handleImport')->name('payroll-discounts.handle-import');
Route::get('/payroll-discounts/date/{date}/employee/{employee_id}', 'PayrollDiscountsController@details')->name('payroll-discounts.details');

Route::bind('payroll-discount', function($id){
    return App\PayrollDiscount::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-discounts', 'PayrollDiscountsController');