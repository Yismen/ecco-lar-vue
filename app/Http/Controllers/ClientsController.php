<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_clients|edit_clients|create_clients', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_clients', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_clients', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_clients', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Client $clients)
    {
        $clients = $clients->with('departments')->with('sources')->paginate(25);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Client $client)
    {
        return view('clients.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Client $client, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:clients',
            // 'departments' => 'required',
            'departments.*' => 'exists:departments,id',
            // 'sources' => 'required',
            'sources.*' => 'exists:sources,id'
        ]);

        $client = $client->create($request->only(['name', 'departments', 'sources']));

        $client->departments()->sync((array)$request->departments);
        $client->sources()->sync((array)$request->sources);

        return redirect()->route('admin.clients.index')
            ->withSuccess("Client $client->name has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function Update(Client $client, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:clients,id,' . $client->id . ',id',
            // 'departments' => 'required',
            'departments.*' => 'exists:departments,id',
            // 'sources' => 'required',
            'sources.*' => 'exists:sources,id'
        ]);

        $client->update($request->only('name', 'departments', 'sources'));

        $client->departments()->sync((array)$request->departments);
        $client->sources()->sync((array)$request->sources);

        return redirect()->route('admin.clients.index')
            ->withSuccess("Client $client->name updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->withWarning("Client $client->name has been removed!");
    }
}
