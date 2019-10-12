<?php

Route::resource('holidays', 'HolidayController')
    ->except('show');
