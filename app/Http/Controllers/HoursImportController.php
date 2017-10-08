<?php

namespace App\Http\Controllers;

use App\Hour;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Traits\HoursImportTrait;
use App\Repositories\ExcelFileLoader;

class HoursImportController extends Controller
{
    use HoursImportTrait;

    function __construct() {
        $this->middleware('authorize:manage-hours-import');
    }
    /**
     * Shows the dashboard to import hours
     * @return [type] [description]
     */
    public function index()
    {
        $dates = Hour::select(['date'])
            ->orderBy('date', 'DESC')->groupBy('date')->paginate(20);

        return view('hours-import.index')
            ->with(['dates' => $dates]);        
    }


    public function import(Request $request)
    {
        $this->validate($request, [
            'file_name.*' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        $loader = (new ExcelFileLoader([
            'employee_id' => 'required|exists:employees,id',
            'name' => 'required',

            'date' => 'required|date',
            'unique_id' => 'required',

            'regulars' => 'required|numeric|min:0',
            'nightly' => 'required|numeric|min:0',
            'holidays' => 'required|numeric|min:0',
            'training' => 'required|numeric|min:0',
            'overtime' => 'required|numeric|min:0',
        ]))
        ->load($request->file('file_name'));

        if ($loader->hasErrors()) {
            $request->session()->flash('file_errors', ['errors'=>$loader->errors()]); 
            return redirect('admin/hours-import')
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB($loader->data());

        return redirect('admin/hours-import')
            ->withSuccess('The data was imported!');
    }
}
