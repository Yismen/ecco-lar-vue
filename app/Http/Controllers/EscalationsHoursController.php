<?php

namespace App\Http\Controllers;

use App\User;
use App\EscalClient;
use App\Http\Requests;
use App\EscalationHour;
use Illuminate\Http\Request;
use App\Repositories\Escalations\Production;

class EscalationsHoursController extends Controller
{
    private $request;
    private $production;

    public function __construct(Request $request, Production $production)
    {
        $this->request = $request;
        $this->production = $production;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = $this->production->records->groupedByDate(true);

        return view('escalations_hours.index', [
            'dates' => $dates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, $client_id, $records)
    {
        $user = User::select('id', 'name')->findOrFail($user_id);
        $client = EscalClient::select('id', 'name')->findOrFail($client_id);

        return view('escalations_hours.create', compact('user', 'client', 'records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalationHour $hours)
    {
        $this->validate($this->request, [
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:escal_clients,id',
            'entrance' => 'required|date_format:H:i:s',
            'out' => 'required|date_format:H:i:s',
            'break' => 'required|integer',
        ]);
        return $this->request->all();
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
    public function edit(EscalationHour $hours)
    {
        $hours->records = $hours->recordsCount($hours->user_id, $hours->client_id, $hours->date);

        return view('escalations_hours.edit', compact('hours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $request->all();
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

    public function byDate()
    {
        $this->validate($this->request, [
            'date' => 'required|date|exists:escal_records,insert_date'
        ]);

        return $records = $this->production->records
            ->byDate($this->request->date)
            ->with('hour')
            // ->has('hour')
            ->get();


        return $pending_records = $this->production->records
            ->byDate($this->request->date)
            ->with('hour')
            ->doesntHave('hour')
            ->get();
    }

    public function search()
    {
        $this->validate($this->request, [
            'date' => 'required|date|exists:escal_records,insert_date'
        ]);

        $this->request->flash();

        return $records = $this->production->records
            ->byDate($this->request->date)
            ->with('hour')
            // ->has('hour')
            ->toSql();

        $pending_records = $this->production->records
            ->byDate($this->request->date)
            ->with('hour')
            ->doesntHave('hour')
            ->get();

        return view('escalations_hours.index', compact('hours', 'records', 'pending_records'));
    }

    public function add($user_id, $client_id)
    {
        $user = User::findOrFail($user_id);
        $client = EscalClient::findOrFail($client_id);
    }

    public function handleAdd()
    {
        return $this->request->all();
    }
}
