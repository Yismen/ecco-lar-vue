<?php 

namespace App\Http\Controllers;


use App\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Login $logins)
	{
		$logins = $logins->with('employee')
			->with('system')
			->paginate(10);

		return view('logins.index', compact('logins'));
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

}
