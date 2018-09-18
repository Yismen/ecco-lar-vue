<?php

namespace App\Http\Controllers;

use App\TerminationReason;
use Illuminate\Http\Request;
use App\Http\Requests\TerminationReasonRequest;

class TerminationReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = TerminationReason::orderBy('reason')->get();

        return view('termination_reasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('termination_reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TerminationReasonRequest $request)
    {
        $termination_reason = TerminationReason::create(
            $request->only(['reason', 'description'])
        );

        return redirect()->route('admin.termination_reasons.index')
                    ->withSuccess("Termination Reason $termination_reason->reason created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  TerminationReason $termination_reason
     * @return \Illuminate\Http\Response
     */
    public function show(TerminationReason $termination_reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  TerminationReason $termination_reason
     * @return \Illuminate\Http\Response
     */
    public function edit(TerminationReason $termination_reason)
    {
        return view('termination_reasons.edit', compact('termination_reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TerminationReasonRequest  $request
     * @param  int  TerminationReason $termination_reason
     * @return \Illuminate\Http\Response
     */
    public function update(TerminationReasonRequest $request, TerminationReason $termination_reason)
    {
        $termination_reason->update(
            $request->only(['reason', 'description'])
        );

        return redirect()->route('admin.termination_reasons.index')
            ->withWarning("Termination reason $termination_reason->reason Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  TerminationReason $termination_reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(TerminationReason $termination_reason)
    {
        //
    }
}
