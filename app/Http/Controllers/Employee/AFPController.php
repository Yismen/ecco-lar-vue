<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AFPController extends Controller
{
    /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'afp_id' => 'required|exists:afps,id',
        ]);

        $employee->update($request->only('afp_id'));

        Cache::forget('employees');
        Cache::forget('afps');

        return $employee->load('afp');
    }
}
