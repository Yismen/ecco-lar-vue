<?php

Route::bind('source', function($source){
    return App\Source::whereSlug($source)
        ->firstOrFail();
});

Route::get('sources', 'SourcesController@vue');
Route::resource('api/sources', 'SourcesController');

