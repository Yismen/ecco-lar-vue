<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\EscalRecord;
use App\EscalClient;
use Carbon\Carbon;

class EscalRecordsController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->middleware('authorize:view_escalations_records|edit_escalations_records|create_escalations_records', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_escalations_records', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_escalations_records', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_escalations_records', ['only'=>['destroy']]);
        $this->user = auth()->user();

        // $request->flash(); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EscalRecord $escalations_records, Request $request)
    {     
        if (!$request->ajax()) {
            // comment this line to allow the Vue app take control...
            return redirect('/admin/escalations_records/create');
        }

        $escalations_records = $this->user
            ->escalationsRecords()
            ->whereDate('created_at', '=', Carbon::today())
            ->latest()
            ->with('escal_client')
            ->paginate(10);
            // ->get();
         
        if ($request->ajax()) {
           return $escalations_records;
        }
        return view('escalations_records.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EscalRecord $escalations_record, Request $request)
    {
        // return redirect('admin/escalations_records');
        $escalations_records = $this->user
            ->escalationsRecords()
            ->whereDate('created_at', '=', Carbon::today())
            ->latest()
            ->with('escal_client')
            ->paginate(10);

        if ($request->ajax()) {
            return $escalations_records;
        }

        // $request->flashOnly(['escal_client_id']);

        return view('escalations_records.createOld', compact('escalations_record', 'escalations_records'));
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

        $escalation_record = $this->user->escalationsRecords()->create([
            'tracking' => $request->tracking, 
            'escal_client_id' => $request->escalations_client_id
        ]);

        if ($request->ajax()) {
            return $escalation_record;
        }

        // $request->flashOnly('escal_client_id');

        return redirect()
            ->route('admin.escalations_records.create')
            ->withInput($request->except('tracking'))
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

        return redirect()->route('admin.escalations_records.create')
            ->withDanger("Escalations Client $escalations_record->name have been removed!");
    }

    public function search(Request $request)
    {
        $this->validate($request, ['search'=>'required']);
        $search = $request->search;

        if ($search) {
            return EscalRecord::orWhere('tracking', 'like', "%$search%")
                // ->orWhere(['escal_client', function($query) use ($search){
                //     $query->orWhere('name', 'like', "%$search%");
                // }])
                ->get();
        }
    }

    public function getClients()
    {
        return EscalClient::select('name', 'id')->get();
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
