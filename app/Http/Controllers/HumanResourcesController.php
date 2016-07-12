<?php namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class HumanResourcesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Employee $employees, Department $departments)
	{
		$dashboard = (object)[];
		$dashboard->all = $employees->count();
		$dashboard->actives = $employees->actives()->count();
		$dashboard->inactives = $employees->inactives()->count();
		$dashboard->by_department = $departments->with('employees')->get();

		// foreach ($dashboard->by_department as $key) {
		// 	$dashboard->by_department->$key = '';
		// 	echo $dashboard->by_department->$key->department = $key->employees()->count();
		// }

		$dashboard = response()->json($dashboard);

		return view('human_resources.index', compact('dashboard'));
	}

	
}
