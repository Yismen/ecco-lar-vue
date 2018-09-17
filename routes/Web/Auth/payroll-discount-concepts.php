<?php

Route::bind('payroll-discount-concept', function ($id) {
    return App\PayrollDiscountConcept::whereId($id)
        ->firstOrFail();
});

Route::resource('payroll-discount-concepts', 'PayrollDiscountConceptsController', ['except' => ['show', 'destroy']]);
