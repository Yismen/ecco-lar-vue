<?php namespace App\Http\Controllers;

use App\Address;
use App\Card;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\ImageUploader;
use App\Login;
use App\Punch;
use App\Termination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\Datatables\Datatables;

class EmployeesController extends Controller {

	function __construct() {
		// $this->middleware('clear_cache:employees', ['except'=>['index', 'show', 'create', 'edit']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @Get("/employees")
	 * @return Response
	 */
	public function index(Employee $employees, Request $request,  Carbon $carbon, Datatables $datatables)
	{
		$employees = $this->getEmployees($employees, $request, $carbon);

		if ($request->ajax()) return view('employees._employees', compact('employees'));

		return view('employees.index', compact('employees'));
	}

	private function getEmployees($employees, $request, $carbon)
	{
		$status = $request->input('status');
		$search = $request->input('search');

		$employees = $this->applyScopeStatusToTheQuery($status, $employees);

		$employees = $this->applySearchScopeToTheQuery($search, $employees);

		// $employees = $this->appyDatesScopesToTheQuery($search, $employees, $carbon);

		$employees = $employees
			->orderBy('hire_date')
			->orderBy('first_name')
			// ->where('hire_date', '>=', $carbon->month(5))
			->with('positions')
			// ->get();
			->paginate(10)
			->appends(['status'=>$status, 'search'=>$search]);

		return $employees;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @Get("employees/create")
	 * @return Response
	 */
	public function create(Employee $employee, Department $departments)
	{
		// $departments = $departments->lists('department', 'id');

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
		// return $employee;

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
		/**
		 * Validate the request
		 */
		$this->validateRequest($request, $employee);

		$employee->update($request->all());

		Cache::forget('employees');

		return redirect()->route('admin.employees.edit', $employee->id)
			->withSuccess("Succesfully updated employee [$request->first_name $request->last_name]");

	}

	public function updateAddress(Employee $employee, Address $address, Request $request)
	{
		$this->validate($request, [
			'sector'         => 'required',
			'street_address' => 'required',
			'city'           => 'required',		
		]);

		if ($employee->addresses) {
			$employee->addresses->update($request->all());
		} else {
			$newAddress = new $address([
				'sector'         => $request->input('sector'),
				'street_address' => $request->input('street_address'),
				'city'           => $request->input('city'),
				]);

			$employee->addresses()->save($newAddress);
		}

		if ($request->ajax()) {
			return response()->json([
				'status'  => 1, 
				'employee' => $employee, 
				'message' => "$employee->first_name's address updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("$employee->first_name's address updated!");

	}

	public function updateCard(Employee $employee, Card $card, Request $request)
	{
		$this->validate($request, [
			'card'        => 'required|numeric|digits:8|', 
		]);

		if ($employee->card) {
			$employee->card->update($request->all());
		} else {
			$card = new $card(['card'=>$request->input('card')]);
			$employee->card()->save($card);
		}

		if ($request->ajax()) {
			return response()->json([
				'status'  => 1, 
				'employee' => $employee, 
				'message' => "$employee->first_name's Card updated!"
				]);
		}

		return redirect()->route('admin.employees.show', $employee->id)
			->withSuccess("Card Number Updated");
	}

	public function updatePunch(Employee $employee, Punch $punch, Request $request)
	{
		$this->validate($request, [		    
			'punch'        => 'required|numeric|digits:5', 
		]);

		if ($employee->punch) {
			$employee->punch->update($request->all());
		} else {
			$punch = new $punch(['punch'=>$request->input('punch')]);
			$employee->punch()->save($punch);
		}

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
				'status' => 1, 
				'photo' => url($employee->photo), 
				'employee' => $employee,
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

	/**
	 * validates employees request against a set of rules. Prevent continues if validation fails
	 * @return boolean validation passed|failed
	 */
	private function validateRequest(Request $request, $employee)
	{
		return $this->validate($request, [
		    'first_name' => 'required',
		    'last_name' => 'required',
		    'hire_date' => 'required|date',
		    'personal_id' => 'required|digits:11|unique:employees,personal_id,'.$employee->id,
		    'date_of_birth' => 'required|date',
		    'cellphone_number' => 'required|digits:10|unique:employees,cellphone_number,'.$employee->id,
		    'secondary_phone' => 'digits:10',
		    'gender_id' => 'required|exists:genders,id',
		    'marital_id' => 'required|exists:maritals,id',
		    'has_kids' => 'required|boolean',
		    'position_id' => 'required|exists:positions,id',
		]);
	}

	/**
	 * apply scope status if the status is defined
	 * @param  string $status    the stsatus to be applied to the query
	 * @param  model $employees the current employees query
	 * @return query            collections of employees
	 */
	private function applyScopeStatusToTheQuery($status, $employees)
	{
		// if (!$status) {
		// 	$status = 'actives';
		// }

		if (!in_array($status, ['actives', 'inactives'])) return $employees;

		
		return $employees = $employees->$status();
		
	}

	/**
	 * apply scope search if the search is defined
	 * @param  string $search    the stsatus to be applied to the query
	 * @param  model $employees the current employees query
	 * @return query            collections of employees
	 */
	private function applySearchScopeToTheQuery($search, $employees)
	{

		if (!$search) return $employees;

		$search = explode(',', $search);

		foreach ($search  as $q) {
			$q = trim($q);
			$employees = $employees
				->orWhere('first_name', 'like', "%$q%")
				->orWhere('last_name', 'like', "%$q%")
				->orWhere('personal_id', 'like', "%$q%")
				->orWhere('cellphone_number', 'like', "%$q%")
				// ->orWhere('status', '=', "$q")
				// ->orWhereHas('positions.name', 'like', "%$q%")
				->orWhere('secondary_phone', 'like', "%$q%")
				->orWhere('id', 'like', $q);
		}
		
		return $employees;
		
	}

	private function appyDatesScopesToTheQuery($search, $employees, $carbon)
	{

	}
}
