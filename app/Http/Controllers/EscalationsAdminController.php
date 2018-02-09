<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\EscalClient;
use App\EscalRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Escalations\Production;
use App\Repositories\Escalations\Productions\Users;
use App\Repositories\Escalations\Productions\Clients;
use App\Repositories\Escalations\Productions\Records;

class EscalationsAdminController extends Controller
{
    private $request;
    private $date;
    private $users;
    private $records;

    function __construct(Request $request, Records $records, Users $users, Clients $clients) {
        $this->request = $request;
        $this->date = $this->request->date;
        $this->records = $records;
        $this->users = $users;
        $this->clients = $clients;
    }

    public function index()
    {
         return view('escalations_admin.index-chartjs');
    }

    public function index_ajax()
    {
       $data = [
            'todayRecordsByUser' =>  $this->users->today()->get(),
            'todayRecordsByClient' => $this->clients->today()->get(),
            'lastFiveDates' => $this->records->lastManyDays(5)->get(),
            'this_week_by_day' => $this->records->thisWeek(),
            'this_week'     => $this->records->thisWeek(),
            'last_week'     => $this->records->lastWeek(),
            'this_month'     => $this->records->thisMonth(),
            'last_month'     => $this->records->lastMonth(),
            'last_ten_days' => $this->records->manyDaysAgo(10),
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

        $clients = $this->clients->byDate($this->request->date)->get();
        $users   =  $this->users->byDate($this->request->date)->get();
        $summary = $this->records->byDate($this->request->date)->get();
        if ($this->request->has('detailed')) {
           $detailed =  $this->records->detailedByDate($this->request)->get();
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

        $summary = $this->records->between(
            (new Carbon)->parse($this->request->from)->format("Y-m-d"),
            (new Carbon)->parse($this->request->to)->format("Y-m-d")
        );

        $detailed =  $this->records->detailedByRange($this->request)->get();

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

        $records = $this->records
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

        $records = $this->records->randBetween(
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

        $records = $this->bbbs->byDate($this->request->date)->get();
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

        $records = $this->bbbs->range(
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
