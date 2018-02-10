<?php

Route::bind('employee', function ($id) {
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
        ->with('nationalities')
        ->with('punch')
        ->with('position.payment_type', 'position.department', 'position.payment_frequency')
        ->with('termination')
        ->with('supervisor' )
        
    ->firstOrFail()
    ->append([

		'afp_list', 
		'ars_list', 
		'banks_list',
		'departments_list',
		'genders_list', 
		'has_kids_list', 
		'maritals_list', 
		'positions_list', 
		'nationalities_list', 
		'supervisors_list',
		'systems_list', 
		'termination_type_list', 
		'termination_reason_list'
    ]);
});

Route::post('employees/list', ['as' => 'employees.list', 'uses' => 'EmployeesController@apiEmployees']);

Route::get('employees/export_to_excel/{status}',
    ['as' => 'employees.export_to_excel', 'uses' => 'EmployeesController@toExcel']
)->middleware('authorize:employees_to_excel');

Route::get(
    'employees/export_all_to_excel',
    ['as' => 'employees.export_all_to_excel', 'uses' => 'EmployeesController@toExcelAll']
)->middleware('authorize:employees_all_to_excel');

Route::post('employees/logins/{employee}',
    ['as' => 'employees.login.create', 'uses' => 'EmployeesController@createLogin']
)->middleware('authorize:create_logins');

Route::post('employees/logins/{employee}/update',
    ['as' => 'employees.login.update', 'uses' => 'EmployeesController@updateLogin']
)->middleware('authorize:update_logins');

Route::bind('login', function ($id) {
    return App\Login::whereId($id)->firstOrFail();
});

Route::resource('employees/logins', 'Employee\LoginNameController');

Route::post('employees/reactivate/{employee}',
    ['as' => 'employees.reactivate', 'uses' => 'EmployeesController@reactivate']
    )->middleware('authorize:edit_employees');

Route::post('employees/terminations/{employee}',
    ['as' => 'employees.termination', 'uses' => 'EmployeesController@updateTermination']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateAddress/{employee}',
    ['as' => 'employees.updateAddress', 'uses' => 'Employee\AddressController@update']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateCard/{employee}',
    ['as' => 'employees.updateCard', 'uses' => 'EmployeesController@updateCard']
    )->middleware('authorize:edit_employees');

Route::post('employees/updatePunch/{employee}',
    ['as' => 'employees.updatePunch', 'uses' => 'EmployeesController@updatePunch']
    )->middleware('authorize:edit_employees');

Route::post('employees/updatePhoto/{employee}',
    ['as' => 'employees.updatePhoto', 'uses' => 'EmployeesController@updatePhoto']
)->middleware('authorize:edit_employees');

Route::post('employees/updateArs/{employee}',
    ['as' => 'employees.updateArs', 'uses' => 'EmployeesController@updateArs']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateAfp/{employee}',
    ['as' => 'employees.updateAfp', 'uses' => 'EmployeesController@updateAfp']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateBankAccount/{employee}',
    ['as' => 'employees.updateBankAccount', 'uses' => 'EmployeesController@updateBankAccount']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateSocialSecurity/{employee}',
    ['as' => 'employees.updateSocialSecurity', 'uses' => 'EmployeesController@updateSocialSecurity']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateSupervisor/{employee}',
    ['as' => 'employees.updateSupervisor', 'uses' => 'EmployeesController@updateSupervisor']
    )->middleware('authorize:edit_employees');

Route::post('employees/updateNationality/{employee}',
    ['as' => 'employees.updateNationality', 'uses' => 'EmployeesController@updateNationality']
    )->middleware('authorize:edit_employees');

Route::resource('employees', 'EmployeesController');
