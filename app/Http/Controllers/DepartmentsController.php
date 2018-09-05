<?php 

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

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
        $departments = $departments->orderBy('department')->paginate(15);

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Department $department)
    {
        $department = $department->orderBy('department')->paginate(10);

        return view('departments.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, Department $department)
    {
        $this->validate($request, [
            'department' => 'required|unique:departments,department'
        ]);
        
        $department->create($request->only('department'));

        return redirect()->route('admin.departments.index')
            ->withSuccess("Department $department->department has been added!");
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
    public function edit(Department $departments)
    {
        return view('departments.edit', compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validateRequest($department, $request);

        $department->update($request->all());

        return redirect()->route('admin.departments.edit', $department->id)->withSuccess("HH RR Department $department->department has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Department $department)
    {
        $department->destroy($department->id);

        return redirect()
            ->route('admin.departments.index')
            ->withWarning("HH RR Department $department->department has been removed");
    }

    protected function validateRequest($department, $request)
    {
        return $this->validate($request, [
            'department' => "required|unique:departments,department,$department->id,id"
        ]);
    }
}
