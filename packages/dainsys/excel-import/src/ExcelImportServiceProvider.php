<?php

namespace Dainsys;

use Illuminate\Support\ServiceProvider;

class ExcelImportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/views', 'excel-import');

         $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/excel-import'),
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
