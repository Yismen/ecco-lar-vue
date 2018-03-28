<?php

Route::get('blackhawk-cs/statistic', 'BlackHawkCS\StatisticController@index');
Route::get('blackhawk-cs/management', 'BlackHawkCS\ManagementController@index');
Route::get('blackhawk-cs/api/management/dashboard', 'BlackHawkCS\ManagementController@dashboard');

Route::get('blackhawk-cs/import', 'BlackHawkCS\ImportController@index');
Route::post('blackhawk-cs/import/qa', 'BlackHawkCS\ImportController@qa')->name('import-qa');
Route::post('blackhawk-cs/import/qa-errors', 'BlackHawkCS\ImportController@qaErrors')->name('import-qa-errors');
Route::post('blackhawk-cs/import/lob', 'BlackHawkCS\ImportController@lob')->name('import-lob-summary');
Route::post('blackhawk-cs/import/performance', 'BlackHawkCS\ImportController@performance')->name('import-performance');
