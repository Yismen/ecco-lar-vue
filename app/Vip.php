<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $dates = ['since'];

    protected $fillable = ['employee_id', 'since'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
