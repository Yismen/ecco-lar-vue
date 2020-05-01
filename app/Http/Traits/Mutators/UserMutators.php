<?php

namespace App\Http\Traits\Mutators;

use Illuminate\Support\Str;

trait UserMutators
{
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords($name);
    }

    public function setUsernameAttribute($username)
    {
        return $this->attributes['username'] = Str::slug($username);
    }
}
