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

        $employee->card()->updateOrCreate($request->only('card'));        
        
        Cache::forget('employees');   
        Cache::forget('cards');   

        if ($request->ajax()) {
            return $employee->load('card');
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess('Card Number Updated');
    }
}
