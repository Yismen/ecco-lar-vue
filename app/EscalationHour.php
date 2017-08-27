<?php

namespace App;

use App\User;
use Carbon\Carbon;
use App\EscalClient;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class EscalationHour extends Model
{

    protected $dates = ['date'];
    protected $fillable = ['date', 'user_id', 'client_id', 'entrance', 'out', 'break'];

    protected $appends = ['production_hours'];

    // protected $

    protected $table = 'escalation_hours';

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function getUsersAttribute()
    {
        return User::lists('name', 'id');
    }

    public function client()
    {
        return $this->belongsTo(EscalClient::class);
    }

    public function getClientsAttribute()
    {
        return EscalClient::lists('name', 'id');
    }

    public function getProductionHoursAttribute()
    { 
        $dtEntrance = Carbon::parse($this->entrance);
        $dtOut = Carbon::parse($this->out);

        return ($dtOut->diffInMinutes($dtEntrance) - $this->break) / 60;
        return ($dtOut->diffInSeconds($dtEntrance) - $this->break) / 60 / 60;
    }

    public function recordsCount($user_id, $client_id, $date)
    {
        $date = (new Carbon($date))->format("Y-m-d");

        // dd($user_id, $client_id, $date);
        return EscalRecord::
            where('user_id', $user_id)
            ->whereDate('insert_date', '=', date($date))
            ->where('escal_client_id', $client_id)
            ->count();
    }

    public function tp()
    {
        return $this->records()/$this->hours();
    }


}
