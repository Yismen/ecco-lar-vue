<?php

namespace App\Http\Controllers;

// use App\Http\PunchesCreateRequests\PunchesCreateRequest;
use App\Punch;
use App\Employee;
use App\Http\Requests\PunchesCreateRequest;
use App\Repositories\PunchRepository;
use Yajra\DataTables\Facades\DataTables;

class PunchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-punches|edit-punches|create-punches', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-punches', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-punches', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-punches', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            $employees_missing_punch = Employee::actives()->whereDoesntHave('punch')
                ->sorted()
                ->paginate(25);

            return view('punches.index', compact('employees_missing_punch'));
        }

        $punches = Punch::with('employee');

        return DataTables::of($punches)
            ->orderColumn('employee', 'slug $1')
            ->toJson(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Punch $punch)
    {        
        return view('punches.create', compact('punch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Punch $punch, PunchesCreateRequest $request)
    {
        $punch->create($request->only('punch', 'employee_id'));

        return redirect()->route('admin.punches.index')
            ->withSuccess("Punch number $punch->punch has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param int  Punch $punch
     *
     * @return Response
     */
    public function show(Punch $punch)
    {
        return view('punches.show', compact('punch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Punch $punch
     *
     * @return Response
     */
    public function edit(Punch $punch)
    {
        return view('punches.edit', compact('punch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int  Punch $punch
     *
     * @return Response
     */
    public function update(Punch $punch, PunchesCreateRequest $request)
    {
        // $this->validate($request, [
        //     'punch' => "required|digits:5|unique:punches,punch,$punch->id,id",
        //     'employee_id' => "required|exists:employees,id|unique:punches,employee_id,$punch->id,id",
        // ]);

        $punch->update($request->only('punch', 'employee_id'));

        return redirect()
            ->route('admin.punches.index')
            ->withSuccess("Punch $punch->card has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Punch $punch
     *
     * @return Response
     */
    public function destroy(Punch $punch)
    {
        $punch->delete();

        return redirect()->route('admin.punches.index')
            ->withWarning("Punch $punch->punch has been deleted!");
    }
}
