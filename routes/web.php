<?php

foreach (File::allFiles(__DIR__ . '/Web/Guest') as $partial) {
    require_once $partial;
}

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {
    // Route::auth();
    // Auth::routes();

    /**
     * ----------------------------------------------
     * Admin routes requiring authentication        |
     * ----------------------------------------------
     */
    Route::group(['middleware' => 'auth'], function () {
        foreach (File::allFiles(__DIR__ . '/Web/Auth') as $partial) {
            require_once $partial;
        }
    });
});
