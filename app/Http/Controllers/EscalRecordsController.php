<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\EscalClient;
use App\EscalRecord;
use App\Http\Requests;
use Validator;

class EscalRecordsController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->middleware('authorize:view_escalations_records|edit_escalations_records|create_escalations_records', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_escalations_records', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_escalations_records', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_escalations_records', ['only'=>['destroy']]);
        
        // $request->flash();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EscalRecord $escalations_records, Request $request)
    {
        if ($request->ajax()) {
            return $escalations_records = auth()->user()
                ->escalationsRecords()
                ->whereDate('created_at', '=', Carbon::today())
                ->latest()
                ->with('escal_client')
                ->paginate(10);
        }
        
        return redirect('/admin/escalations_records/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EscalRecord $escalations_record, Request $request)
    {
        $escalations_records = auth()->user()
            ->escalationsRecords()
            ->whereDate('created_at', '=', Carbon::today())
            ->latest()
            ->with('escal_client')
            ->paginate(10);

        if ($request->ajax()) {
            return $escalations_records;
        }

        // $request->flashOnly(['escal_client_id']);

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
        $insert_date = Carbon::today()->format('Y-m-d');
        $this->replaceRequest($request)->validateStore($request, $escalations_record, $insert_date);

        $escalation_record = auth()->user()->escalationsRecords()->create([
            'tracking' => $request->tracking,
            'escal_client_id' => $request->escalations_client_id,
            'insert_date' => $insert_date,
            'is_additional_line' => $request->is_additional_line,
            'is_bbb' => $request->is_bbb
        ]);

        if ($request->ajax()) {
            return $escalation_record;
        }

        // $request->flashOnly('escal_client_id');

        return redirect()
            ->route('admin.escalations_records.create')
            ->withInput($request->except('tracking', 'is_bbb'))
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
        $this->replaceRequest($request)->validateUpdate($request, $escalations_record);
       
        // $escalations_record->tracking = $request->tracking;
        $escalations_record->escal_client_id = $request->escalations_client_id;
        $escalations_record->is_additional_line = $request->is_additional_line;
        $escalations_record->is_bbb = $request->is_bbb;
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
        $search = $request->search;

        $this->validate($request, [
            'search' => 'required|int|exists:escal_records,tracking'
            ]);


        return redirect('admin/escalations_records');
        $escalations_record = auth()->user()->escalationsRecords()->orWhere('tracking', 'like', "%$search%")
        ->with('escal_client')
                ->get();

        if ($request->ajax()) {
            return $escalations_records;
        }

        return view('escalations_records.create', compact('escalations_record', 'escalations_records'));
    }

    public function getClients()
    {
        return EscalClient::select('name', 'id')->get();
    }

    private function validateStore($request, $escalations_record, $insert_date)
    {
        return $this->validate($request, [
            'tracking' => "required|int|digits:9|unique:escal_records,tracking,id,$escalations_record->id,insert_date,$insert_date",
            'escalations_client_id' => "required|int|exists:escal_clients,id",
        ]);
    }

    private function validateUpdate($request, $escalations_record)
    {
        return $this->validate($request, [
            'tracking' => "required|int|digits:9",
            'escalations_client_id' => "required|int|exists:escal_clients,id",
        ]);
    }

    public function replaceRequest($request)
    {
        $request->replace([
            'tracking' => trim($request->tracking),
            'escalations_client_id' => $request->escalations_client_id,
            'is_additional_line' => $request->is_additional_line,
            'is_bbb' => $request->is_bbb,
        ]);

        return $this;
    }
}
