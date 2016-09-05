<?php

Route::bind('passwords', function($slug){
    return App\Password::whereSlug($slug)->firstOrFail();
});

Route::resource('passwords', 'PasswordController');