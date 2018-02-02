<?php


Route::post('logins/to_excel', 'LoginsController@toExcel');


Route::bind('logins', function ($login) {
    return App\Login::whereId($login)
        ->with('employee')
        ->with('system')
        ->firstOrFail();
});
Route::resource('logins', 'LoginsController');
