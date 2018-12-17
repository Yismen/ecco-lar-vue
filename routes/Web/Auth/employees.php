<?php

Route::get('api/employees', 'EmployeesController@index')->name('employees.list');

Route::get('employees/export_to_excel/{status}', 'Employee\ExportController@toExcel')
    ->name('employees.export_to_excel');
Route::get('employees/export_all_to_excel', 'Employee\ExportController@toExcelAll')
    ->name('employees.export_all_to_excel');

Route::post('employees/{employee}/login-names', 'Employee\LoginNameController@store')
    ->name('employees.login.create');

/**
 * Terminations
 */
Route::post('employees/{employee}/reactivate', 'Employee\TerminationController@reactivate')
    ->name('employees.reactivate');
Route::post('employees/{employee}/terminate', 'Employee\TerminationController@terminate')
    ->name('employees.terminate');

Route::post('employees/{employee}/address', 'Employee\AddressController@update')
    ->name('employees.update-address');

Route::post('employees/{employee}/card', 'Employee\CardController@update')
    ->name('employees.update-card');

Route::post('employees/{employee}/punch', 'Employee\PunchController@update')
    ->name('employees.update-punch');

Route::post('employees/{employee}/photo', 'Employee\PhotoController@update')
    ->name('employees.update-photo');

Route::put('employees/{employee}/ars', 'Employee\ArsController@update')
    ->name('employees.update-ars');

Route::put('employees/{employee}/afp', 'Employee\AfpController@update')
    ->name('employees.update-afp');

Route::put('employees/{employee}/bank-account', 'Employee\BankAccountController@update')
    ->name('employees.update-bank-account');

Route::post('employees/{employee}/social-security', 'Employee\SocialSecurityController@update')
    ->name('employees.update-social-security');

Route::put('employees/{employee}/supervisor', 'Employee\SupervisorController@update')
    ->name('employees.update-supervisor');

Route::post('employees/{employee}/nationality', 'Employee\NationalityController@update')
    ->name('employees.update-nationality');

Route::bind('employee', function ($id) {
    return App\Employee::whereId($id)
    ->with('address')
    ->with('afp')
    ->with('ars')
    ->with('bankAccount')
    ->with('socialSecurity')
    ->with('card')
    ->with('gender')
    ->with('loginNames')
    ->with('marital')
    ->with('nationalities')
        ->with('punch')
        ->with('position')
        ->with('termination')
        ->with('supervisor')

        ->firstOrFail()
        ->append([
            'ars_list',
            'afp_list',
            'banks_list',
            'departments_list',
            'genders_list',
            'has_kids_list',
            'maritals_list',
            'positions_list',
            'payment_types_list',
            'payment_frequencies_list',
            'nationalities_list',
            'supervisors_list',
            'termination_type_list',
            'termination_reason_list'
            ]);
});

Route::resource('employees', 'EmployeesController');
