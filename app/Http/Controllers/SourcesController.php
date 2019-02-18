<?php

namespace App\Http\Controllers;

use App\Source;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-sources|edit-sources|create-sources', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-sources', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-sources', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-sources', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sources = Source::all();

        return view('sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Source $source)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);

        return $source->create($request->only(['name']));

        return $source;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        return view('sources.show', compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return $source;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);

        $source->update($request->only(['name']));

        return $source;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        $source->delete();

        return redirect()->route('admin.sources.index');
    }
}
