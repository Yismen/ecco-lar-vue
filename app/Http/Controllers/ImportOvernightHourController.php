<?php

namespace App\Http\Controllers;

use App\Http\Requests\OvernightHour\ImportOvernightHourRequest;
use App\Imports\OvernightHoutImport;
use App\OvernightHour;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as MaatwebsiteExcel;

class ImportOvernightHourController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:import-overnight-hours', ['only' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\ImportOvernightHourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportOvernightHourRequest $request)
    {
        MaatwebsiteExcel::import(new OvernightHoutImport, $request->file('_file_'));

        return redirect()->route('admin.overnight_hours.index')
            ->withSuccess('File imported');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function show(OvernightHour $overnightHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function edit(OvernightHour $overnightHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OvernightHour $overnightHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(OvernightHour $overnightHour)
    {
        //
    }
}
