<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_banks', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_banks', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_banks', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_banks', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banks = Bank::all();

        if ($request->ajax()) {
            return $banks;
        }

        return view('banks.index', compact('banks'));
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
    public function store(Request $request, Bank $bank)
    {
        $this->validateRequest($request, $bank);

        $bank->create($request->all());

        return redirect()->route('admin.banks.index')
            ->withSuccess("Bank $bank->name created!!!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validateRequest($request, $bank);

        $bank->update($request->all());

        return redirect()->route('admin.banks.index')
            ->withSuccess("Bank $bank->name Updated!!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
    }

    protected function validateRequest($request, $bank)
    {
        $this->validate($request, [
            'name' => 'required|unique:banks,name,' . $bank->id
        ]);
    }
}
