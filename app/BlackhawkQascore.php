<?php

namespace App;

use App\DainsysModel as Model;

class BlackhawkQascore extends Model
{
    protected $fillable = ['unique_id', 'client', 'queue', 'date', 'employee_id', 'name', 'status', 'qa_score', 'passing'];
}
