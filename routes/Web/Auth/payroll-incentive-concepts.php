<?php

Route::bind('payroll-incentive-concept', function ($id) {
    return App\PayrollIncentiveConcept::whereId($id)
        ->firstOrFail();
});

Route::resource('payroll-incentive-concepts', 'PayrollIncentiveConceptsController', ['except' => ['show', 'destroy']]);
