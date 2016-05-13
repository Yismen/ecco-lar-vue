<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemsRequests;

use App\System;

// use Illuminate\Http\Request;

class SystemsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(System $systems)
	{
		$systems =  $systems->paginate(10);

		return view('systems.index', compact('systems'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(System $system)
	{
		return view('systems.create', compact('system'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(System $system, SystemsRequests $requests)
	{
		$system = $system->create($requests->all());

		return redirect()->route('systems.show', $system->id)
			->withSuccess("System [$system->name] has been Created");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(System $system)
	{
		return view('systems.show', compact('system'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(System $system)
	{
		return view('systems.edit', compact('system'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(System $system, SystemsRequests $requests)
	{
		$system->update($requests->all());

		return redirect()->route('systems.show', $system->id)
			->withSuccess("Information for system [$system->name] has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(System $system)
	{
		$system->delete();

		return redirect()->route('systems.index')
			->withWarning("Information for system [$system->name] has been deleted");
	}

}
