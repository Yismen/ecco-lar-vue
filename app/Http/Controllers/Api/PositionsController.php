<?php

namespace App\Http\Controllers\Api;

// use App\Http\Request;
use App\Position;
use App\Department;
use App\PaymentType;
use App\PaymentFrequency;
use Illuminate\Http\Request;
use App\Rules\PositionUnique;
use App\Http\Controllers\Controller;

class PositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:system-administrator');
        $this->middleware('authorize:view-positions|edit-positions|create-positions', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-positions', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-positions', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-positions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Position $positions, Request $request)
    {
        return $positions
            ->orderBy('department_id')
            ->orderBy('name')
            ->with('department')
            ->withCount(['employees' => function ($query) {
                return $query->actives();
            }])
            ->with('payment_type')
            ->with('payment_frequency')
            ->paginate(50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response([
            'departments' => Department::all(),
            'payment_types' => PaymentType::all(),
            'payment_frequencies' => PaymentFrequency::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Position $position, Request $request)
    {
        $this->validateRequest($request, $position);

        $position = $this->createPosition($position, $request);

        return redirect()->route('admin.positions.index')
            ->withSuccess("Position $position->name has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Position $position, Request $request)
    {
        $this->validateRequest($request, $position);

        $position->update($request->all());

        return redirect()->route('admin.positions.index')
            ->withSuccess("Position $position->name updated!");

        // return redirect()->route('admin.positions.show', $position->id)
        // 	->withSuccess("Position $position->name has been ubdated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Position $position, Request $request)
    {
        $position->delete();

        return redirect()->route('admin.positions.index')
            ->withWarning("Position $position->name has been removed!");
    }

    protected function validateRequest($request, $position)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'min:2',
                new PositionUnique($position, $request)
            ],
            'department_id' => 'required|exists:departments,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'payment_frequency_id' => 'required|exists:payment_frequencies,id',
            'salary' => 'required|numeric|min:0|max:500000',
        ]);

        return $this;
    }

    protected function createPosition($position, $request)
    {
        $position->create($request->all());

        return $position;
    }
}
