<?php

namespace Dainsys\Payrolls\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayrollsReportsController extends Controller
{
    public function index()
    {
        return view('payrolls_reports::tss.index');
    }

    public function reports(Request $request)
    {
        return $this->validate($request, [
            'name'=>'required'
        ]);
    }
    
}