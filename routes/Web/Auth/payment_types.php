<?php

Route::bind('payment_type', function ($id) {
    return App\PaymentType::whereId($id)
        ->firstOrFail();
});

Route::resource('payment_types', 'PaymentTypesController');
