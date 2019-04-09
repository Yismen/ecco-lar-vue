<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\PerformancesImport;
use Maatwebsite\Excel\Facades\Excel;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin.performances.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dates = Performance::orderBy('date')
            ->groupBy(['date'])
            ->with('campaign')
            ->take(5)
            ->get();

        return view('performances.create', compact('dates'));
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
           'excel_file' => 'required',
           // 'excel_file.*' => 'file|mimes:xls,xlsx',
        ]);

        foreach($request->file('excel_file') as $key => $file) {

            if(! Str::startsWith($file->getClientOriginalName(), 'performance')) {
                return redirect()->back()
                    ->withErrors(['excel_file' => "Wrong file selected. Please make sure you pick a file which name starts with Performance..."]);
            }

            Excel::import(new PerformancesImport, $request->file('excel_file')[$key] );
        }

        return redirect()->route('admin.performances.create')
            ->withSuccess('Data Imported!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performance $performance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        //
    }
}
