<?php

namespace App\Http\Traits\Relationships;

use App\Task;
use App\Message;
use App\Profile;
use App\Setting;
use App\Password;
use App\EscalRecord;

trait UserRelationships
{
     public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }

    public function escalationsRecords()
    {
        return $this->hasMany(EscalRecord::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function app_setting()
    {
        return $this->hasOne('App\AppSetting');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}