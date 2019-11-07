<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UniversalController extends Controller
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
            'is_universal' => 'required|boolean',
        ]);

        Cache::forget('employees');        

        if ($request->get('is_universal') == 1) {
            $employee->universal()->create(['since' => Carbon::now()]);
        } else {
            $employee->universal()->delete();
        }

        return $employee->load('universal');
    }
}
