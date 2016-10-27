<?php namespace App\Http\Controllers;

use App\Http\Requests\SaveContactsRequest;
use App\Http\Controllers\Controller;

// use App\Http\Requests\Request;

use App\Contact;

class ContactsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Contact $contacts)
	{
		// dd(\Request::route());
		$contacts = $contacts->Currentuser()->with('user')->orWhere('public', 1)->orderBy('name')->paginate(15);

		return view('contacts.index', compact('contacts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('contacts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Contact $contact, SaveContactsRequest $request)
	{	
		$request['username'] = \Auth::user()->username;

		$contact->create($request->all());

		return \Redirect::route("contacts.index")
			->withSuccess("Your contact $request->name has been crated!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Contact $contact)
	{
		return view("contacts.show", compact('contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Contact $contact)
	{
		if ( $contact->username != \Auth::user()->username )
			return \Redirect::route("contacts.index")
				->withDanger("This contact belongs to other user. You are not allowed to Edit or Delete it!");

		return view('contacts.edit', compact('contact'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Contact $contact, SaveContactsRequest $request)
	{

		if ( $contact->username != \Auth::user()->username && $contact->public == 0)
			return \Redirect::route("contacts.index")
				->withDanger("This contact belongs to other user. You are not allowed to Edit or Delete it!");

		$contact->update( $request->all() );

		return \Redirect::route("contacts.index")
			->withSuccess("Your contact $request->name has been updated succesffully!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Contact $contact)
	{		
		if ( $contact->username != \Auth::user()->username && $contact->public == 0)
			return \Redirect::route("contacts.index")
				->withDanger("This contact belongs to other user. You are not allowed to Edit or Delete it!");
		$contact->destroy( $contact->id );

		return \Redirect::route("contacts.index")
			->withWarning("Your contact $contact->name has been remvoed!");
	}

}
