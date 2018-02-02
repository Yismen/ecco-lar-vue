<?php

Route::bind('bank_accounts', function($id){
    return App\BankAccount::findOrFail($id);
});

Route::resource('bank_accounts', 'BankAccountsController');