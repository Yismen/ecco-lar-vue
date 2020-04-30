<?php

namespace App;

use App\DainsysModel as Model;

class BlackhawkPerformanceSummary extends Model
{
    protected $fillable = ['unique_id',  'date', 'employee_id', 'name', 'time_logged_in', 'time_online', 'chat_sessions', 'time_in_chats', 'max_chat_session_time', 'chat_wrap_up_time', 'email_sessions', 'time_in_emails', 'max_email_session_time'];
}
