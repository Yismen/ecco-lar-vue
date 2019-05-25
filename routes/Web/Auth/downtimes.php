<?php

Route::post('downtimes/import', 'DowntimesController@importByDate')->name('downtimes.import');

Route::resource('downtimes', 'DowntimesController');
