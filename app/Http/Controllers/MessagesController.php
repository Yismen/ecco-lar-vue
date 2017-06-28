<?php 

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;

class MessagesController extends Controller 
{
	public function __construct()
	{
		$this->users = User::orderBy('name', 'ASC')->get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Message $messages)
	{
		// Auth::getUser()
		return \Auth::user()->messages;
		return $messages->with('user')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->users;

		return view('messages.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->validate($request, [
			'recipient_id' => 'required|exits:users',
			'body' => 'required|min:5|max:50',
		]);

		$message = $this->user()->messages()->create($request->only(['recipient_id', 'body']));

		dd($message);

		event(new MessageCreated($this->user));

		return redirect()->route('admin.messages.index')
			->withSuccess("Message Sent");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
