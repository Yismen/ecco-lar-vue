<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            if (!empty($value)) {
                $remove = [' ', '_', '-', '(', ')', '.', '+'];
                $digits = str_replace($remove, '', $value);
                if (!$parameter && is_numeric($parameter)) {
                    if (strlen($digits) == $parameter) {
                        return true;
                    }
                }
                if (strlen($digits) == 10 || strlen($digits) == 11) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Local providers here.
         */
        if ($this->app->environment() == 'local') {
            // $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
