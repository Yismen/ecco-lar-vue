<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CardController extends Controller
{
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, ['card' => 'required|numeric|digits:8|unique:cards,card,'.$employee->id.',employee_id']);

        Cache::forget('employees');
        Cache::forget('cards');

        $employee->card()->updateOrCreate([], $request->only('card'));

        return $employee->load('card');
    }
}
