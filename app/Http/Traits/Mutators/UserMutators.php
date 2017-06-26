<?php

namespace App\Http\Traits\Mutators;

trait UserMutators
{
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords($name);
    }

    public function setUsernameAttribute($username)
    {
        return $this->attributes['username'] = str_slug($username);
    }
}