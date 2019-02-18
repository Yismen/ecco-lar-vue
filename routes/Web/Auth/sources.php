<?php

Route::bind('source', function ($id) {
    return App\Source::findOrFail($id);
});

Route::resource('sources', 'SourcesController');
