<?php 

namespace App\Http\Controllers;

use App\Login;
use App\Employee;
use Carbon\Carbon;
use App\Department;
use App\Termination;
use App\ImageUploader;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Http\Traits\EmployeesTrait;
use Intervention\Image\ImageManagerStatic as Image;
use App\Providers\EmployeeServiceProvider as EmployeeProvider;

class EmployeesController extends Controller 
{
	use EmployeesTrait;

	protected $provider;
	private $request;
	private $carbon;
	function __construct(Request $request, Carbon $carbon) {
		$this->request = $request;
		$this->carbon = $carbon;

		$this->middleware('authorize:view_employees|edit_employees|create_employees', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_employees', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_employees', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_employees', ['only'=>['destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @Get("/employees")
	 * @return Response
	 */
	public function index(Employee $employees, Datatables $datatables)
	{
		$employees = $this->getEmployees($employees, $this->request, $this->carbon);

		if ($this->request->ajax()) return view('employees._employees', compact('employees'));

		return view('employees.index', compact('employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @Get("employees/create")
	 * @return Response
	 */
	public function create(Employee $employee, Department $departments)
	{
		return view('employees.create', compact('employee', 'departments'));	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Employee $employee, Request $request)
	{
		$this->validateRequest($request, $employee);

		$employee = $employee->create($request->all());

		Cache::forget('employees');

		return \Redirect::route('admin.employees.index')
			->withSuccess("Succesfully added employee [$request->first_name $request->last_name];");
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Employee $employee)
	{
		return view('employees.show', compact('employee'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Employee $employee)
	{
		return view('employees.edit', compact('employee'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Employee $employee, Request $request)
	{
		$this->validateRequest($request, $employee);

		$employee->update($request->all());

		Cache::forget('employees');

		return redirect()->route('admin.employees.edit', $employee->id)
			->withSuccess("Succesfully updated employee [$request->first_name $request->last_name]");

	}

	public function updateAddress(Employee $employee, Request $request)
	{
		$this->validateAddressRequest($request);

		$employee->createOrUpdateAddress($request);		

		if ($request->ajax()) {
			return response()->json([
				'type' => 'success', 
				'message' => "$employee->first_name's address updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("$employee->first_name's address updated!");

	}

	public function updateCard(Employee $employee, Request $request)
	{
		$this->validateCardRequest($request);

		$employee->createOrUpdateCard($request);		

		if ($request->ajax()) {
			return response()->json([
				'type' => 'success', 
				'message' => "$employee->first_name's Card updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("Card Number Updated");
	}

	public function updatePunch(Employee $employee, Request $request)
	{
		$this->validate($request, [		    
			'punch' => 'required|numeric|digits:5', 
		]);

		$employee->createOrUpdatePunch($request);

		if ($request->ajax()) {
			return response()->json([
				'status'  => 1, 
				'employee' => $employee, 
				'message' => "$employee->first_name's Punch updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("Punch ID Updated");
	}

	public function createLogin(Employee $employee, Login $login, Request $request)
	{

		$this->validate($request, [
		    'login' => 'required|unique:logins,login,NULL,id,system_id,'.$request->input('system_id'),
		    'system_id' => 'required|exists:systems,id',
		]);

		$newlogin = $employee->logins()->create($request->all());
		$loginsList = $employee->logins;

		Cache::forget('employees');

		if ($request->ajax()) {
			// return view('employees.partials._logins', compact('loginsList'));
			return response()->json([
				'status'   => 1, 
				'employee' => $employee, 
				'newlogin' => $newlogin, 
				'system'   => $newlogin->system, 
				'system2'   => $request->login, 
				'message'  => "$employee->first_name's login [$request->login] has been created!"
			]);
		}

		return redirect()->route('admin.employees.edit', $employee->id)
			->withSuccess("Succesfully created [$request->login]");
	}

	public function updateLogin(Employee $employee, Login $login, Request $request)
	{
		if ($employee->logins) {
			$employee->logins->update($request->all());
		} else {
			$login = new $login([
				'login'=>$request->input('login'), 
				'system_id'=>$request->input('system_id')
				]);
			$employee->logins()->save($login);
		}

		if ($request->ajax()) {
			return response()->json([
				'status'  => 1, 
				'employee' => $employee, 
				'message' => "$employee->first_name's Login updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("Login Number Updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Employee $employee)
	{
		Cache::forget('employees');
		return $employee;

	}

	public function updatePhoto(Employee $employee, Request $request)
	{
		// $this->validatePhoto($request)
		// 	->crateImage('images/employees/')
		// 	->saveImage()
		// 	->updateEmployee();
			
		$this->validate($request, [
		    'photo' => 'required|image|max:3000',
		]);

		$image = new ImageUploader('images/employees/');

		$image = $image->saveImage($employee->id, $request->file('photo'));

		if ($image) {
			$employee->photo = $image;
			$employee->save();
		} 

		if ($request->ajax()) {
			return response()->json([
				'photo' => url($employee->photo), 
				'type' => 'success',
				'message' => "$employee->first_name's photo has been updated!"
			]);
		}

		return redirect()->route('admin.employees.edit', $employee->id)
			->withSuccess("$employee->first_name's photo has been updated!");
	}

	public function updateTermination(Request $request, $employee)
	{	

		$this->validate($request, [
		    'termination_date' => 'required|date',
		    'termination_type_id' => 'required|integer|exists:termination_types,id',
		    'termination_reason_id' => 'required|integer|exists:termination_reasons,id',
		    'can_be_rehired' => 'required|boolean',
		]);

		Termination::whereEmployeeId($employee->id)->delete();
		
		$termination = new Termination($request->all());
		$employee->termination()->save($termination);

		if ($request->ajax()) {
			return response()->json([
				'status' => 1, 
				'data' => $employee->termination, 
				'message' => "$employee->first_name's termination has been updated!"
				]);
		}

		return redirect()->route('admin.employees.edit', $employee->id)
			->withSuccess("$employee->first_name's termination has been updated!");


	}

	public function reactivate($employee, Request $request)
	{
		// return $request->all();
		// return $employee;
		if ($employee->termination) {
			$employee->termination->delete();
		}

		$employee->update($request->all());
		

		return redirect()->route('admin.employees.edit', $employee->id)
			->withWarning("Employee $employee->full_name has been reactivated. Please make sure to update Hire Date field");

	}
}
