<?php

namespace App\Http\Controllers\Employee;

use App\Address;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AddressController extends Controller
{
    /**
     * update employees' address
     *
     * @param Employee $employee
     * @param Request $request
     * @return void
     */
    public function update(Employee $employee, Request $request, Address $address)
    {
        $this->validate(
            $request, [
                'sector' => 'required|min:3',
                'street_address' => 'required|min:3',
                'city' => 'required|min:3'
            ]
        );

        $request->merge(['employee_id' => $employee->id]);

        Cache::forget('employees');
        Cache::forget('addresses');

        if ($employee->address) {
            $employee->address->update(
                $request->only(['employee_id', 'sector', 'street_address', 'city'])
            );
        } else {
            $address->create(
                $request->only(['employee_id', 'sector', 'street_address', 'city'])
            );
        }

        return $employee->load('address');
    }
}
