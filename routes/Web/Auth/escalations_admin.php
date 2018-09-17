<?php

Route::get('escalations_admin', 'EscalationsAdminController@index');
Route::post('escalations_admin/api', 'EscalationsAdminController@index_ajax');

Route::get('escalations_admin/by_date', 'EscalationsAdminController@getByDate');
Route::get('escalations_admin/by_range', 'EscalationsAdminController@getByRange');
 
Route::post('escalations_admin/by_date', 'EscalationsAdminController@postByDate');
Route::post('escalations_admin/by_range', 'EscalationsAdminController@postByRange');

Route::get('escalations_admin/search', 'EscalationsAdminController@search');
Route::post('escalations_admin/search', 'EscalationsAdminController@handleSearch');

Route::get('escalations_admin/random', 'EscalationsAdminController@random');
Route::post('escalations_admin/random', 'EscalationsAdminController@handleRandom');

Route::get('escalations_admin/bbbs', 'EscalationsAdminController@bbbs');
Route::post('escalations_admin/bbbs', 'EscalationsAdminController@handleBBBs');

Route::get('escalations_admin/bbbs_range', 'EscalationsAdminController@bbbs');
Route::post('escalations_admin/bbbs_range', 'EscalationsAdminController@handleBBBsRange');
