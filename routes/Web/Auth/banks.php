<?php

Route::bind('bank', function($id){
    return App\Bank::findOrFail($id);
});

Route::resource('banks', 'BanksController', ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);