<?php

Route::get('escalations_admin', 'EscalationsAdminController@index'); 

Route::get('escalations_admin/by_date', 'EscalationsAdminController@getByDate'); 
Route::post('escalations_admin/by_date', 'EscalationsAdminController@postByDate'); 

Route::get('escalations_admin/search', 'EscalationsAdminController@search'); 
Route::post('escalations_admin/search', 'EscalationsAdminController@searchPost'); 

Route::get('escalations_admin/random', 'EscalationsAdminController@random'); 
Route::post('escalations_admin/random', 'EscalationsAdminController@randomPost'); 

Route::get('escalations_admin/bbbs', 'EscalationsAdminController@bbbs'); 
Route::post('escalations_admin/bbbs', 'EscalationsAdminController@bbbsPost'); 




