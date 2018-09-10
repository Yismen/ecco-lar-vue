<?php


/**
 * Guest routes here
 */
foreach (File::allFiles(__DIR__ . '/Web/Guest') as $partial) {
    require $partial;
}
Route::get('/{path}', 'HomeController@index')->where('path', '(admin|home|)');

/**
 * App Routes
 * Beyond this point users must be logged in.
 * Roles and permissions are applied here and at the controls level.
 */
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        foreach (File::allFiles(__DIR__ . '/Web/Auth') as $partial) {
            require $partial;
        }
    });
});
