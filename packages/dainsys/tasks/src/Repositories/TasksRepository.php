<?php

namespace Dainsys\Tasks\Repositories;

use Dainsys\Tasks\Task;

class TasksRepository
{
    private $task;

    public function __construct()
    {
        $this->task = new Task;
    }

    public function all()
    {
        return new Task;
        return Task::all();
    }
}