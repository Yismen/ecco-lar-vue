<?php

namespace App;

use DateTime;
use App\User;
use Carbon\Carbon;
use App\EscalClient;
use Illuminate\Database\Eloquent\Model;

class EscalationHour extends Model
{
    protected $dates = ['date'];

    protected $fillable = ['date', 'user_id', 'client_id', 'entrance', 'out', 'break'];

    protected $table = 'escalation_hours';

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function getUsersAttribute()
    {
        return User::pluck('name', 'id');
    }

    public function getEntranceAttribute($time)
    {
        return Carbon::parse($time)->format("H:i");
    }

    public function getOutAttribute($time)
    {
        return Carbon::parse($time)->format("H:i");
    }

    public function client()
    {
        return $this->belongsTo(EscalClient::class);
    }

    public function getClientsAttribute()
    {
        return EscalClient::pluck('name', 'id');
    }

    public function getProductionHoursAttribute()
    { 
        $dtEntrance = Carbon::parse($this->entrance);
        $dtOut = Carbon::parse($this->out);

        return ($dtEntrance->diffInMinutes($dtOut) - $this->break) / 60;
    }

    public function productionHours()
    {
        return $this->production_hours;
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
        return $this->recordsCount() / $this->productionHours();
    }


}
