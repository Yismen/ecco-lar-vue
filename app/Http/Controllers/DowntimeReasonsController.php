<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DowntimeReason;

class DowntimeReasonsController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('authorize:view-downtime-reasons|edit-downtime-reasons|create-downtime-reasons', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-downtime-reasons', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-downtime-reasons', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-downtime-reasons', ['only' => ['destroy']]);

        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $downtime_reasons = DowntimeReason::orderBy('name')->get();

        return view('downtime_reasons.index', compact('downtime_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('downtime_reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|unique:downtime_reasons,name'
        ]);

        $downtime_reason = DowntimeReason::create($request->only(['name']));

        return redirect()->route('admin.downtime_reasons.index')
            ->withSuccess("Downtime Reason {$downtime_reason->name} created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(DowntimeReason $downtime_reason)
    {
        return view('downtime_reasons.show', compact('downtime_reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(DowntimeReason $downtime_reason)
    {
        return view('downtime_reasons.edit', compact('downtime_reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(DowntimeReason $downtime_reason, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|unique:downtime_reasons,name,' . $downtime_reason->id
        ]);

        $downtime_reason->update($request->only(['name']));

        return redirect()->route('admin.downtime_reasons.index')
            ->withSuccess("Downtime Reason $downtime_reason->name has been updated");
    }
}
