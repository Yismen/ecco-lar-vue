<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('log_viewer', '\Arcanedev\LogViewer\LogViewerController@index', [
        'name' => 'dashboard'
    ]);
});
