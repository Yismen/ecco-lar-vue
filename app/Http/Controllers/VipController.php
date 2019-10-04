<?php

namespace App\Http\Controllers;

use App\Vip;
use Illuminate\Http\Request;

class VipController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-vips|edit-vips|create-vips', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-vips', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-vips', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-vips', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Vip $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vip $vip)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vip $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vip $vip)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vip                 $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vip $vip)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vip $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vip $vip)
    {
        $vip->delete();

        return redirect()->route('admin.vips.index')
            ->withDanger('Vip destroyed!');
    }
}
