<?php

namespace App\Repositories;

use App\Profile;

class Profiles
{
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
    public function all()
    {
        return $profiles = $this->profile
                    // ->where('id', '!=', $profile->id)
                    ->with('user')
                    ->paginate(16);
    }
}