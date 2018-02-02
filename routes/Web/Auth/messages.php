<?php


Route::bind('messages', function($id){
    return App\Message::whereId($id)
        ->with('user')
        ->firstOrFail();
});

Route::resource('messages', 'MessageController');