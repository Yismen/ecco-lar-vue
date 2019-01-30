<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

// use App\Http\Requests\Request;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_departments|edit_departments|create_departments', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_departments', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_departments', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_departments', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Department $departments, Request $request)
    {
        $departments = Cache::rememberForever('departments', function() {
            return Department::orderBy('name')->get();
        });;

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments,name'
        ]);

        $department = $department->create($request->only('name'));

        Cache::forget('departments');
        Cache::forget('employees');

        if ($request->ajax()) {
            return $department;
        }

        return redirect()->route('admin.departments.index')
            ->withSuccess("Department $department->name has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => "required|unique:departments,name,$department->id,id"
        ]);

        Cache::forget('departments');
        Cache::forget('employees');

        $department->update($request->only('name'));

        return redirect()->route('admin.departments.edit', $department->id)->withSuccess("HH RR Department $department->name has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        Cache::forget('departments');
        Cache::forget('employees');

        return redirect()
            ->route('admin.departments.index')
            ->withWarning("HH RR Department $department->name has been removed");
    }
}
