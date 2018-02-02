<?php 

namespace App\Http\Controllers;


use App\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Maatwebsite\Excel\Facades\Excel;

class LoginsController extends Controller {

	public function __construct()
	{
		$this->middleware('authorize:view_logins|edit_logins|create_logins', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_logins', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_logins', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_logins', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$logins = Login::with('employee')
			->with('system')
			->orderBy('employee_id')->orderBy('login')
			->paginate(100);

		$employees = Employee::orderBy('first_name')->actives()->get()->pluck('fullName', 'id')->toArray();
		$employees['%'] = '%*(All)';

		return view('logins.index', compact('logins', 'employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Login $login)
	{
		return view('logins.create', compact('login'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Login $login, Request $requests)
	{
		$this->validateRequest($requests);

		$login->create($requests->all());

		return redirect()->route('admin.logins.show', $login->id)
			->withSuccess("Login $login->login has been created!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Login $login)
	{
		return view('logins.show', compact('login'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Login $login)
	{	
		return view('logins.edit', compact('login'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Login $login, Request $requests)
	{
		$login->update($requests->all());

		return redirect()->route('admin.logins.show', $login->id)
			->withSuccess("Login $login->login has been updated!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Login $login)
	{
		$login->delete();

		return redirect()->route('admin.logins.index')
			->withDanger("Login $login->login has been removed.");
	}

	private function validateRequest($request)
	{
		return $this->validate($request, [
			'login' => 'required',
			'employee_id' => 'required|exists:employees,id',
		]);
	}

	public function toExcel(Request $request)
	{
		$logins = Login::with('employee')
			->whereHas('employee', function($query) use ($request) {
				return $query->where('employee_id', 'like', $request->employee_id);
			})
			->with('system')
			->orderBy('employee_id')->orderBy('login')
			->get();

		Excel::create('Logins', function($excel) use($logins) {
			$excel->sheet('Logins', function($sheet) use($logins) {
				$sheet->loadView('logins.partials.results-to-excel', compact('logins'));
			});
		})->download();
	}

}
