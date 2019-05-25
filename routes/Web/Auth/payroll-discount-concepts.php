<?php

Route::resource('payroll-discount-concepts', 'PayrollDiscountConceptsController', ['except' => ['show', 'destroy']]);
