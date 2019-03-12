<?php

Route::bind('client', function ($id) {
    return App\Modules\Clients\Client::findOrFail($id);
});

Route::resource('clients', 'ClientsController');
