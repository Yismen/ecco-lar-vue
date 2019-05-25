<?php

Route::resource('payroll-additional-concepts', 'PayrollAdditionalConceptsController', ['except' => ['show', 'destroy']]);
