<?php

Route::bind('revenue_type', function ($id) {
    return App\RevenueType::findOrFail($id);
});

Route::resource('revenue_types', 'RevenueTypesController');
