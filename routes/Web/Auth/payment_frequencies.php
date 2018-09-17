<?php

Route::bind('payment_frequency', function ($id) {
    return App\PaymentFrequency::whereId($id)
        ->firstOrFail();
});

Route::resource('payment_frequencies', 'PaymentFrequenciesController');
