<?php

Route::get('login-names/to-excel/all', 'LoginNamesController@toExcel')->name('login-names.to-excel.all');
Route::get('login-names/to-excel/all-employees', 'LoginNamesController@employeesToExcel')->name('login-names.to-excel.all-employees');

Route::bind('login_name', function ($login_name) {
    return App\LoginName::whereId($login_name)
        ->with('employee')
        ->firstOrFail();
});
Route::resource('login-names', 'LoginNamesController');
