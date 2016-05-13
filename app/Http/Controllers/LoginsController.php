<?php namespace App\Http\Controllers;

use App\Http\Requests\LoginsRequests;
use App\Http\Controllers\Controller;

use App\Login;

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
	public function store(Login $login, LoginsRequests $requests)
	{
		$login->create($requests->all());

		return redirect()->route('logins.show', $login->id)
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
	public function update(Login $login, LoginsRequests $requests)
	{
		$login->update($requests->all());

		return redirect()->route('logins.show', $login->id)
			->withSuccess("Login $login->login has been updated!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
