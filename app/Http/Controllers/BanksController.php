<?php

namespace App\Http\Controllers;

use Cache;
use App\Bank;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-banks', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-banks', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-banks', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-banks', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banks = Cache::rememberForever('banks', function() {
            return Bank::orderBy('name')->get();
        });

        if ($request->ajax()) {
            return $banks;
        }

        return view('banks.index', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'name' => 'required|unique:banks'
        ]);

        Cache::forget('banks');
        Cache::forget('employees');

        $bank = $bank->create($request->all());

        if ($request->ajax()) {
            return $bank;
        }

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
        $this->validate($request, [
            'name' => 'required|unique:banks,name,' . $bank->id
        ]);

        Cache::forget('banks');
        Cache::forget('employees');

        $bank->update($request->all());

        if ($request->ajax()) {
            return $bank;
        }

        return redirect()->route('admin.banks.index')
            ->withSuccess("Bank $bank->name Updated!!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank, Request $request)
    {
        if ($bank->accounts->count() > 0) {
            if ($request->ajax()) {
                return abort(403, "The bank {$bank->name} can't be removed because it already has accounts and employees assigned!");
            }
            return redirect()->route('admin.banks.index')
                ->withDanger("The bank {$bank->name} can't be removed because it already has accounts and employees assigned!");
        }

        Cache::forget('banks');
        Cache::forget('employees');

        $bank->delete();

        if ($request->ajax()) {
            return $bank;
        }

        return redirect()->route('admin.banks.index')
            ->withWarning("The bank {$bank->name} has been deleted!");
    }
}
