<?php

Route::bind('nationalities', function($id){
    return App\Nationality::with('employees')->findOrFail($id);
});

Route::resource('nationalities', 'NationalitiesController');
    


