<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LayoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    
    protected $site = 'site';
    protected $app = 'app';

    public function boot()
    {
        $this->site();
        $this->app();
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

    /**
     * returns current value of site property. Allows for override optionally.
     * @param  string $site new name of the site's layout. can be null o be overridden.
     * @return string       site's name
     */
    public function site($site = null)
    {
        if ($site) {
            $this->site = $site;
        }

        return $this->site;
    }

    /**
     * returns current value of app property. Allows for override optionally.
     * @param  string $app new name of the app's layout. can be null o be overridden.
     * @return string       app's name
     */
    public function app($app = null)
    {
        if ($app) {
            $this->app = $app;
        }

        return $this->app;
    }
}
