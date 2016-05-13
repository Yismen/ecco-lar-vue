<?php namespace App\Http\Controllers;

// use App\Http\PaymentsRequests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PaymentsRequests;

use App\Payment;

class paymentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Payment $payments)
	{
		$payments = $payments
			->paginate(10);

		return view('payments.index', compact('payments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Payment $payment)
	{
		return view('payments.create', compact('position'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Payment $payment, PaymentsRequests $requests)
	{
		$payment = $payment->create($requests->all());
		return redirect()->route('payments.index')
			->withSuccess("Payment $payment->name has been created!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Payment $payment)
	{
		return view('payments.show', compact('position'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Payment $payment)
	{
		return view('payments.edit', compact('position'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Payment $payment, PaymentsRequests $requests)
	{
		$payment->update($requests->all());

		return redirect()->route('payments.show', $payment->id)
			->withSuccess("Position $payment->name has been ubdated!!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Payment $payment, PaymentsRequests $requests)
	{
		$payment->delete();

		return redirect()->route('payments.index')
			->withWarning("Position $payment->name has been removed!");
	}

}
