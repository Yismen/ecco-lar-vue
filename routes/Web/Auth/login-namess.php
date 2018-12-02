<?php

Route::post('login-names/to_excel', 'LoginNamesController@toExcel');

Route::bind('login-name', function ($login_name) {
    return App\Login::whereId($login_name)
        ->with('employee')
        ->firstOrFail();
});
Route::resource('login-names', 'LoginNamesController');
