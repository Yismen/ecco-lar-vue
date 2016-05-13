<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewsComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeApp();
        $this->composeWelcome();
        // $this->composeUser();
        // $this->composeCommentsForm();
        // $this->composeSiteNotes();
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
     * Compose layouts app view
     * @return boolean Auth status
     */
    public function composeApp()
    {
        return view()->composer([
            'layouts.app',
            // 'layouts.partials.navbar-top',
            // 'layouts.partials.navbar-left'
        ], function($view){

            $user = \Auth::user();
            
            return $view->with([
                'logged' => auth()->check(),  
                'user' => $user,
                'menu' => null
            ]);
        });
    }

    public function composeWelcome()
    {
        return view()->composer(['welcome'], function($view) {
            return $view->with(['user'=>auth()->user()]);
        });
    }
}
