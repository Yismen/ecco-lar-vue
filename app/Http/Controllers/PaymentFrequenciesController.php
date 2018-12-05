<?php

namespace App\Http\Controllers;

// use App\Http\Request;
use Illuminate\Http\Request;
use App\PaymentFrequency;

class PaymentFrequenciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_payment_frequencies|edit_payment_frequencies|create_payment_frequencies', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_payment_frequencies', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_payment_frequencies', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_payment_frequencies', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PaymentFrequency $payment_frequencies)
    {
        $payment_frequencies = $payment_frequencies
            ->paginate(10);

        return view('payment_frequencies.index', compact('payment_frequencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(PaymentFrequency $payment_frequency)
    {
        return view('payment_frequencies.create', compact('payment_frequency'));
    }

    public function show($payment_frequency)
    {
        return view('payment_frequencies.show', compact('payment_frequency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PaymentFrequency $payment_frequency, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_frequencies,name'
        ]);

        $payment_frequency = $payment_frequency->create($request->only(['name']));

        return redirect()->route('admin.payment_frequencies.index')
            ->withSuccess("PaymentFrequency $payment_frequency->name has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(PaymentFrequency $payment_frequency)
    {
        return view('payment_frequencies.edit', compact('payment_frequency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PaymentFrequency $payment_frequency, Request $request)
    {
        $this->validate($request, [
            'name' => "required|unique:payment_frequencies,name,$payment_frequency->id,id"
        ]);

        $payment_frequency->update($request->only(['name']));

        return redirect()->route('admin.payment_frequencies.show', $payment_frequency->id)
            ->withSuccess("payment $payment_frequency->name has been ubdated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PaymentFrequency $payment_frequency, Request $request)
    {
        $payment_frequency->delete();

        if ($request->ajax()) {
            return $payment_frequency;
        }

        return redirect()->route('admin.payment_frequencies.index')
            ->withWarning("payment $payment_frequency->name has been removed!");
    }
}
