<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class VIPController extends Controller
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
            'is_vip' => 'required|boolean',
        ]);

        Cache::forget('employees');
        

        if ($request->get('is_vip') == 1) {
            $employee->vip()->create(['since' => Carbon::now()]);
        } else {
            $employee->vip()->delete();
        }

        return $employee->load('vip');
    }
}
