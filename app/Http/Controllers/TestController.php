<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class TestController extends Controller
{
    public function testDatatablesView()
    {
        return view('test.datatables');
    }

    public function testDatatablesData(Employee $employees)
    {
       return Datatables::eloquent(
            $employees->query()
        )->make(true);
    }
}
