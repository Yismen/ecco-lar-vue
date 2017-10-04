<?php
Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin'], function() {
        Route::group(['middleware' => 'auth'], function() { 

            Route::get(
                'payrolls_summary_tss', 'Dainsys\Payrolls\Http\Controllers\PayrollsReportsController@index'
            )->name('admin.payrolls_summary_tss.index');

            Route::post(
                'payrolls_summary_tss', 'Dainsys\Payrolls\Http\Controllers\PayrollsReportsController@reports'
            )->name('admin.payrolls_summary_tss.reports');

        });
    });
});