<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RevenueType;

// use Illuminate\Http\Request;

class RevenueTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-revenue_types|edit-revenue_types|create-revenue_types', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-revenue_types', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-revenue_types', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-revenue_types', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RevenueType $revenue_types)
    {
        $revenue_types = $revenue_types->paginate(10);

        return view('revenue_types.index', compact('revenue_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('revenue_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RevenueType $revenue_type, Request $request)
    {
        $this->validate($request, [
            'name' => "required|min:3|unique:revenue_types",
        ]);

        $revenue_type = $revenue_type->create(
            $request->only(['name'])
        );

        return redirect()->route('admin.revenue_types.show', $revenue_type->id)
            ->withSuccess("RevenueType [$revenue_type->name] has been Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(RevenueType $revenue_type)
    {
        return view('revenue_types.show', compact('revenue_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(RevenueType $revenue_type)
    {
        return view('revenue_types.edit', compact('revenue_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(RevenueType $revenue_type, Request $request)
    {
        $this->validateRequest($request, $revenue_type);

        $revenue_type->update($request->only([
            'name', 'display_name', 'description', 'url'
        ]));

        return redirect()->route('admin.revenue_types.show', $revenue_type->id)
            ->withSuccess("Information for revenue_type [$revenue_type->name] has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(RevenueType $revenue_type)
    {
        $revenue_type->delete();

        return redirect()->route('admin.revenue_types.index')
            ->withDanger("Information for revenue_type [$revenue_type->name] has been deleted");
    }
}
