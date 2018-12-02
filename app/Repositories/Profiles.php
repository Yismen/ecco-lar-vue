<?php

namespace App\Repositories;

use App\Profile;
use Cache;

class Profiles
{
    private $profile;

    public static function all()
    {
        return Cache::rememberForever('profiles', function(){
            return Profile::
                with('user')
                ->whereHas('user', function ($query) {
                    return $query;
                })
                ->paginate(16);
        });
        
    }
}
