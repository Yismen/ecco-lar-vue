<?php

namespace App\Providers;

use App\Http\ViewComposers\AppComposer;
use App\Http\ViewComposers\DgtComposer;
use Illuminate\Support\ServiceProvider;

class ComposerserviceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['layouts.app', 'welcome'], AppComposer::class);
        view()->composer(['human_resources.reports.dgt3', 'human_resources.reports.dgt4'], DgtComposer::class);
    }

    public function register()
    {
        
    }
}