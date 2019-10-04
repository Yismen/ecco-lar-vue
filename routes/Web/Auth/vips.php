<?php

Route::resource('vips', 'VipController')
    ->except('create', 'show');
