<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Requests\CreateClientRequests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Client;

class ClientsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Client $clients)
	{
		$clients = $clients->paginate(10);

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
	public function store(Client $client, CreateClientRequests $requests)
	{
		$client->create($requests->all());

		return redirect()->route('clients.index')
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
	public function Update(Client $client, CreateClientRequests $requests)
	{
		$client->update($requests->all());

		return redirect()->route('clients.index')
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
