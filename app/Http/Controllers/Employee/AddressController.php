<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

class AddressController extends Controller
{
    /**
     * update employees' address
     *
     * @param Employee $employee
     * @param Request $request
     * @return void
     */
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'sector' => 'required',
            'street_address' => 'required',
            'city' => 'required',
        ]);

        $employee = $employee->createOrUpdateAddress($request);

        if ($request->ajax()) {
            return $employee->load('addresses');
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess("$employee->first_name's address updated!");
    }
}
