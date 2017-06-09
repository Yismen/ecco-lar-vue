<?php

Route::bind('banks', function($id){
    return App\Bank::findOrFail($id);
});

Route::resource('banks', 'BanksController');