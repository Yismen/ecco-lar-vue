<?php namespace App\Http\Controllers;

// use App\Http\Request;
use App\Position;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionsController extends Controller {

	public function __construct()
	{
		$this->middleware('authorize:view_positions|edit_positions|create_positions', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_positions', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_positions', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_positions', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Position $positions)
	{
		$positions = $positions
			->orderBy('department_id')
			->orderBy('name')
			->with('department')
			->with('payment')
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
	public function store(Position $position, Request $request)
	{
		$this->validateRequest($request, $position);

		$position = $this->createPosition($position, $request);

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
	public function update(Position $position, Request $request)
	{
		$this->validateRequest($request, $position);

		$position->update($request->all());

		return redirect()->route('admin.positions.show', $position->id)
			->withSuccess("Position $position->name has been ubdated!!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Position $position, Request $request)
	{
		$position->delete();
		
		return redirect()->route('admin.positions.index')
			->withWarning("Position $position->name has been removed!");
	}

	protected function validateRequest($request, $position)
	{
		$this->validate($request, [
			'name' => 'required|min:2|unique:positions,name,'.$position->id.',id',
			'department_id' => 'required|exists:departments,id',
			'payment_id' => 'required|exists:payments,id',
			'salary' => 'required|numeric|min:0|max:500000',
		]);

		return $this;
	}

	protected function createPosition($position, $request)
	{		
		$department = Department::find($request->department_id);

		$position->name = $department ? $department->department.' - '.$request->name : $requet->name;
		$position->department_id = $request->department_id;
		$position->payment_id = $request->payment_id;
		$position->salary = $request->salary;

		$position->save();

		return $position;

	}

}
