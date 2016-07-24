<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentsRequest;
use App\Http\Controllers\Controller;

use App\Department;


class DepartmentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Department $departments)
	{
		$departments = $departments->orderBy('department')->with('positions.employees')->get();
		
		return view('departments.index', compact('departments'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Department $departments)
	{
		$departments =  $departments->orderBy('department')->paginate(10);

		return view('departments.create', compact('departments'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateDepartmentsRequest $request, Department $departments)
	{
		$departments->create($request->all());

		return \Redirect::route('departments.create')->withSuccess("Succesfully created department [$request->department];");

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		//
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
	public function update(CreateDepartmentsRequest $request, Department $departments)
	{
		$departments->update($request->all());

		return redirect()->route('departments.create')->withSuccess("HH RR Department $departments->department has been updated");
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
			->route('departments.create')
			->withWarning("HH RR Department $departments->department has been removed");

	}

}
