<?php

Route::bind('nationality', function($id){
    return App\Nationality::with('employees.position')->findOrFail($id);
});

Route::resource('nationalities', 'NationalitiesController');
    


