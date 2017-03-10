<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;
use GrahamCampbell\Flysystem\Facades\Flysystem as Flysystem;

class TestController extends Controller
{
    use TestTrait;
    public function flySystem()
    {
        return $this->testTrait();
        
            // you can alias this in config/app.php if you like

            Flysystem::connection('dropbox')->put('hi.txt', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
            // we're done here - how easy was that, it just works!

            return Flysystem::connection('dropbox')->read('hi.txt'); // this will return foo

            return "published";
    }
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
