<?php

namespace App;

use App\DainsysModel as Model;

class BlackhawkQaErrors extends Model
{
    protected $fillable = ['unique_id', 'client', 'queue', 'date', 'employee_id', 'name', 'status', 'qa_score', 'passing', 'error_field', 'error_type'];
}
