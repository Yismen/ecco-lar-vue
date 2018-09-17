<?php namespace App\Http\Controllers;

// use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Punch;

class PunchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_punches|edit_punches|create_punches', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_punches', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_punches', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_punches', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Punch $punches)
    {
        $punches = $punches->with(['employee' => function ($query) {
            return $query->orderBy('first_name', 'ASC');
        }])
            ->paginate(10);

        return view('punches.index', compact('punches'));
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
    public function store(Punch $punch, Request $request)
    {
        $this->validateRequest($request, $punch);

        $punch->punch = $request->punch;
        $punch->employee_id = $request->employee_list;
        $punch->save();

        return redirect()->route('admin.punches.index')
            ->withSuccess("Punch number $punch->punch has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Punch $punch
     * @return Response
     */
    public function show(Punch $punch)
    {
        return view('punches.show', compact('punch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Punch $punch
     * @return Response
     */
    public function edit(Punch $punch)
    {
        return view('punches.edit', compact('punch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  Punch $punch
     * @return Response
     */
    public function update(Punch $punch, Request $request)
    {
        $this->validateRequest($request, $punch);

        $punch->punch = $request->punch;
        $punch->employee_id = $request->employee_list;
        $punch->save();

        return redirect()->route('admin.punches.index')
            ->withSuccess("Punch $punch->card has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Punch $punch
     * @return Response
     */
    public function destroy(Punch $punch)
    {
        $punch->delete();

        return redirect()->route('admin.punches.index')
            ->withWarning("Punch $punch->punch has been deleted!");
    }

    public function validateRequest($request, $punch)
    {
        return $this->validate($request, [
            'punch' => "required|digits:5|unique:punches,punch,$punch->id,id",
            'employee_list' => "required|exists:employees,id|unique:punches,employee_id,$punch->id,id",
        ], [
            'employee_list.unique' => "Employee ID $request->employee_list has been taken!",
        ]);
    }
}
