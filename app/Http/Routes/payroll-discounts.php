<?php


Route::get('/payroll-discounts/by-date/{date}', 'HoursController@byDate')->name('admin.payroll-discounts.by-date');

Route::bind('payroll-discounts', function($id){
    return App\PayrollDiscount::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('payroll-discounts', 'PayrollDiscountsController');