<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;

// use Illuminate\Http\Request;

class CardsController extends Controller {

	function __construct() {
		// $this->niddleware = ['authorize:'];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Card $cards)
	{
		return $cards = $cards->unassigned()->with('employee')->paginate(10);

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
		$card->create($request->all());

		return redirect()->route('cards.index')
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
		
		return redirect()->route('cards.index')
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
