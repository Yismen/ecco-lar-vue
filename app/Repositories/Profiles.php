<?php

namespace App\Repositories;

use App\Profile;

class Profiles
{
    private $profile;

    private $profiles;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
    public function all()
    {
        return $this->profiles = $this->profile
                    // ->where('id', '!=', $profile->id)
                    ->with('user')
                    ->whereHas('user', function($query) {
                        return $query;
                    })
                    ->paginate(16);
    }
}