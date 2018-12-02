<?php

namespace App\Http\Controllers\Employee;

use Cache;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupervisorController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'supervisor_id' => 'required|exists:supervisors,id',
        ]);

        $employee->update($request->only('supervisor_id'));

        Cache::forget('employees');

        return $employee->load('supervisor');
    }
}
