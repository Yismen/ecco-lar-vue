<?php

namespace App\Http\Controllers\Api;

use App\Ars;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ARSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ars::orderBy('name')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ars  $ars
     * @return \Illuminate\Http\Response
     */
    public function show(Ars $ars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ars  $ars
     * @return \Illuminate\Http\Response
     */
    public function edit(Ars $ars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ars  $ars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ars $ars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ars  $ars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ars $ars)
    {
        //
    }
}
