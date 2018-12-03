<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Cache;

class BankAccountController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'bank_id' => 'required|exists:banks,id',
            'account_number' => 'required|min:5|max:100|unique:bank_accounts,account_number,' . $employee->id.',employee_id',
        ]);

        Cache::forget('employees');
        Cache::forget('bank-accounts');

        if ($employee->bankAccount) {
            $employee->bankAccount->update($request->only('bank_id', 'account_number'));
        } else {
            $employee->bankAccount()->create($request->only('bank_id', 'account_number'));
        }

        return $employee->load('bankAccount');
    }
}
