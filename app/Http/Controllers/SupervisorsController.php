<?php

namespace App\Http\Controllers;

use App\Supervisor;
use App\Http\Requests;
use Illuminate\Http\Request;

class SupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Supervisor $supervisors)
    {
        $supervisors = $supervisors  
            ->with(['department' => function($query){
                return $query->orderBy('department');
            }])
            ->orderBy('department_id')
            ->orderBy('name')
            ->paginate(25);

        return view('supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Supervisor $supervisor)
    {
        return view('supervisors.create', compact('supervisor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Supervisor $supervisor)
    {
        $this->validateRequest($request, $supervisor); 

        $supervisor->create($request->only(['name', 'department_id']));

        return redirect()->route('admin.supervisors.index')
            ->withSuccess("Supervisor $supervisor->name create!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show(Supervisor $supervisor)
    {        
        return view('supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
    {
        return view('supervisors.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        $this->validateRequest($request, $supervisor); 

        $supervisor->update($request->only(['name', 'department_id']));

        return redirect()->route('admin.supervisors.index')
            ->withSuccess("Supervisor $supervisor->name Updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supervisor $supervisor)
    {
        //
    }

    protected function validateRequest($request, $supervisor)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|unique:supervisors,name,'.$supervisor->id.',id',
            'department_id' => 'required|exists:departments,id'
        ]);
    }
}
