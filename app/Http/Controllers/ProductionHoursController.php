<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use App\Production;
use App\Supervisor;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ProductionsUpdateRequest;

class ProductionHoursController extends Controller
{
    private $request;
    private $supervisorsList;

    public function __construct(Request $request)
    {
        // $this->middleware('authorize:view_production-hours|edit_production-hours|create_production-hours', ['only'=>['index','show']]);
        // $this->middleware('authorize:edit_production-hours', ['only'=>['edit','update']]);
        // $this->middleware('authorize:create_production-hours', ['only'=>['create','store']]);
        // $this->middleware('authorize:destroy_production-hours', ['only'=>['destroy']]);
        $this->request = $request;  
        $this->supervisorsList =  Supervisor::lists('name', 'name')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisorsList = $this->supervisorsList;    

        return view('production-hours.index', compact('supervisorsList'));
    }

    public function queryByDate()
    {
        $this->validate($this->request, [
            'date' => 'required|date',
            'supervisor'=>'required|exists:supervisors,name'
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $this->request->input('date'))->format('Y-m-d');
        $supervisor = $this->request->input('supervisor');
        $supervisorsList = $this->supervisorsList;

        $employees = $this->getEmployeesWithProduction($date, $supervisor);

        $this->request->flash();

        if ($this->request->ajax()) {
            return view('production-hours._results', compact('employees', 'supervisorsList'));
        }
        
        return view('production-hours.index', compact('employees', 'supervisorsList'));
    }

    /**
     * Retrieve a list of employees belonging to the provided supervisor and
     * having production for the given date. Otherwiles null will be returned.
     * $date [date]     The insert date in the production table.
     * $supervisor [string]     The supervisor assigned to the employees.
     */
    private function getEmployeesWithProduction($date, $supervisor)
    {
        return Employee::whereHas('productions', function($query)use($date){
            return $query->where('insert_date', '=', $date);
        })
        ->whereHas('supervisor', function($query)use($supervisor){
            return $query->where('name', '=', $supervisor);
        })
        ->with(['productions' => function($query)use($date){
            return $query->with('source')
                ->orderBy('name', 'ASC')
                ->with('client')
                ->where('insert_date', $date)
                ->get();
        }])
        ->orderBy('first_name')
        ->paginate(25)->appends(['date'=>$date, 'supervisor'=>$supervisor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Create method will not be needed";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "Store method will not be needed";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Show method will not be needed";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        $clientList = \App\Client::orderBy('name')->lists('name', 'id');
        $sourceList = \App\Source::orderBy('name')->lists('name', 'id');
        $reasonsList = \App\Reason::orderBy('reason')->lists('reason', 'id')->toArray();
        // $reasonsList[0] = '<-- Please Select -->';
        // dd($production->client()->lists('name', 'id')->toArray());

        return view('production-hours.edit', compact('production', 'clientList', 'sourceList', 'reasonsList'));
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
        $production->update($request->only(['in_time','production_hours', 'break_time', 'downtime', 'out_time']));

        return redirect()->route('admin.production-hours.edit', $production->id)
            ->withSuccess("Production $production->id has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
