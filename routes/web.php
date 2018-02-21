<?php


foreach (File::allFiles(__DIR__ . '/Web/Guest') as $partial) {
    require $partial;
}

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        foreach (File::allFiles(__DIR__ . '/Web/Auth') as $partial) {
            require $partial;
        }
    });
});
