<?php 

namespace App\Http\Controllers;

// use App\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;

class PaymentsController extends Controller {

	public function __construct()
	{
		$this->middleware('authorize:view_payments|edit_payments|create_payments', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_payments', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_payments', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_payments', ['only'=>['destroy']]);
	}

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
		return view('payments.create', compact('payment'));
	}

	public function show($payment, Request $request)
	{
		if ($request->ajax()) {
			return $payment;
		}
		
		return view('payments.show', compact('payment'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Payment $payment, Request $request)
	{
		$this->validateRequest($payment, $request);

		$payment = $payment->create($request->only(['payment_type']));

		return redirect()->route('admin.payments.index')
			->withSuccess("Payment $payment->name has been created!");
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
	public function edit(Payment $payment)
	{
		return view('payments.edit', compact('payment'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Payment $payment, Request $request)
	{
		$this->validateRequest($payment, $request);

		$payment->update($request->only(['payment_type']));
		
		return redirect()->route('admin.payments.show', $payment->id)
			->withSuccess("payment $payment->name has been ubdated!!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Payment $payment, Request $request)
	{
		$payment->delete();

		return redirect()->route('admin.payments.index')
			->withWarning("payment $payment->name has been removed!");
	}

	/**
	 * Validate the form submitted by the user.
	 * @param  object $payment the current payment model being passed.
	 * @param  object $request the form array.
	 * @return [type]          [description]
	 */
	private function validateRequest($payment, $request)
	{
		return $this->validate($request, [
			'payment_type' => "required|unique:payments,payment_type,$payment->id,id"
		]);
	}

}
