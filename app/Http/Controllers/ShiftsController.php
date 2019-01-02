<?php

namespace App\Http\Controllers;

use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-shifts|edit-shifts|create-shifts', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-shifts', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-shifts', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-shifts', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Cache::rememberForever('shifts', function() {
            return Shift::get();
        });;

        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:shifts',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);

        Cache::forget('shifts');

        $shift = Shift::create($request->only(['name', 'start', 'end']));

        return redirect()->route('admin.shifts.index')
            ->withSuccess('Shift '. $shift->name . ' created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        return view('shifts.show', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $this->validate($request, [
            'name' => 'required|unique:shifts,name,'.$shift->id,
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);

        Cache::forget('shifts');

        $shift->update($request->only(['name', 'start', 'end']));

        return redirect()->route('admin.shifts.index')
            ->withSuccess('Shift '. $shift->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        Cache::forget('shifts');

        return redirect()->route('admin.shifts.index')
            ->withWarning("Card $shift->name has been removed.");
    }
}
