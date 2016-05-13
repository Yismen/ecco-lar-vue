<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProductionsRequests;
// use Illuminate\Http\Request;
// use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

use Storage;

use App\Production;

// use Illuminate\Http\Request;

class ProductionsController extends Controller {

	protected $requiredFields = [
					'insert_date',	
					'employee_id',
					'name',
					'production_hours',
					'production',
					'client',
					'source',
				];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Production $productions)
	{
		$productions = $productions->with('employee')->paginate(10);

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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function saveData(Production $production, ProductionsRequests $request)
	{
		
	}
	public function store(Production $production, ProductionsRequests $request)
	{
		// foreach (\Request::file('production') as $request) {
		// 	$this->saveData($production, $request);
		// }

		$localPath = 'storage/productions/daily_data/'; // local folder where the image will be loaded to
		$file = $request->file('production');
		$fileName = $file->getClientOriginalName(); // $fileName = str_random(40); //username sha1ed, so it is unique

		// validate file name, first indicatio if the correct file has been selected
		if(! stripos($fileName, 'roduction_data')) {
			return redirect()->route('productions.create')
				// ->withResponse(302)
				->withDanger("Seems like the wrong file was selected. Make sure you pick a 'production_data' file!");
		}

		// Import the data from the excel file
		$data = Excel::load($file)->toArray();

		if ($data) {
			// save a copy of the file to a local folder in the server
			$file->move($localPath, $fileName);

			foreach ($data as $row) {
				//validate if the fields passed are in the allowed fields array
				foreach ($row as $field=>$value) {
					if (!$this->validField($field)) { 
						return redirect()->route('productions.create')
							// ->withResponse(302)
							->withDanger("Field $field is not part of the list of columns. Please make sure you selected the correct file");
					}
				}

				// delete any previous instance of this record
				$exists = $production
						->whereInsertDate($row['insert_date'])
						->whereEmployeeId($row['employee_id'])
						->whereClient($row['client'])
						->whereSource($row['source'])
						->first();

				if ($exists) {
					$exists->delete();
				}

				Production::create($row);
					
			}

		} else {
			return $load;
		}	

		return redirect()->route('productions.index')
				->withSuccess("Data added.");	

		
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
	public function update(Production $production, ProductionsRequests $request)
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

	/**
	 * Validate if the passed field is in the valid field array
	 * @param  string $field field in the file
	 * @return boolean        the field is in the array
	 */
	public function validField($field)
	{
		return in_array($field, $this->requiredFields);
	}
}
