<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\EscalClient;
use App\EscalRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Escalations\Production;

class EscalationsAdminController extends Controller
{
    private $date;
    private $production;

    function __construct(Request $request, Production $production) {
        $this->request = $request;
        $this->date = $this->request->date;
        $this->production = $production;
    }

    public function index()
    {
         return view('escalations_admin.index-chartjs');
    }

    public function index_ajax()
    {
       $data = [
            'todayRecordsByUser' => $this->production->users->today()->get(),
            'todayRecordsByClient' => $this->production->clients->today()->get(),
            'lastFiveDates' => $this->production->records->lastManyDays(5)->get(),
            'this_week'     => $this->production->records->thisWeek(),
            'last_week'     => $this->production->records->lastWeek(),
            'this_month'     => $this->production->records->thisMonth(),
            'last_month'     => $this->production->records->lastMonth(),
            'last_ten_days' => $this->production->records->manyDaysAgo(10),
        ];

        if ($this->request->ajax()) {
            return $data;
        }
    }

    public function getByDate()
    {
        return view('escalations_admin.by_date');
    }

    public function getByRange()
    {
        return view('escalations_admin.by_date');
    }

    public function postByDate()
    {     
        $this->validate($this->request, [
            'date'=>'required|date'
        ]);

        $clients = $this->production->clients->byDate($this->request->date)->get();
        $users   =  $this->production->users->byDate($this->request->date)->get();
        $summary = $this->production->records->byDate($this->request->date)->get();
        if ($this->request->has('detailed')) {
           $detailed =  $this->production->records->detailedByDate($this->request)->get();
        }

        $this->request->flash();

        return view('escalations_admin.by_date', compact('clients', 'users', 'detailed', 'summary'));

    }

    public function postByRange()
    {     
        $this->validate($this->request, [
            'from'=>'required|date',
            'to'=>'required|date'
        ]);

        $summary = $this->production->records->between(
            (new Carbon)->parse($this->request->from)->format("Y-m-d"),
            (new Carbon)->parse($this->request->to)->format("Y-m-d")
        );

        $detailed =  $this->production->records->detailedByRange($this->request)->get();

        $this->request->flash();

        return view('escalations_admin.by_date', compact('detailed', 'summary'));

    }

    public function search()
    {
        return view('escalations_admin.search');
    }

    public function handleSearch()
    {
        $this->request->replace([
            'tracking' => trim($this->request->tracking),
            'page' => trim($this->request->page),
        ]);

        $this->validate($this->request, [
            'tracking' => 'required|digits_between:3,9'
        ]);

        $records = $this->production->records
            ->search($this->request->tracking)
            ->get();

        $this->request->flash();

        return view('escalations_admin.search', compact('records'));
    }

    public function random()
    {
        $users = User::has('escalationsRecords')
            ->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('escalations_admin.random', compact('users'));
    }

    public function handleRandom()
    {
        $users = User::has('escalationsRecords')->pluck('name', 'id');

        $this->validate($this->request, [
            'from' => 'required|date',
            'to' => 'required|date',
            'records' => 'required|int|min:1',
            'user_id' => 'required|exists:users,id',
        ]);

        $records = $this->production->records->randBetween(
            $this->request->records, $this->request->user_id, $this->request->from, $this->request->to
        )->get(); 

        $this->request->flash();

        return view('escalations_admin.random', compact('records', 'users'));
    }

    public function bbbs()
    {
        return view('escalations_admin.bbbs');
    }

    public function handleBBBs()
    {
        $this->validate($this->request, [
            'date'=>'required|date'
        ]);

        $records = $this->production->bbbs->byDate($this->request->date)->get();
        // $records = $this->fetchProductionsByBBB($escalRecords);

        if ($this->request->ajax()) {
            return $records;
        }

        $this->request->flash();

        return view('escalations_admin.bbbs', compact('records'));

    }

    public function handleBBBsRange()
    {
        $this->validate($this->request, [
            'from'=>'required|date',
            'to'=>'required|date'
        ]);

        $records = $this->production->bbbs->range(
            $this->request->from, $this->request->to
        )
        ->get();

        if ($this->request->ajax()) {
            return $records;
        }

        $this->request->flash();

        return view('escalations_admin.bbbs', compact('records'));

    }
}
