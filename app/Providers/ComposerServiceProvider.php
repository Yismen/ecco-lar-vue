<?php

namespace App\Providers;

use App\Http\ViewComposers\AppComposer;
use App\Http\ViewComposers\DgtComposer;
use App\Http\ViewComposers\LatestPunchComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['layouts.app', 'app', 'welcome'], AppComposer::class);
        view()->composer(['human_resources.reports.dgt3', 'human_resources.reports.dgt4'], DgtComposer::class);
        view()->composer(['punches._last_punch_id'], LatestPunchComposer::class);
    }

    public function register()
    {
    }
}
