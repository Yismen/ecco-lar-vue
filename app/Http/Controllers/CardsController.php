<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;

// use Illuminate\Http\Request;

class CardsController extends Controller {

	function __construct() {
		// $this->niddleware = ['authorize:'];
		$this->middleware('authorize:view_cards|edit_cards|create_cards', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_cards', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_cards', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_cards', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Card $cards)
	{
		$cards = $cards->with('employee')->paginate(10);

		// return $unassigned = $cards->get();

		return view('cards.index', compact('cards'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Card $card)
	{
		return view('cards.create', compact('card'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Card $card, Request $request)
	{
		$this->validate($request, [
		    'card' => 'required|integer|digits_between:5,8',
		    'employee_id' => 'required|exists:employees,id',
		]);

		$card->create($request->all());

		return redirect()->route('admin.cards.index')
			->withSuccess("Card number $card->card has been created!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  Card $card
	 * @return Response
	 */
	public function show(Card $card)
	{
		return view('cards.show', compact('card'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  Card $card
	 * @return Response
	 */
	public function edit(Card $card)
	{
		return view('cards.edit', compact('card'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  Card $card
	 * @return Response
	 */
	public function update(Card $card, Request $request)
	{
		$card->update($request->all());
		
		return redirect()->route('admin.cards.index')
			->withSuccess("Card $card->card has been updated");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  Card $card
	 * @return Response
	 */
	public function destroy(Card $card)
	{
		//
	}

}
