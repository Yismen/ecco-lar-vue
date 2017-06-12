<?php

Route::get('human_resources', ['as'=>'human_resources.index', 'uses'=>'HumanResourcesController@index']);
Route::get('human_resources/employees/missing_address', 'HumanResourcesController@missingAddress');
Route::get('human_resources/employees/missing_punch', 'HumanResourcesController@missingPunch');
Route::get('human_resources/employees/missing_photo', 'HumanResourcesController@missingPhoto');
Route::get('human_resources/employees/missing_ars', 'HumanResourcesController@missingArs');
Route::get('human_resources/employees/missing_afp', 'HumanResourcesController@missingAfp');
Route::get('human_resources/employees/missing_social_security', 'HumanResourcesController@missingSocialSecurity');
Route::get('human_resources/employees/missing_bank_account', 'HumanResourcesController@missingBankAccount');

Route::get('human_resources/employees/birthdays/this_month', 'HumanResourcesController@birthdaysThisMonth');
Route::get('human_resources/employees/birthdays/next_month', 'HumanResourcesController@birthdaysNextMonth');
Route::get('human_resources/employees/birthdays/last_month', 'HumanResourcesController@birthdaysLastMonth');


