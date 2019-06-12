<?php

namespace App\Repositories;

use App\Profile;
use Cache;

class Profiles
{
    private $profile;

    public static function all()
    {
        $user = auth()->user();

        return Cache::rememberForever('profiles', function () use ($user) {
            return Profile::
                with('user')
                ->whereHas('user', function ($query) {
                    return $query;
                })
                ->where('user_id', '<>', $user->id)
                ->paginate(18);
        });
    }
}
