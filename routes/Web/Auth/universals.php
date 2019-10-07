<?php

Route::resource('universals', 'UniversalController')
    ->except('create', 'show');
