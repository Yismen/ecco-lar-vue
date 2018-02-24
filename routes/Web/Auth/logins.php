<?php


Route::post('logins/to_excel', 'LoginsController@toExcel');

Route::bind('login', function ($login) {
    return App\Login::whereId($login)
        ->with('employee')
        ->firstOrFail();
});
Route::resource('logins', 'LoginsController');
