<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorUser extends Model
{
    protected $table = 'supervisor_user';

    public function syncRelationship(array $data)  
    {
        foreach ((array) $data['user_ids'] as $user) {
            User::find($user)
                ->supervisors()
                ->attach((array) $data['supervisor_ids']);
        }
        
        return $this;
        
    }
}
