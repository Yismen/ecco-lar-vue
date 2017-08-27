<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayrollsTempController extends Controller
{
    public function __construct() {
        $this->middleware('authorize:view_payrolss_temp|edit_payrolss_temp|create_payrolls_temp', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payrolls_temp', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payrolls_temp', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payrolls_temp', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payrolls_temp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payrolls_temp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'from_date'    => 'required|date',
        //     'to_date'      => 'required|date|after:from_date',
        //     // 'payroll_file' => 'required|mimes:xls,xlsx',
        //     // 'payroll_file' => 'required|mimetypes:CSV',
        //     'payroll_file' => 'required|file',
        // ]);
        $that = $this;
        foreach (Excel::load($request->file('payroll_file')) as $item) {
            // validate
            // Check if exists in the db
            // import
            $request->item = $item;
            // filter_var($ma, PHP_VALID);
            // $this->validate($request->item, [
            //     'supervisor' => 'required'
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
