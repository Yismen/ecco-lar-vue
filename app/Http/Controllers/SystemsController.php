<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\System;

// use Illuminate\Http\Request;

class SystemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_systems|edit_systems|create_systems', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_systems', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_systems', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_systems', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(System $systems)
    {
        $systems = $systems->paginate(10);

        return view('systems.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(System $system)
    {
        return view('systems.create', compact('system'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(System $system, Request $request)
    {
        $this->validateRequest($request, $system);

        $system = $system->create($request->only([
            'name', 'display_name', 'description', 'url'
        ]));

        return redirect()->route('admin.systems.show', $system->id)
            ->withSuccess("System [$system->name] has been Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(System $system)
    {
        return view('systems.show', compact('system'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(System $system)
    {
        return view('systems.edit', compact('system'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(System $system, Request $request)
    {
        $this->validateRequest($request, $system);

        $system->update($request->only([
            'name', 'display_name', 'description', 'url'
        ]));

        return redirect()->route('admin.systems.show', $system->id)
            ->withSuccess("Information for system [$system->name] has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(System $system)
    {
        $system->delete();

        return redirect()->route('admin.systems.index')
            ->withDanger("Information for system [$system->name] has been deleted");
    }

    private function validateRequest($request, $system)
    {
        return $this->validate($request, [
            'name' => "required|alpha_dash|unique:systems,name,$system->id,id",
            'display_name' => "required|unique:systems,display_name,$system->id,id",
            'url' => "url|unique:systems,url,$system->id,id",
        ]);
    }
}
