<?php

namespace App\Repositories\Escalations\Productions;

use App\EscalClient;
use Carbon\Carbon;

class Clients
{
    private $client;

    public function __construct(EscalClient $client)
    {
        $this->client = $client;
    }

    public function byDate($date)
    {
        return $this->client
            ->select(['name', 'id'])        
            ->whereHas('escal_records', function($query) use ($date){
                $query->whereDate('created_at', '=', $date)->with('user');
            })
            ->withCount(['escal_records' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
            }]);
    }

    public function today()
    {
        return $this->byDate(Carbon::today());
    }


    
}