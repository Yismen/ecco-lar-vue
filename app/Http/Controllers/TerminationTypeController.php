<?php

namespace App\Http\Controllers;

use App\TerminationType;
use Illuminate\Http\Request;

class TerminationTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-termination-types|edit-termination-types|create-termination-types', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-termination-types', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-termination-types', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-termination-types', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TerminationType::orderBy('name')->get();

        return view('termination_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('termination_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:termination_types'
        ]);

        $termination_type = TerminationType::create(
            $request->only(['name', 'description'])
        );

        return redirect()->route('admin.termination_types.index')
                    ->withSuccess("Termination Type $termination_type->name created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  TerminationType $termination_type
     * @return \Illuminate\Http\Response
     */
    public function show(TerminationType $termination_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  TerminationType $termination_type
     * @return \Illuminate\Http\Response
     */
    public function edit(TerminationType $termination_type)
    {
        return view('termination_types.edit', compact('termination_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  TerminationType $termination_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TerminationType $termination_type)
    {
        $this->validate($request, [
            'name' => 'required|unique:termination_types,name,' . $termination_type->id,
        ]);

        $termination_type->update(
            $request->only(['name', 'description'])
        );

        return redirect()->route('admin.termination_types.index')
            ->withWarning("Termination name $termination_type->name Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  TerminationType $termination_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(TerminationType $termination_type)
    {
        //
    }
}
