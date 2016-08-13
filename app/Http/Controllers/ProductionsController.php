<?php namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class ProductionsController extends Controller {

	protected $requiredFields = [
					'insert_date',	
					'employee_id',
					'name',
					'production_hours',
					'downtime',
					'production',
					'client_id',
					'source_id',
					'reason_id',
				];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Production $productions)
	{
		$productions = $productions
						->groupBy('insert_date')
						->groupBy('client_id')
						->groupBy('source_id')
						->orderby('insert_date')
						->with('source')
						->with('client')
						->select(DB::raw('
							insert_date,
							year,
							month,
							week,
							sum(production) AS production,
							sum(production_hours) AS production_hours,
							sum(downtime) AS downtime,
							source_id,
							client_id
							'))
						->paginate(5);

		return view('productions.index', compact('productions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Production $production)
	{
		return view('productions.create', compact('production'));
	}
	
	public function saveData(Production $production, Request $request)
	{
		
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store(Production $production, Request $request)
	{
		$this->validate($request, [
			'file.*' => 'required|file|max:3000|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		]);

		foreach ($request->file('file') as $file) {

			if (!$this->checkFileName($file->getClientOriginalName(), $request)) {
				if($request->ajax()) return response()->json([
					'type'=>'error',
					'message'=>'Seems like the wrong file was selected. Make sure you pick a \'production_data\' file!'
				]);
				return redirect()->route('admin.productions.create')
					->withDanger("Seems like the wrong file was selected. Make sure you pick a 'production_data' file!");
			};

			$this->loadDataToDB($production, $file);
		}
		
		return redirect()->route('admin.productions.index')
			->withSuccess("Production data loaded to the production table.");
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  Production $production
	 * @return Response
	 */
	public function show(Production $production)
	{
		return view('productions.show', compact('production'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  Production $production
	 * @return Response
	 */
	public function edit(Production $production)
	{
		return view('productions.edit', compact('production'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  Production $production
	 * @return Response
	 */
	public function update(Production $production, Request $request)
	{
		$production->update($request->all());
		
		return redirect()->route('productions.index')
			->withSuccess("Production $production->id has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  Production $production
	 * @return Response
	 */
	public function destroy(Production $production)
	{
		//
	}

	public function show_date(Request $request, Production $production, Carbon $carbon, $date)
	{
		$productions =  $production
			->whereInsertDate($date)
			->with('reason')
			->with('source')
			->with('client')
			->paginate(25);

		return view('productions.show_date', compact('productions'));
		return $request->all();
	}

	/**
	 * [loadDataToDB description]
	 * @param  [type] $data       [description]
	 * @param  [type] $production [description]
	 * @return [type]             [description]
	 */
	private function loadDataToDB($production, $file)
	{
		$data = Excel::load($file)->toArray();

		foreach ($data as $row) {
			//validate if the fields passed are in the allowed fields array
			foreach ($row as $field=>$value) {
				if (!$this->validField($field)) { 
					return redirect()->route('admin.productions.create')
						// ->withResponse(302)
						->withDanger("Field $field is not part of the list of columns. Please make sure you selected the correct file");
				}
			}				

			$this->removeIfExistis($row);

			// these values will be mutated by the model
			$row['year']  = str_random(4);
			$row['month'] = str_random(2);
			$row['week']  = str_random(2);
			$row['unique_id']  = str_random(20);
			$production = $production->create($row);
				
		}

		return $this;
	}

	/**
	 * Remove previous instances of the model.
	 * @param  Production $production [description]
	 * @return [type]                 [description]
	 */
	private function removeIfExistis($row)
	{
		$remove = Production::whereInsertDate($row['insert_date'])
						->whereEmployeeId($row['employee_id'])
						->whereClientId($row['client_id'])
						->whereSourceId($row['source_id'])
						->first();

		if ($remove) $remove->delete();

		return $this;
	}

	public function show_employee(Request $request, $date)
	{
		return $date;
		return $request->all();
	}

	/**
	 * Validate if the passed field is in the valid field array
	 * @param  string $field field in the file
	 * @return boolean        the field is in the array
	 */
	private function validField($field)
	{
		return in_array($field, $this->requiredFields);
	}

	/**
	 * Check if the correct file has been selected, based on the name of the file.
	 * @param  string $fileName :The name of the file.
	 * @param  object $request  :the Laravel request object.
	 * @return [type]           [description]
	 */
	private function checkFileName($fileName, $request)
	{
		if(!stripos($fileName, 'roduction_data')) {
			return false;			
		}

		return true;
	}
}
