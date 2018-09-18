<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Downtime;

class DowntimesController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('authorize:view_downtimes|edit_downtimes|create_downtimes', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_downtimes', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_downtimes', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_downtimes', ['only' => ['destroy']]);

        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Downtime $downtimes, $scope = null, $args = null)
    {
        return view('downtimes.index');
        // dd($scope);
        // if ($scope) {
        // 	$downtimes = $downtimes->$scope($args);
        // }

        // $downtimes = $downtimes
        // 	->with('employee')
        // 	->with('reason')
        // 	->get();

        // return view('downtimes.index', compact('downtimes'));
    }

    /**
     * apply filter to the query based on the value of the date field
     * [today, yesterday, 2 days ago, this many days ago, this week, last week, this many weeks ago,
     * this month, last month, this many months ago, this year, last year, this many years ago]
     *
     * [today, this week, this month, this year]
     * [many days ago, many weeks ago, many months ago, many years ago]
     * @return Query [description]
     */
    public function filterDowntime()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Downtime $downtime)
    {
        return view('downtimes.create', compact('downtime'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Downtime $downtime, Request $requests)
    {
        $downtime->create($requests->all());

        return redirect()->route('admin.downtimes.index')
            ->withSuccess("Added downtime for user employee $downtime->employee_id ...");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Downtime $downtime)
    {
        return view('downtimes.show', compact('downtime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Downtime $downtime)
    {
        return view('downtimes.edit', compact('downtime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Downtime $downtime, Request $requests)
    {
        $this->request->reason_id = str_random(10);

        $downtime->update($requests->all());

        return redirect()->route('admin.downtimes.index')
            ->withSuccess("Added downtime for user employee $downtime->employee_id has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Downtime $downtime)
    {
        $downtime->delete();

        return redirect()->route('admin.downtimes.index')
            ->withWarning("Data for record $downtime->id has been removed...");
    }

    public function searchScope(Downtime $downtime, Request $request)
    {
        return $this->index($downtime, 'searchScope', $request->input('search_date'));
    }

    public function searchByValue(Downtime $downtime, Request $request)
    {
        return $request->all();
    }

    public function importByDate(Downtime $downtime)
    {
        $downtimes = $downtime
            ->with('employee')
            ->orderBy('name', 'ASC')
            ->where('insert_date', $this->request->input('insert_date'))
            ->get();

        if ($this->request->ajax()) {
            return view('downtimes._results', compact('downtimes'));
            return view('downtimes._results-table', compact('downtimes'));
        }
        // Check if there is data for this date. Ask whether to import or not.
        // Import actives based on the import date, where Production == null.
        // Fill the table
        // add edit link
        // Filld edit form
        // Save.
        return view('downtimes.index', compact('downtimes'))->withInputs('old');
    }
}
