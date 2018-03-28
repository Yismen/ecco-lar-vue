<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackhawkQascore extends Model
{
    protected $fillable = ['unique_id', 'client', 'queue', 'date', 'employee_id', 'name', 'status', 'qa_score', 'passing'];
}
