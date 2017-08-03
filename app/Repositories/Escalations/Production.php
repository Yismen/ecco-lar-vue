<?php

namespace App\Repositories\Escalations;

use App\Repositories\Escalations\Productions\Users;
use App\Repositories\Escalations\Productions\Records;
use App\Repositories\Escalations\Productions\Clients;
use App\Repositories\Escalations\Productions\Bbbs;

class Production
{
    public $users;
    public $clients;
    public $records;
    public $bbbs;

    public function __construct(Users $users, Clients $clients, Records $records, Bbbs $bbbs)
    {
        $this->users = $users;
        $this->clients = $clients;
        $this->records = $records;
        $this->bbbs = $bbbs;
    }
}