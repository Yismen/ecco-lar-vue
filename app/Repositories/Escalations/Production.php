<?php

namespace App\Repositories\Escalations;

use App\Repositories\Escalations\Productions\Bbbs;
use App\Repositories\Escalations\Productions\Hours;
use App\Repositories\Escalations\Productions\Users;
use App\Repositories\Escalations\Productions\Clients;
use App\Repositories\Escalations\Productions\Records;

class Production
{
    public $users;
    public $clients;
    public $records;
    public $bbbs;
    public $hours;

    public function __construct(Users $users, Clients $clients, Records $records, Bbbs $bbbs, Hours $hours)
    {
        $this->users = $users;
        $this->clients = $clients;
        $this->records = $records;
        $this->bbbs = $bbbs;
        $this->hours = $hours;
    }
}
