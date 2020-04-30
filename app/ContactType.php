<?php

namespace App;

use App\DainsysModel as Model;

class ContactType extends Model
{
    protected $fillable = ['contact_type', 'description'];

    public function sitemessages()
    {
        return $this->hasMany('App\SiteMessage', 'id');
    }
}
