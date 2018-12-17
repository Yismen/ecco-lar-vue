<?php

namespace App\Http\Controllers\Employee;

use Cache;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialSecurityController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'number' => 'required|min:5|max:10|unique:social_securities,number,' . $employee->id.',employee_id',
        ]);

        Cache::forget('employees');
        Cache::forget('social-securities');

        $employee->socialSecurity()->updateOrCreate([], $request->only('number'));

        return $employee->load('socialSecurity');
    }
}
