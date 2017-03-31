<?php

namespace App\Http\Traits;

use App\User;
use App\EscalClient;
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

    public function fetchDetailedProductionByDate($escalRecords)
    {
        return $escalRecords
            ->with('user')
            ->with('escal_client')
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $this->date)
            ->get();
        
    }

    public function fetchRandomRecordsByRange($escalRecords, $amount, $user_id, $from, $to)
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

}