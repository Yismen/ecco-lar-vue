<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['id', 'reason'];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
