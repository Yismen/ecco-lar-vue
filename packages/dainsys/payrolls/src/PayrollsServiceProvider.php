<?php

namespace Dainsys\Payrolls;

use Illuminate\Support\ServiceProvider;

class PayrollsServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/views', 'payrolls_reports');

         $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/payrolls_reports'),
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
