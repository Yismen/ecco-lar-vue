<?php namespace App\Http\Controllers;

use App\Http\Requests\PunchesRequests;
use App\Http\Controllers\Controller;

use App\Punch;

// use Illuminate\Http\Request;

class PunchesController  extends Controller {
	public function __construct()
	{
		$this->middleware('authorize:view_punches|edit_punches|create_punches', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_punches', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_punches', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_punches', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Punch $punches)
	{
		$punches = $punches->with('employee')->paginate(10);

		return view('punches.index', compact('punches'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Punch $punch)
	{
		return view('punches.create', compact('punch'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Punch $punch, PunchesRequests $request)
	{
		$punch->create($request->all());

		return redirect()->route('punches.index')
			->withSuccess("Punch number $punch->card has been created!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  Punch $punch
	 * @return Response
	 */
	public function show(Punch $punch)
	{
		return view('punches.show', compact('punch'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  Punch $punch
	 * @return Response
	 */
	public function edit(Punch $punch)
	{
		return view('punches.edit', compact('punch'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  Punch $punch
	 * @return Response
	 */
	public function update(Punch $punch, PunchesRequests $request)
	{
		$punch->update($request->all());

		return redirect()->route('punches.index')
			->withSuccess("Punch $punch->card has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  Punch $punch
	 * @return Response
	 */
	public function destroy(Punch $punch)
	{
		//
	}

}
