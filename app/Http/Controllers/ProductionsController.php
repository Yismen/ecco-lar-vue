<?php

namespace App\Http\Controllers;

use Storage;
use App\Employee;
use Carbon\Carbon;
use App\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductionsUpdateRequest;

class ProductionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_productions|edit_productions|create_productions', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_productions', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_productions', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_productions', ['only' => ['destroy']]);
    }

    /**
     * Tihs fields must be present in the header o the file, otherwise
     * the data would not be loaded.
     */
    protected $requiredFields = [
                    'insert_date',
                    'employee_id',
                    'name',
                    'in_time',
                    'production_hours',
                    'break_time',
                    'downtime',
                    'out_time',
                    'production',
                    'reason_id',
                    'client_id',
                    'source_id',
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
            ->groupBy('source_id')
            ->groupBy('client_id')
            ->orderby('insert_date', 'DESC')
            ->with(['source' => function ($query) {
                return $query->orderBy('name');
            }])
            ->with(['client' => function ($query) {
                return $query->orderby('name');
            }])
            ->select(DB::raw('
				insert_date,
				sum(production) AS production,
				sum(production_hours) AS production_hours,
				sum(downtime) AS downtime,
				source_id,
				client_id
				'))
            ->paginate(50);

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
    public function store(Production $production, Request $request)
    {
        $this->validate($request, [
            'file.*' => 'required|file|max:3000|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);

        foreach ($request->file('file') as $file) {
            if (!$this->checkFileName($file->getClientOriginalName(), $request)) {
                if ($request->ajax()) {
                    return response()->json([
                    'type' => 'error',
                    'message' => 'Seems like the wrong file was selected. Make sure you pick a \'production_data\' file!'
                ]);
                }

                return redirect()->route('admin.productions.create')
                    ->withDanger("Seems like the wrong file was selected. Make sure you pick a 'production_data' file!");
            };

            $this->loadDataToDB($production, $file);
        }

        return redirect()->route('admin.productions.index')
            ->withSuccess('Production data loaded to the production table.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Production $production
     * @return Response
     */
    public function show(Production $production, Request $request, $date)
    {
        $productions = Production::where('insert_date', $date)
            ->orderBy('name')
            ->with('employee')
            ->with('client')
            ->with('source')
            ->get();

        return view('productions.show', compact('productions', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Production $production
     * @return Response
     */
    public function edit(Production $production)
    {
        $clientList = \App\Client::orderBy('name')->pluck('name', 'id');
        $sourceList = \App\Source::orderBy('name')->pluck('name', 'id');
        $reasonsList = \App\Reason::orderBy('reason')->pluck('reason', 'id')->toArray();
        // $reasonsList[0] = '<-- Please Select -->';
        // dd($production->client()->pluck('name', 'id')->toArray());

        return view('productions.edit', compact('production', 'clientList', 'sourceList', 'reasonsList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  Production $production
     * @return Response
     */
    public function update(Production $production, ProductionsUpdateRequest $request)
    {
        // return $request->only(['in_time','production_hours', 'break_time', 'downtime', 'out_time']);
        $production->update($request->only(['in_time', 'production_hours', 'break_time', 'downtime', 'out_time']));

        return redirect()->route('admin.productions.edit', $production->id)
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
        // return $date = $carbon->parse('2016-09-27');
        // return ($date->subWeeks(3));
        $productions = $production
            ->whereInsertDate($date)
            ->orderBy('name')
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
            foreach ($row as $field => $value) {
                if (!$this->validField($field)) {
                    return redirect()->route('admin.productions.create')
                        // ->withResponse(302)
                        ->withDanger("Field $field is not part of the list of columns. Please make sure you selected the correct file");
                }
            }

            $this->removeIfExistis($row);

            // These values will be mutated by the model. Just making sure
            // they are part of the data sent.
            // $row['year']  = str_random(4);
            // $row['month'] = str_random(2);
            // $row['week']  = str_random(2);
            $row['unique_id'] = str_random(20);
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

        if ($remove) {
            $remove->delete();
        }

        return $this;
    }

    public function show_employee(Request $request, $date)
    {
        return $date;
        return $request->all();
    }

    /**
     * Find the production hours for a given date.
     * @param  Request $request [description]
     * @param  [type]  $date    [description]
     * @return [type]           [description]
     */
    public function getProductionHours(Request $request, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');

        $employees = Employee::has('productions')
            ->with(['productions' => function ($query) use ($date) {
                return $query->with('source')
                    ->with('client')
                    ->where('insert_date', $date)
                    ->get();
            }])
            ->paginate(10);

        return view('productions.hours.index', compact('employees'));
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
        if (!stripos($fileName, 'roduction_data')) {
            return false;
        }

        return true;
    }
}
