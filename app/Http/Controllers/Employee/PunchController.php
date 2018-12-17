<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PunchController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'punch' => 'required|numeric|digits:5|unique:punches,punch,'.$employee->id.',employee_id'
        ]);

        $employee->punch()->updateOrCreate([], $request->only(['punch']));

        Cache::forget('employees');
        Cache::forget('punches');

        return $employee->load('punch');
    }
}
