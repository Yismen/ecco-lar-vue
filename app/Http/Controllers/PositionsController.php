<?php

namespace App\Http\Controllers;

// use App\Http\Request;
use App\Position;
use Illuminate\Http\Request;
use App\Rules\PositionUnique;

class PositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_positions|edit_positions|create_positions', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_positions', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_positions', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_positions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Position $positions, Request $request)
    {
        $positions = $positions
                ->orderBy('department_id')
                ->orderBy('name')
                ->with('department')
                ->withCount(['employees' => function ($query) {
                    return $query->actives();
                }])
                ->with('payment_type')
                ->with('payment_frequency')
                ->paginate(50);

        if ($request->ajax()) {
            return $positions;
        }
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Position $position, Request $request)
    {
        if ($request->ajax()) {
            return $position->append([
                    'departments_list',
                    'payment_types_list',
                    'payment_frequencies_list',
                ]);
        }

        return view('positions.create', compact('position'));
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

        if ($request->ajax()) {
            return $position;
        }

        return redirect()->route('admin.positions.index')
            ->withSuccess("Position $position->name has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Position $position, Request $request)
    {
        if ($request->ajax()) {
            return $position;
        }

        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Position $position, Request $request)
    {
        if ($request->ajax()) {
            return $position;
        }

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

        $position->update($request->only(['name', 'department_id', 'payment_frequency_id', 'payment_type_id', 'salary']));

        if ($request->ajax()) {
            return $position->load('department', 'payment_frequency', 'payment_type');
        }

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

        if ($request->ajax()) {
            return $position;
        }

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
            'salary' => 'required|numeric|min:45|max:500000',
        ]);

        return $this;
    }

    protected function createPosition($position, $request)
    {
        $position->create($request->all());

        return $position;
    }
}
