<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ARSController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'ars_id' => 'required|exists:arss,id',
        ]);

        Cache::forget('employees');
        Cache::forget('arss');

        $employee->update($request->only(['ars_id']));

        return $employee->load('ars');
    }
}
