<?php

namespace Http\Controllers\Employee;

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
    public function update(Employee $employee, Request $request)
    {
    $this->validate($request, [
            'sector' => 'required|min:3',
            'street_address' => 'required|min:3',
            'city' => 'required|min:3',
        ]);

        $employee->address()->updateOrCreate($request->only(['sector', 'street_address', 'city']));
        
        Cache::forget('employees');
        Cache::forget('addresses');

        return $employee->load('address');
    }
}
