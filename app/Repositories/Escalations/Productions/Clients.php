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
            ->whereHas('escal_records', function ($query) use ($date) {
                $query->whereDate('insert_date', '=', $date)->whereIsAdditionalLine(0);
            })
            ->withCount(['escal_records' => function ($query) use ($date) {
                $query->whereDate('insert_date', '=', $date)->whereIsAdditionalLine(0);
            }]);
    }

    public function today()
    {
        $date = (new Carbon)->today()->format("Y-m-d");
        return $this->byDate($date);
    }
}
