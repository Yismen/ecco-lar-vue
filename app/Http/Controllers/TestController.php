<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use GrahamCampbell\Flysystem\Facades\Flysystem as Flysystem;

class TestController extends Controller
{
    public function vue()
    {
        return view('test.vue');
    }

    public function apiVueUsers(Request $request)
    {
        return User::take(3)->latest()->select(['name', 'email'])->get();
    }

    public function apiVue(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'body' => 'required|min:5',
        ]);

        return [
            'name' => $request->name,
            'email' => $request->body,
        ];
    }

    public function flySystem()
    {
        return $this->testTrait();

        // you can alias this in config/app.php if you like

        Flysystem::connection('dropbox')->put('hi.txt', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        // we're done here - how easy was that, it just works!

        return Flysystem::connection('dropbox')->read('hi.txt'); // this will return foo

        return 'published';
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

    public function testComponent()
    {
        $carbon = new Carbon();
        // $data = [
        //     $carbon->today() => 'Today',
        //     $carbon->yesterday() => 'Yesterday',
        //     $carbon->week => 'This Week',
        //     $carbon->subWeek(1) => 'Last Week',
        //     $carbon->month => 'This Month',
        //     $carbon->subMonth() => 'Last Mont',
        //     $carbon->year => 'This Year',
        //     $carbon->subYear(1) => 'Last Year'
        // ];
        return ($data = [
                    'today' => $carbon->toDateString(),
                    'yesterday' => $carbon->yesterday(),
                    'this_week' => $carbon->weekOfYear,
                    'last_week' => $carbon->subWeek(1),
                    'this_month' => $carbon->month,
                    'last_month' => $carbon->subMonth(),
                    'this_year' => $carbon->year,
                    'last_year' => $carbon->subYear(1),
                ]);

        return view('test.component', compact('data'));
    }
}
