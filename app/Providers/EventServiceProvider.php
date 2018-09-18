<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\EmployeeDeactivated' => [
            'App\Listeners\SemdEmailToHumanResources',
        ],
        'App\Events\EmployeeCreated' => [
            'App\Listeners\SemdEmailToHumanResources',
        ],
        'App\Events\MessageCreaed' => [
            'App\Listeners\NotifyUserOfANewMessage'
        ],
        'App\Events\CreateUserSettings' => [
            'App\Listeners\StoreUserSettings'
        ],
        'App\Events\EditUserSettings' => [
            'App\Listeners\UpdateUserSettings'
        ],
        'App\Events\EmployeesUpdates' => [
            'App\Listeners\NotifyEmployeesTerminated',
            'App\Listeners\NotifyEmployeesHired',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
