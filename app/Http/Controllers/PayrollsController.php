<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Traits\PayrollsTrait;
use Maatwebsite\Excel\Facades\Excel;

class PayrollsController extends Controller
{
    use PayrollsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        return "All reports from here...";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function close()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
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

    public function importDataFromExcel()
    {

        return view('payrolls._import_form');
    }

    public function postImportDataFromExcel(Request $request)
    {
        // validate:required|excel file, dates are provided
        // Construct a payroll id
        // upload the data
        return dd($request->file('files'));
        return $request->file('files');

    }
}
