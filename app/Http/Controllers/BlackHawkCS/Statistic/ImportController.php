<?php

namespace App\Http\Controllers\BlackHawkCS\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\BlackhawkQascore;
use App\BlackhawkQaErrors;
use App\BlackhawkLobSummary;
use App\BlackhawkPerformanceSummary;
use App\Repositories\BlackHawk_CS\Statistic;

class ImportController extends Controller
{
    protected $excel;
    protected $request;
    protected $errors;

    public function __construct(Excel $excel, Request $request)
    {
        $this->middleware('authorize:import-blackhawk-cs-data');
        
        $this->excel = $excel;
        $this->request = $request;
    }

    public function index(Statistic $statistic)
    {
        return view('blackhawk-cs.imports.index', compact('statistic'));
    }

    public function qa(Request $request)
    {
        $this->validate($request, [
            'qa_files' => 'required',
            'qa_files.*' => 'file|mimes:xls,xlsx,csv'
        ]);

        $data = $this->handleImport($request->file('qa_files'), new BlackhawkQascore, 'qa_summary');

        return redirect('/admin/blackhawk-cs/import')
            ->withData($data)
            ->withErrors($this->errors);
    }

    public function qaErrors(Request $request)
    {
        $this->validate($request, [
            'qa_errors_files' => 'required',
            'qa_errors_files.*' => 'file|mimes:xls,xlsx,csv'
        ]);

        $data = $this->handleImport($request->file('qa_errors_files'), new BlackhawkQaErrors, 'qa_errors');

        return redirect('/admin/blackhawk-cs/import')
            ->withData($data)
            ->withErrors($this->errors);
    }

    public function lob()
    {
        $this->validate($this->request, [
            'lob_files' => 'required',
            'lob_files.*' => 'file|mimes:xls,xlsx,csv'
        ]);

        $data = $this->handleImport($this->request->file('lob_files'), new BlackhawkLobSummary, 'LOB_summary');

        return redirect('/admin/blackhawk-cs/import')
            ->withData($data)
            ->withErrors($this->errors);
    }

    public function performance()
    {
        $this->validate($this->request, [
            'performance_files' => 'required',
            'performance_files.*' => 'file|mimes:xls,xlsx,csv'
        ]);
        $data = $this->handleImport($this->request->file('performance_files'), new BlackhawkPerformanceSummary, 'performance_summary');

        return redirect('/admin/blackhawk-cs/import')
            ->withData($data)
            ->withErrors($this->errors);
    }

    private function handleImport($file_array, $model, $file_name_should_starts_with)
    {
        $object = [];
        foreach ($file_array as $file) {
            $file_name = $file->getClientOriginalName();

            if (starts_with($file_name, $file_name_should_starts_with)) {
                $object = $this->excel->load($file)->toObject();
                foreach ($object as $data) {
                    $exists = $model->where('unique_id', '=', $data->unique_id)->first();
                    if ($exists) {
                        $exists->delete();
                    }
                    $model->create($data->toArray());
                }
            } else {
                $this->errors[] = 'File ' . $file_name . ' was not imported. It should start with ' . $file_name_should_starts_with;
            }
        }

        return $object;
    }
}
