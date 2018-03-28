<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackhawkLobSummary extends Model
{
    protected $fillable = ['unique_id',  'date', 'queue', 'employee_id', 'name', 'lob', 'records', 'production_time'];
}
