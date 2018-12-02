<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ARSController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */  
    public function updateArs(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'ars_id' => 'required|exists:ars,id',
        ]);

        $employee->update($request->only('ars_id'));
        
        Cache::forget('employees');
        Cache::forget('arss');

        return $employee->load('ars');
    }
}
