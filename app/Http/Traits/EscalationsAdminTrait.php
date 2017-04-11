<?php

namespace App\Http\Traits;

use App\User;
use Carbon\Carbon;
use App\EscalClient;
use App\EscalRecord;
use Illuminate\Support\Facades\DB;

trait EscalationsAdminTrait
{
    private  $date = null;

    private function fetchClientsProductionByDate($escalClient)
    {
        $date = $this->date;

        return $escalClient->select(['name', 'id'])        
            ->whereHas('escal_records', function($query) use ($date){
                $query->whereDate('created_at', '=', $date)->with('user');
            })
            ->withCount(['escal_records' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
            }])
            ->get();
    }

    private function fetchUsersProductionByDate($user)
    {
        $date = $this->date;

        return $user->select(['name', 'id'])
            ->whereHas('escalationsRecords', function($query) use ($date){
                $query->whereDate('created_at', '=', $date);
            })
            ->withCount(['escalationsRecords' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
            }])
            ->get();
    }

    private function fetchDetailedProductionByDate($escalRecords)
    {
        return $escalRecords
            ->with('user')
            ->with('escal_client')
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $this->date)
            ->get();
        
    }

    private function fetchRandomRecordsByRange($escalRecords, $amount, $user_id, $from, $to)
    {
        return $escalRecords
            ->whereUserId($user_id)
            ->whereBetween('insert_date', [$from, $to])
            ->inRandomOrder()
            ->take($amount)
            ->with('user')
            ->get();
        
    }

    private function fetchProductionsByDate($escalRecords, $escalClient, $user)
    {
        $date = $this->date;

        return $escalRecords->select(DB::raw("user_id, escal_client_id, count(tracking) as records"))
            ->groupBy(['user_id', 'escal_client_id'])
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $date)
            ->with('user')
            ->with('escal_client')
            ->get();
    }

    private function fetchProductionsByBBB($escalRecords)
    {
        $date = $this->date;

        return $escalRecords->whereDate('created_at', '=', $date)
            ->where('is_bbb', true)
            ->with(['user' => function($query) {
                return $query->orderBy('name');
            }])
            ->orderBy('escal_client_id')
            ->get();
    }

    private function fetchTodaysBBBRecords()
    {
        $date = Carbon::now();

        return EscalRecord::whereDate('created_at', '=', $date->today())
            ->where('is_bbb', true)
            ->with(['user' => function($query) {
                return $query->orderBy('name');
            }])
            ->with(['escal_client' => function($query) {
                return $query->orderBy('name');
            }])
            ->orderBy('escal_client_id')
            ->get();
    }

    private function fetchsBBBRecords($dates)
    {

        return EscalRecord::select(DB::raw("insert_date, count(tracking) as records"))
            ->groupBy(['insert_date'])
            ->where('is_bbb', true)
            ->orderBy('insert_date','DESC')
            ->take($dates)
            ->get();

        $date = Carbon::now();

        return EscalRecord::whereDate('created_at', '=', $date->today())
            ->where('is_bbb', true)
            ->with(['user' => function($query) {
                return $query->orderBy('name');
            }])
            ->with(['escal_client' => function($query) {
                return $query->orderBy('name');
            }])
            ->orderBy('escal_client_id')
            ->get();
    }

    private function fetchRecordsEnteredToday()
    {
        $dt = Carbon::now();
        return User::select(['name', 'id'])
            ->whereHas('escalationsRecords', function($query) use ($dt){
                $query->whereDate('created_at', '=', $dt->today()->format('Y-m-d'));
            })
            ->withCount(['escalationsRecords' => function($query) use ($dt) {
                $query->whereDate('created_at', '=', $dt->today()->format('Y-m-d'));
            }])
            ->get();
    }

    private function lastFiveDatesByUser()
    {        
        return EscalRecord::select(DB::raw("insert_date, user_id, count(tracking) as records"))
            ->groupBy(['insert_date', 'user_id'])
            ->with('user')
            ->orderBy('insert_date','DESC')
            ->take(5)
            ->get();
    }

    private function fetchTodaysRecordsByClient()
    {
        $dt = Carbon::now();
        return EscalClient::select(['name', 'id'])
            ->whereHas('escal_records', function($query) use ($dt){
                $query->whereDate('created_at', '=', $dt->today()->format('Y-m-d'));
            })
            ->withCount(['escal_records' => function($query) use ($dt) {
                $query->whereDate('created_at', '=', $dt->today()->format('Y-m-d'));
            }])
            ->get();
    }

    private function fetchLastFiveDatesProduction()
    {
        return EscalRecord::select(DB::raw("insert_date, count(tracking) as records, count(CASE WHEN is_bbb = 1 THEN 1 ELSE NULL end) as bbbRecords"))
            ->groupBy(['insert_date'])
            ->orderBy('insert_date','DESC')
            ->take(5)
            ->get();
    }

}