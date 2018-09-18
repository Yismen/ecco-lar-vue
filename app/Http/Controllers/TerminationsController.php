<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTerminationsRequest;
use App\Termination;

class TerminationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_terminations|edit_terminations|create_terminations', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_terminations', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_terminations', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_terminations', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Termination $terminations)
    {
        return $terminations = $terminations
            ->with('employee')
            ->with('terminationType')
            ->with('terminationReason')
            ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Termination $terminations)
    {
        return view('terminations.create', compact('terminations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateTerminationsRequest $request, Termination $terminations)
    {
        return $terminations->create($request->all());

        return \Redirect::route('terminations.create')->withSuccess("Succesfully created department [$request->department];");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Termination $terminations)
    {
        return $terminations;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Termination $terminations)
    {
        return view('terminations.edit', compact('terminations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CreateTerminationsRequest $request, Termination $terminations)
    {
        return $request->all();
        $terminations->update($request->all());

        return redirect()->route('terminations.create')->withSuccess("HH RR Termination $terminations->department has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Termination $terminations)
    {
        $terminations->destroy($terminations->id);

        return redirect()
            ->route('terminations.create')
            ->withWarning("HH RR Termination $terminations->department has been removed");
    }
}
