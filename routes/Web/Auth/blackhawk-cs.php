<?php

Route::get('blackhawk_cs_management', 'BlackHawkCS\ManagementController@index');
Route::get('blackhawk_cs_management/api/dashboard', 'BlackHawkCS\ManagementController@dashboard');

Route::get('import_blackhawk_cs_data', 'BlackHawkCS\ImportController@index');
Route::post('import_blackhawk_cs_data/qa', 'BlackHawkCS\ImportController@qa')->name('import-qa');
Route::post('import_blackhawk_cs_data/qa-errors', 'BlackHawkCS\ImportController@qaErrors')->name('import-qa-errors');
Route::post('import_blackhawk_cs_data/lob', 'BlackHawkCS\ImportController@lob')->name('import-lob-summary');
Route::post('import_blackhawk_cs_data/performance', 'BlackHawkCS\ImportController@performance')->name('import-performance');
