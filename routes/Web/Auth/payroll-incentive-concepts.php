<?php

Route::resource('payroll-incentive-concepts', 'PayrollIncentiveConceptsController', ['except' => ['show', 'destroy']]);
