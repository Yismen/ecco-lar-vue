<?php

Route::bind('site', function ($id) {
    return App\Site::findOrFail($id);
});

Route::resource('sites', 'SitesController');
