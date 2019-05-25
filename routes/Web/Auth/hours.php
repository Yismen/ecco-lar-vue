<?php

Route::get('/hours/by-date/{date}', 'HoursController@byDate')->name('hours.by-date');

Route::resource('hours', 'HoursController');
