<?php

namespace App\Http\Controllers\Employee;

use Cache;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NationalityController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'nationality_id' => 'required|exists:nationalities,id',
        ]);
        
        $employee->nationalities()->sync((array)$request->nationality_id);

        Cache::forget('employees');
        Cache::forget('nationalities');
        
        return $employee;
    }
}
