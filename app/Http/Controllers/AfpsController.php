<?php

namespace App\Http\Controllers;

use Cache;
use App\Afp;
use App\Employee;
use Illuminate\Http\Request;

class AfpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-afps|edit-afps|create-afps', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-afps', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-afps', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-afps', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $free_employees = Employee::doesntHave('afp')
            ->actives()
            ->get();

        $afps = Cache::rememberForever('afps', function () {
            return Afp::with(['employees' => function ($query) {
                return $query
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->actives();
            }])->orderBy('name')->get();
        });

        if ($request->ajax()) {
            return $afps;
        }

        return view('afps.index', compact('afps', 'free_employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('afps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:afps,name'
        ]);

        Cache::forget('employees');
        Cache::forget('afps');

        $afp = Afp::create($request->only('name'));

        if ($request->ajax()) {
            return $afp;
        }

        return redirect()->route('admin.afps.index')
            ->withSuccess("AFP $afp->name created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Afp $afp
     * @return \Illuminate\Http\Response
     */
    public function show(Afp $afp)
    {
        return view('afps.show', compact('afp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Afp $afp
     * @return \Illuminate\Http\Response
     */
    public function edit(Afp $afp)
    {
        return view('afps.edit', compact('afp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Afp $afp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afp $afp)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:afps,name,' . $afp->id
        ]);

        Cache::forget('employees');
        Cache::forget('afps');

        $afp->update($request->only(['name']));

        return redirect()->route('admin.afps.index')
            ->withSuccess("AFP $afp->name Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Afp $afp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afp $afp, Request $request)
    {
        Cache::forget('employees');
        Cache::forget('afps');

        if ($afp->employees->count()) {
            if ($request->ajax()) {
                return abort(403, "AFP $afp->name has employees therefore it can't be deleted!");
            }
            return redirect()->back()
                ->withDanger("AFP $afp->name has employees therefore it can't be deleted!");
        }

        $afp->delete();

        if ($request->ajax()) {
            return $afp;
        }

        return redirect()->route('admin.afps.index')
            ->withDanger("AFP $afp->name have been eliminated!");
    }

    public function assignEmployees(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required|array',
            'afp' => 'required|exists:afps,id'
        ], [
            'employee.required' => 'Select at least one employee!'
        ]);

        Cache::forget('employees');
        Cache::forget('afps');

        foreach ($request->employee as  $id) {
            $employee = Employee::whereId($id)->first();

            $employee->update(['afp_id' => $request->afp]);
        }

        return redirect()->route('admin.afps.index')
            ->withSuccess("Done!");
    }
}
