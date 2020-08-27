<?php

namespace App;

use App\DainsysModel as Model;

class Client extends Model
{
    protected $fillable = ['name', 'contact_name', 'main_phone', 'email', 'secondary_phone', 'account_number'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(trim($name));
    }

    public function setContactNameAttribute($contact_name)
    {
        $this->attributes['contact_name'] = ucwords(trim($contact_name));
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
