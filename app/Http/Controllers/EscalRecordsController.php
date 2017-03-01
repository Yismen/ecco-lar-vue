<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\EscalRecord;
use Carbon\Carbon;

class EscalRecordsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('authorize:view_escalatios_records|edit_escalatios_records|create_escalatios_records', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_escalatios_records', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_escalatios_records', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_escalatios_records', ['only'=>['destroy']]);
        $this->user = auth()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EscalRecord $escalations_records)
    {
        return redirect('/admin/escalations_records/create');
        // $escalations_records = $escalations_records
        //     ->latest()
        //     ->paginate(10);
        
        // return view('escalations_records.index', compact('escalations_records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EscalRecord $escalations_record)
    {
        $escalations_records = $this->user
            ->escalationsRecords()
            ->whereDate('created_at', '=', Carbon::today())
            ->latest()
            ->with('escal_client')
            ->paginate(25);

        return view('escalations_records.create', compact('escalations_record', 'escalations_records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalRecord $escalations_record, Request $request)
    {

        $this->validateRequest($request, $escalations_record);

        $this->user->escalationsRecords()->create([
            'tracking' => $request->tracking, 
            'escal_client_id' => $request->escalations_client_id
        ]);

        return redirect()->route('admin.escalations_records.create')
            ->withSuccess("Escalations record $request->tracking have been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EscalRecord $escalations_record)
    {        
        return view('escalations_records.show', compact('escalations_record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EscalRecord $escalations_record)
    {
        return view('escalations_records.edit', compact('escalations_record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EscalRecord $escalations_record)
    {
        $this->validateRequest($request, $escalations_record);
       
        $escalations_record->tracking = $request->tracking;
        $escalations_record->escal_client_id = $request->escalations_client_id;
        $escalations_record->save();

        return redirect()->route('admin.escalations_records.create')
            ->withWarning("Escalations record $escalations_record->tracking updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EscalRecord $escalations_record)
    {
        $escalations_record->delete();

        return redirect()->route('admin.escalations_records.index')
            ->withDanger("Escalations Client $escalations_record->name have been removed!");
    }

    private function validateRequest($request, $escalations_record)
    {
        $request->replace([
            'tracking' => trim($request->tracking),
            'escalations_client_id' => $request->escalations_client_id,
        ]);

        return $this->validate($request, [
            'tracking' => "required|int|digits:9|unique:escal_records,tracking,$escalations_record->id,id",
            'escalations_client_id' => "required|int|exists:escal_clients,id",
        ]);
    }
}
