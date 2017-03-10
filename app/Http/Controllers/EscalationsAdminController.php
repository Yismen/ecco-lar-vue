<?php

namespace App\Http\Controllers;

use App\User;
use App\EscalClient;
use App\EscalRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Traits\EscalationsAdminTrait;

class EscalationsAdminController extends Controller
{
    use EscalationsAdminTrait;
    private $date;

    function __construct(Request $request) {
        $this->request = $request;
        $this->date = $this->request->date;
    }

    public function index()
    {
        return view('escalations_admin.index');
    }

    public function getByDate()
    {
        return view('escalations_admin.by_date');
    }

    public function postByDate(EscalClient $escalClient, User $user, EscalRecord $escalRecords)
    {     
        $this->validate($this->request, [
            'date'=>'required|date'
        ]);

        $clients     = $this->fetchClientsProductionByDate($escalClient);
        $users       =  $this->fetchUsersProductionByDate($user);
        // $productions =  $this->fetchProductionsByDate($escalRecords, $escalClient);

        if ($this->request->ajax()) {
            return $clients;
        }

        $this->request->flash();

        return view('escalations_admin.by_date', compact('clients', 'users'));

    }

    public function getSearch(Request $request)
    {
        if (!$request->tracking) {
            return view('escalations_admin.search', compact('records'));
        }

        $request->replace([
            'tracking' => trim($request->tracking),
            'page' => trim($request->page),
            // 'escalations_client_id' => $request->escalations_client_id,
        ]);

        $this->validate($request, [
            'tracking' => 'required|digits_between:3,9'
        ]);

        $tracking = $request->tracking;

        $records = EscalRecord::where('tracking', 'like', "%$tracking%")
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)->appends(['tracking'=>$tracking]);

        $request->flash();

        return view('escalations_admin.search', compact('records'));
    }

    public function random(Request $request)
    {
        if (!$request->tracking) {
            return view('escalations_admin.search', compact('records'));
        }

        $request->replace([
            'tracking' => trim($request->tracking),
            'page' => trim($request->page),
            // 'escalations_client_id' => $request->escalations_client_id,
        ]);

        $this->validate($request, [
            'tracking' => 'required|digits_between:3,9'
        ]);

        $tracking = $request->tracking;

        $records = EscalRecord::where('tracking', 'like', "%$tracking%")
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)->appends(['tracking'=>$tracking]);

        $request->flash();

        return view('escalations_admin.search', compact('records'));
    }



    public function bbbs(EscalRecord $escalRecords)
    { 

        if (!$this->request->date) {
            return view('escalations_admin.bbbs', compact('records'));
        }

        $this->validate($this->request, [
            'date'=>'required|date'
        ]);

        $records = $this->fetchProductionsByBBB($escalRecords);

        if ($this->request->ajax()) {
            return $records;
        }

        $this->request->flash();

        return view('escalations_admin.bbbs', compact('records'));

    }
}
