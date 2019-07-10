<?php

namespace App\Http\Controllers;

use Cache;
use App\Employee;
use App\Nationality;
use Illuminate\Http\Request;

class NationalitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-nationalities|edit-nationalities|create-nationalities', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-nationalities', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-nationalities', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-nationalities', ['only' => ['destroy']]);
        $this->middleware('authorize:assign-nationalities-employees', ['only' => ['reAssign']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $free_employees = Employee::doesntHave('nationality')
            ->orderBy('first_name')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->orderBy('second_last_name')
            ->actives()
            ->get();

        $nationalities = Cache::rememberForever('nationalities', function () {
            return Nationality::orderBy('name', 'ASC')
                ->with(['employees' => function ($query) {
                    return $query
                        ->orderBy('first_name')
                        ->orderBy('first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name')
                        ->actives();
                }])->get();
        });

        if ($request->ajax()) {
            return $nationalities;
        }

        return view('nationalities.index', compact('nationalities', 'free_employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nationalities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Nationality $nationality)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:nationalities',
        ]);

        $nationality = $nationality->create($request->only(['name']));

        Cache::forget('nationalities');
        Cache::forget('employees');

        if ($request->ajax()) {
            return $nationality;
        }

        return redirect()->route('admin.nationalities.index')
            ->withSuccess("Nationality {$nationality->name} created");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Nationality $nationality)
    {
        return view('nationalities.show', compact('nationality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
        return view('nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nationality $nationality)
    {
        $this->validateRequest($request, $nationality);

        $nationality->update($request->all());

        Cache::forget('nationalities');
        Cache::forget('employees');

        return redirect()->route('admin.nationalities.index')
            ->withWarning("Record {$nationality->name} updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        return redirect()->route('admin.nationalities.index')
            ->withDanger('Deleting a nationality is not allowed at this moment. You can re-use them by changing the name. If you still requires to delete a Nationality consult with the administrator!');
    }

    public function assignEmployees(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required|array',
            'nationality' => 'required|exists:nationalities,id',
        ], [
            'employee.required' => 'Select at least one employee!',
        ]);

        Cache::forget('nationalities');
        Cache::forget('employees');

        foreach ($request->employee as  $id) {
            $employee = Employee::whereId($id)->first();

            $employee->update(['nationality_id' => $request->get('nationality')]);
        }

        return redirect()->route('admin.nationalities.index')
            ->withSuccess('Done!');
    }

    protected function validateRequest(Request $request, Nationality $nationality)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:nationalities,name,'.$nationality->id,
        ]);
    }
}
