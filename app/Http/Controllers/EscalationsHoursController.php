<?php

namespace App\Http\Controllers;

use App\User;
use App\EscalClient;
use App\EscalationHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\EscalationsHoursRequest;
use App\Repositories\Escalations\Production;
use App\EscalRecord;

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
    public function index(EscalationHour $hour)
    {
        $hours = $hour->paginate(40);

        return view('escalations_hours.index', compact('hours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, $client_id, $date)
    {
        $exists = EscalationHour::whereUserId($user_id)->whereClientId($client_id)->whereDate('date', $date)->first();

        if ($exists) {
            return back()->withDanger("Hours exists already. Please chose Edit. Hint: Refresh the page.");
        }

        $record = EscalRecord::filterForHours($user_id, $client_id, $date);
        
        return view('escalations_hours.create', compact('record'));            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalationHour $hours, EscalationsHoursRequest $request)
    {
        $hours = $hours->create($request->all());

        return redirect()->route('admin.escalations_hours.edit', $hours->id)
            ->withSuccess('Hours created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EscalationHour $escalations_hour)
    {
        return $escalations_hour;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EscalationHour $hour)
    {        
        $hour->records = $hour->recordsCount($hour->user_id, $hour->client_id, $hour->date);

        return view('escalations_hours.edit', compact('hour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EscalationHour $hours, EscalationsHoursRequest $request)
    {
        $hours->update($request->all());

        return redirect()->route('admin.escalations_hours.edit', $hours->id)
            ->withWarning('Hours updated!');
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

    public function byDate(EscalationHour $hour)
    {
        $this->validate($this->request, [
            'date' => 'required|date|exists:escal_records,insert_date'
        ]);

        $hours = $hour
            ->whereDate('date', '=', $this->request->date)
            ->with('user')
            ->orderBy('user_id')
            ->orderBy('client_id')
            ->with('client')
            ->paginate(40);

        return view('escalations_hours._by_date', compact('hours'));
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
