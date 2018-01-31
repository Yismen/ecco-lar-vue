<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EscalRecord extends Model
{
    protected $fillable = ['tracking', 'escal_client_id', 'is_bbb', 'insert_date'];

    protected $dates = ['insert_date'];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $with = ['escal_client'];
    // protected $appends = ['client'];

    /**
     * ==========================================
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo('App\User')
            ->select(['name', 'id']);
    }

    public function hours()
    {
        return $this
            ->belongsTo('App\EscalationHour', 'escal_client_id', 'client_id')
            ->leftJoin('escal_records', function ($join) {
                $join->on('escal_records.user_id', '=', 'escalation_hours.user_id')
                    ->on('escal_records.insert_date', '=', 'escalation_hours.date');
            });
    }

    public function escal_client()
    {
        return $this->belongsTo('App\EscalClient');
    }

    /**
     * Create attribute client
     *
     * @return void
     */
    public function getClientAttribute()
    {
        return $this->escal_client;
    }

    /**
     * ========================================
     * Methods
     */
    public function createForUser($request)
    {
    }

    public function productionHours($entrance, $out, $break)
    {
        $dtEntrance = Carbon::parse($entrance);
        $dtOut = Carbon::parse($out);

        return ($dtEntrance->diffInMinutes($dtOut, false) - $break) / 60;
    }

    public function productivity($records, $hours)
    {
        if ($records == 0 || $hours == 0) {
            return 0;
        }

        return $records / $hours;
    }

    // public function tp()
    // {
    //     if ($this->hours->productionHours() == 0 || $this->records() == 0) {
    //         return 0;
    //     }
    //     return $this->records() / $this->hours->productionHours();
    // }

    /**
     * ==========================================
     * Scopes
     */

    /**
     * ======================================
     * Accessors
     */
    public function getEscalationsClientsAttribute()
    {
        return EscalClient::lists('name', 'id');
    }

    public function getEscalationsClientIdAttribute()
    {
        return $this->escal_client()->lists('id')->toArray();
    }

    /**
     * =======================================
     * Mutators
     */
}
