<?php

namespace Dainsys\Tasks;

use Illuminate\Support\ServiceProvider;

class TasksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/views', 'dainsys');

         $this->publishes([
            __DIR__.'/views' => resource_path('views/dainsys/tasks'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
