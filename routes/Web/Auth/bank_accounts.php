<?php

Route::bind('bank_account', function ($id) {
    return App\BankAccount::findOrFail($id);
});

Route::resource('bank_accounts', 'BankAccountsController');
