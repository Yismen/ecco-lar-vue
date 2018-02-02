<?php

Route::post('employees/list', ['as' => 'employees.list', 'uses' => 'EmployeesController@apiEmployees']);

Route::get('employees/export_to_excel/{status}',
    ['as' => 'employees.export_to_excel', 'uses' => 'EmployeesController@toExcel']
)->middleware('authorize:employees_to_excel');

Route::get(
    'employees/export_all_to_excel',
    ['as' => 'employees.export_all_to_excel', 'uses' => 'EmployeesController@toExcelAll']
)->middleware('authorize:employees_all_to_excel');

Route::post('employees/logins/{employees}',
    ['as' => 'employees.login.create', 'uses' => 'EmployeesController@createLogin']
)->middleware('authorize:create_logins');

Route::post('employees/logins/{employees}/update',
    ['as' => 'employees.login.update', 'uses' => 'EmployeesController@updateLogin']
)->middleware('authorize:update_logins');

Route::bind('employees/logins', function ($id) {
    return App\Login::whereId($id)->firstOrFail();
});

Route::resource('employees/logins', 'Employee\LoginNameController');

Route::post('employees/reactivate/{employees}',
    ['as' => 'employees.reactivate', 'uses' => 'EmployeesController@reactivate']
    )->middleware('authorize:edit_employees');

Route::post('employees/terminations/{employees}',
    ['as' => 'employees.termination', 'uses' => 'EmployeesController@updateTermination']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateAddress/{employees}',
    ['as' => 'employees.updateAddress', 'uses' => 'Employee\AddressController@update']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateCard/{employees}',
    ['as' => 'employees.updateCard', 'uses' => 'EmployeesController@updateCard']
    )->middleware('authorize:edit_employees');

Route::post('employees/updatePunch/{employees}',
    ['as' => 'employees.updatePunch', 'uses' => 'EmployeesController@updatePunch']
    )->middleware('authorize:edit_employees');

Route::post('employees/updatePhoto/{employees}',
    ['as' => 'employees.updatePhoto', 'uses' => 'EmployeesController@updatePhoto']
)->middleware('authorize:edit_employees');

Route::post('employees/updateArs/{employees}',
    ['as' => 'employees.updateArs', 'uses' => 'EmployeesController@updateArs']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateAfp/{employees}',
    ['as' => 'employees.updateAfp', 'uses' => 'EmployeesController@updateAfp']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateBankAccount/{employees}',
    ['as' => 'employees.updateBankAccount', 'uses' => 'EmployeesController@updateBankAccount']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateSocialSecurity/{employees}',
    ['as' => 'employees.updateSocialSecurity', 'uses' => 'EmployeesController@updateSocialSecurity']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateSupervisor/{employees}',
    ['as' => 'employees.updateSupervisor', 'uses' => 'EmployeesController@updateSupervisor']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateNationality/{employees}',
    ['as' => 'employees.updateNationality', 'uses' => 'EmployeesController@updateNationality']
    )->middleware('authorize:edit_employees');

Route::bind('employees', function ($id) {
    return App\Employee::whereId($id)
        ->with('addresses')
        ->with('afp')
        ->with('ars')
        ->with('bankAccount')
        ->with('socialSecurity')
        ->with('card')
        ->with('gender')
        ->with('logins.system')
        ->with('marital')
        ->with('punch')
        ->with('position')
        ->with('termination')
        ->with('supervisor')
    ->firstOrFail();
});

Route::resource('employees', 'EmployeesController');
