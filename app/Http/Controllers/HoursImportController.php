<?php

namespace App\Http\Controllers;

use App\Hour;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\ExcelFileLoader;

class HoursImportController extends Controller
{
    public function byDate($date)
    {
        return $date;
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

    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            $exists = Hour::where('unique_id', '=', $data['unique_id'])->first();

            if ($exists) {
                $exists->delete();
            }
            Hour::create($data);
        }
    }
}
