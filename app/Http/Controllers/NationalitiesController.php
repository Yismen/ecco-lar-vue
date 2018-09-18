<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;

class NationalitiesController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Nationality::orderBy('name', 'ASC')
            ->with('employees')
            ->paginate(50);

        return view('nationalities.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nationalities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Nationality $nationality)
    {
        $this->validateRequest($request, $nationality);

        $nationality = $nationality->create($request->all());

        return redirect()->route('admin.nationalities.index')
            ->withSuccess("Nationality {$nationality->name} created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nationality $nationality)
    {
        return view('nationalities.show', compact('nationality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
        return view('nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nationality $nationality)
    {
        $this->validateRequest($request, $nationality);

        $nationality->update($request->all());

        return redirect()->route('admin.nationalities.index')
            ->withWarning("Record {$nationality->name} updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        return redirect()->route('admin.nationalities.index')
            ->withDanger('Deleting a nationality is not allowed at this moment. You can re-use them by changing the name. If you still requires to delete a Nationality consult with the administrator!');
    }

    protected function validateRequest(Request $request, Nationality $nationality)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:nationalities,name,' . $nationality->id
        ]);
    }
}
