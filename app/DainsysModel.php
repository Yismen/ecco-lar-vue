<?php

namespace App;

use App\Events\ModelUpdatedEvent;
use Illuminate\Database\Eloquent\Model;

class DainsysModel extends Model
{    
    protected $dispatchesEvents = [
        'saved' => ModelUpdatedEvent::class,
        'deleted' => ModelUpdatedEvent::class,
    ];
}
