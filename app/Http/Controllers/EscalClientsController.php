<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EscalClient;

class EscalClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-escalations-clients|edit-escalations-clients|create-escalations-clients', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-escalations-clients', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-escalations-clients', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-escalations-clients', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EscalClient $escalclients)
    {
        $escalclients = $escalclients
            ->orderBy('name')
            ->paginate(10);

        return view('escalclients.index', compact('escalclients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EscalClient $escalclient)
    {
        return view('escalclients.create', compact('escalclient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalClient $escalclient, Request $request)
    {
        $this->validateRequest($request, $escalclient);

        // $escalclient->slug = $request->name;
        $escalclient->create($request->only('name'));

        return redirect()->route('admin.escalations_clients.index')
            ->withSuccess("Escalations Client $escalclient->name have been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EscalClient $escalclient)
    {
        return view('escalclients.show', compact('escalclient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EscalClient $escalclient)
    {
        return view('escalclients.edit', compact('escalclient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EscalClient $escalclient)
    {
        $this->validateRequest($request, $escalclient);

        // $escalclient->slug = $request->name;
        $escalclient->update($request->only('name'));

        return redirect()->route('admin.escalations_clients.index')
            ->withWarning("Escalations Client $escalclient->name have been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EscalClient $escalclient)
    {
        $escalclient->delete();

        return redirect()->route('admin.escalations_clients.index')
            ->withDanger("Escalations Client $escalclient->name have been removed!");
    }

    private function validateRequest($request, $escalclient)
    {
        return $this->validate($request, [
            'name' => "required|max:150|unique:escal_clients,name,$escalclient->id,id"
        ]);
    }
}
