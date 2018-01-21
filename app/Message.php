<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'recipient_id', 'title', 'body', 'read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserListAttribute()
    {
        return User::orderBy('name')->lists('name', 'id');
    }
}
