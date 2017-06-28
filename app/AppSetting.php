<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['skin', 'layout', 'mini', 'collapse'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
