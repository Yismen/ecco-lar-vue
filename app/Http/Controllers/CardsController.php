<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

// use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-cards|edit-cards|create-cards', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-cards', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-cards', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-cards', ['only' => ['destroy']]);
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
            'card' => "required|digits_between:5,8|unique:cards,card",
            'employee_id' => "required|exists:employees,id|unique:cards,employee_id",
        ]);

        $card = $card->create($request->only('card', 'employee_id'));

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
        $this->validate($request, [
            'card' => "required|digits_between:5,8|unique:cards,card,$card->id,id",
            'employee_id' => "required|exists:employees,id|unique:cards,employee_id,$card->id,id",
        ]);

        $card->update($request->only('card', 'employee_id'));

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
        $card->delete();

        return redirect()->route('admin.cards.index')
            ->withDanger("Card $card->card has been removed.");
    }
}
