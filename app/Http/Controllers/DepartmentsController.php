<?php 

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;


class DepartmentsController extends Controller {

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
		$department =  $department->orderBy('department')->paginate(10);

		return view('departments.create', compact('department'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, Department $department)
	{
		return $request->all();
		$department->create($request->all());

		return redirect()->route('admin.departments.create')
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
		$department->update($request->all());

		return redirect()->route('admin.departments.create')->withSuccess("HH RR Department $department->department has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Department $departments)
	{
		$departments->destroy($departments->id);

		return redirect()
			->route('admin.departments.index')
			->withWarning("HH RR Department $departments->department has been removed");

	}

}
