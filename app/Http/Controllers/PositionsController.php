<?php namespace App\Http\Controllers;

// use App\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Position;

class PositionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Position $positions)
	{
		$positions = $positions
			->with('departments')
			->with('payments')
			->paginate(10);

		return view('positions.index', compact('positions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Position $position)
	{
		return view('positions.create', compact('position'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Position $position, Request $requests)
	{
		$position = $position->create($requests->all());
		return redirect()->route('admin.positions.index')
			->withSuccess("Position $position->name has been created!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Position $position)
	{
		return view('positions.show', compact('position'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Position $position)
	{
		return view('positions.edit', compact('position'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Position $position, Request $requests)
	{
		$position->update($requests->all());

		return redirect()->route('admin.positions.show', $position->id)
			->withSuccess("Position $position->name has been ubdated!!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Position $position, Request $requests)
	{
		$position->delete();
		
		return redirect()->route('admin.positions.index')
			->withWarning("Position $position->name has been removed!");
	}

}
