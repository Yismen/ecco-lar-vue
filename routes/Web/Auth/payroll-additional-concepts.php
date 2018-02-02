<?php

Route::bind('payroll-additional-concept', function($id){
    return App\PayrollAdditionalConcept::whereId($id)
        ->firstOrFail();
});

Route::resource('payroll-additional-concepts', 'PayrollAdditionalConceptsController', ['except' => ['show', 'destroy']]);