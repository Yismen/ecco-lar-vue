<?php

namespace App;

class Notification extends DainsysModel
{
    protected $fillable = ['read_at'];
    
    public function markAsRead()
    {
        return $this->update([
            'read_at' => now()
        ]);
    }
}
