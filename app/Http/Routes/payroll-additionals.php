<?php


Route::get('/payroll-additionals/by-date/{date}', 'PayrollAdditionalsController@byDate')->name('admin.payroll-additionals.by-date');

Route::bind('payroll-additionals', function($id){
    return App\PayrollAdditional::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-additionals', 'PayrollAdditionalsController');