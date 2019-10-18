<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\PerformancesImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PerformanceImportController extends Controller
{
    protected $imported_files = [];

    /**
     * Protect the controller agaist unauthorized users.
     */
    public function __construct()
    {
        $this->middleware('authorize:view-performances-import', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-performances-import', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-performances-import', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-performances-import', ['only' => ['destroy', 'confirmDestroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('performances_import.index');
        }

        return DataTables::of(
            Performance::orderBy('date', 'DESC')
                ->with(['campaign.project'])
                ->groupBy(['date', 'file_name'])
        )
            ->toJson(true);


        $performances = Performance::orderBy('date', 'DESC')
            ->orderBy('file_name')
            ->groupBy(['date', 'file_name'])
            ->paginate(25);

        return view('performances_import.index', compact('performances'));
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
        $this->validate($request, [
            'excel_file' => 'required',
            'excel_file.*' => 'file|mimes:xls,xlsx',
        ]);

        return $this->importPerformance($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Performance $performance
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance, $perf_date)
    {
        if (!request()->ajax()) {
            return view('performances_import.show')->with(['date' => $perf_date]);
        }

        $performances = Performance::where('date', $perf_date)
            ->with('campaign.project')
            ->with('supervisor')
            ->with('employee.supervisor');

        return DataTables::of($performances)
            ->addColumn('edit', function ($query) {
                return route('admin.performances.edit', $query->id);
            })
            ->toJson(true);
    }

    public function confirmDestroy()
    {
        $date = request('date');
        $file_name = request('file_name');

        return view('performances_import.confirm-destroy', compact('date', 'file_name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Performance $performance
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $performances = Performance::where('date', request('date'));

        $performances = request('file_name') && request('file_name') !== 'null' ?
            $performances->where('file_name', request('file_name')) : $performances->whereNull('file_name');

        $performances = $performances->get();

        foreach ($performances as $performance) {
            $performance->delete();
        }

        return ['status' => 'sucess', 'message' => 'Performances Deleted', 'data' => $performances];
    }

    private function importPerformance(Request $request)
    {
        ini_set('memory_limit', config('dainsys.memory_limit'));
        ini_set('max_execution_time', 300);

        foreach ($request->file('excel_file') as $key => $file) {
            $file_name = $file->getClientOriginalName();

            if (!Str::contains($file_name, '_performance_daily_data_')) {
                return redirect()->back()
                    ->withErrors(['excel_file' => 'Wrong file selected. Please make sure you pick a file which the correct naming convention _performance_daily_data_...']);
            }

            $this->imported_files[] = $file_name;

            Excel::import(new PerformancesImport($file_name), $request->file('excel_file')[$key]);
        }

        $request->session()->flash('imported_files', $this->imported_files);
        $request->session()->flash('success', 'Data Imported');

        if ($request->ajax()) {
            return ['message' => 'Data Imported', 'success' => 'Data Imported', 'files' => $this->imported_files];
        }

        return redirect()->route('admin.performances.index')
            ->withSuccess('Data Imported!');
    }
}
