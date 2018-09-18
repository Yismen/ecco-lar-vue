<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EscalRecord extends Model
{
    protected $fillable = ['tracking', 'escal_client_id', 'is_bbb', 'insert_date', 'is_additional_line'];

    protected $dates = ['insert_date'];

    protected $casts = [
        'is_bbb' => 'boolean',
        'is_additional_line' => 'boolean'
    ];

    /**
     * records belong to user
     *
     * @return User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class)
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

    /**
     * EscalClient Relationship
     *
     * @return EscalClient Relationship
     */
    public function escal_client()
    {
        return $this->belongsTo(EscalClient::class);
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

    public function setIsAdditionalLineAttribute($value)
    {
        $this->attributes['is_additional_line'] = $value == null ? 0 : 1;
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
        return EscalClient::pluck('name', 'id');
    }

    public function getEscalationsClientIdAttribute()
    {
        return $this->escal_client()->pluck('id')->toArray();
    }

    public static function filterForHours($user, $client, $date)
    {
        return static::whereDate('insert_date', '=', $date)
            ->where('user_id', $user)
            ->where('escal_client_id', $client)
            ->with('hours', 'user', 'escal_client')
            // ->groupBy(['user_id', 'escal_client_id', 'is_bbb'])
            ->select(DB::raw('*, count(tracking) as count'))
            ->first();
    }

    /**
     * =======================================
     * Mutators
     */
}
