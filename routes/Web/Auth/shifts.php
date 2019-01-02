<?php

Route::bind('shift', function ($id) {
    return App\Shift::findOrFail($id);
});

Route::resource('shifts', 'ShiftsController');
