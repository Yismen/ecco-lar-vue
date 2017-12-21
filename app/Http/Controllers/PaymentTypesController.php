<?php 

namespace App\Http\Controllers;

// use App\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaymentType;

class PaymentTypesController extends Controller {

	public function __construct()
	{
		$this->middleware('authorize:view_payment_types|edit_payment_types|create_payment_types', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_payment_types', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_payment_types', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_payment_types', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(PaymentType $payment_types)
	{
		$payment_types = $payment_types
			->paginate(10);

		return view('payment_types.index', compact('payment_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(PaymentType $payment_type)
	{
		return view('payment_types.create', compact('payment_type'));
	}

	public function show($payment_type, Request $request)
	{
		if ($request->ajax()) {
			return $payment_type;
		}
		
		return view('payment_types.show', compact('payment_type'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PaymentType $payment_type, Request $request)
	{
		$this->validateRequest($payment_type, $request);

		$payment_type = $payment_type->create($request->only(['name']));

		return redirect()->route('admin.payment_types.index')
			->withSuccess("PaymentType $payment_type->name has been created!");
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
	public function edit(PaymentType $payment_type)
	{
		return view('payment_types.edit', compact('payment_type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PaymentType $payment_type, Request $request)
	{
		$this->validateRequest($payment_type, $request);

		$payment_type->update($request->only(['name']));
		
		return redirect()->route('admin.payment_types.show', $payment_type->id)
			->withSuccess("payment $payment_type->name has been ubdated!!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(PaymentType $payment_type, Request $request)
	{
		$payment_type->delete();

		return redirect()->route('admin.payment_types.index')
			->withWarning("payment $payment_type->name has been removed!");
	}

	/**
	 * Validate the form submitted by the user.
	 * @param  object $payment_type the current payment model being passed.
	 * @param  object $request the form array.
	 * @return [type]          [description]
	 */
	private function validateRequest($payment_type, $request)
	{
		return $this->validate($request, [
			'name' => "required|unique:payment_types,name,$payment_type->id,id"
		]);
	}

}
