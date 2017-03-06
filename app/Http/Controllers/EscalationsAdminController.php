<?php

namespace App\Http\Controllers;

use App\User;
use App\EscalClient;
use App\EscalRecord;
use App\Http\Requests;
use Illuminate\Http\Request;

class EscalationsAdminController extends Controller
{
    public function index()
    {
        return view('escalations_admin.index');
    }

    public function getByDate()
    {
        return view('escalations_admin.by_date');
    }

    public function postByDate(Request $request)
    {     
        $this->validate($request, [
            'date'=>'required|date'
        ]);

        $date = $request->date;

        $clients = EscalClient::select(['name', 'id'])        
            ->whereHas('escal_records', function($query) use ($date){
                $query->whereDate('created_at', '=', $date);
            })
            ->withCount(['escal_records' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
            }])
            ->get();

        // return $clients;

        $users = User::select(['name', 'id'])
            ->whereHas('escalationsRecords', function($query) use ($date){
                $query->whereDate('created_at', '=', $date);
            })
            ->withCount(['escalationsRecords' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
            }])
            ->get();

        if ($request->ajax()) {
            return $clients;
        }

        $request->flash();

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
        // user, contextual date, amount to get
        return view('escalations_admin.random');
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
}
