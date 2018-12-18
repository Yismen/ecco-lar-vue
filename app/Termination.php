<?php

namespace App;

use Carbon\Carbon;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    use Trackable;

    protected $fillable = ['employee_id', 'termination_date', 'termination_type_id', 'termination_reason_id', 'can_be_rehired', 'comments'];

    protected $dates = ['termination_date'];

    protected $casts = [
        'can_be_rehired' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function terminationType()
    {
        return $this->belongsTo('App\TerminationType');
    }

    public function terminationReason()
    {
        return $this->belongsTo('App\TerminationReason');
    }

    public function setTerminationDateAttribute($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        $this->attributes['termination_date'] = $date;
    }
}
