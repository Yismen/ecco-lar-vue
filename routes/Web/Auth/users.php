<?php

Route::bind('user', function ($id) {
    return App\User::whereId($id)
    ->with('roles.permissions')
    ->with('settings')
    ->firstOrFail()->append('roles-list');
});

Route::get('users/reset', 'User\PasswordController@reset')->name('users.reset');
Route::post('users/reset', 'User\PasswordController@change')->name('users.change');

Route::get('users/force_reset/{user}', 'User\PasswordController@force_reset')->name('users.force_reset');
Route::post('users/force_reset/{user}', 'User\PasswordController@force_change')->name('users.force_change');

Route::post('users/update_settings/{user}', 'User\SettingController@updateSettings')->name('users.update_settings');
Route::put('users/settings/{user}', 'User\SettingController@update')->name('users.settings');

Route::resource('users', 'UsersController');
