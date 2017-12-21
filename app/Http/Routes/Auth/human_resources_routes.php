<?php

Route::group(['middleware' => 'authorize:view_human_resources'], function(){
    Route::get('human_resources', ['as'=>'human_resources.index', 'uses'=>'HumanResourcesController@index']);
    Route::get('human_resources/employees/missing_address', 'HumanResourcesController@missingAddress');
    Route::get('human_resources/employees/missing_punch', 'HumanResourcesController@missingPunch');
    Route::get('human_resources/employees/missing_photo', 'HumanResourcesController@missingPhoto');
    Route::get('human_resources/employees/missing_ars', 'HumanResourcesController@missingArs');
    Route::get('human_resources/employees/missing_afp', 'HumanResourcesController@missingAfp');
    Route::get('human_resources/employees/missing_social_security', 'HumanResourcesController@missingSocialSecurity');
    Route::get('human_resources/employees/missing_bank_account', 'HumanResourcesController@missingBankAccount');
    Route::get('human_resources/employees/by_positions/{id}', 'HumanResourcesController@byPosition');
    Route::get('human_resources/employees/by_departments/{id}', 'HumanResourcesController@byDepartment');

    Route::get('human_resources/employees/dgt3', 'HumanResourcesController@dgt3');
    Route::post('human_resources/employees/dgt3', 'HumanResourcesController@handleDgt3');
    Route::get('human_resources/employees/dgt4', 'HumanResourcesController@dgt4');
    Route::post('human_resources/employees/dgt4', 'HumanResourcesController@handleDgt4');



    Route::get('human_resources/employees/birthdays/this_month', 'HumanResourcesController@birthdaysThisMonth');
    Route::get('human_resources/employees/birthdays/next_month', 'HumanResourcesController@birthdaysNextMonth');
    Route::get('human_resources/employees/birthdays/last_month', 'HumanResourcesController@birthdaysLastMonth');
});
    


