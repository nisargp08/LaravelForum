<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //For two or more view you can pass it in array : ['threads.create','threads.edit']
        // '*' will pass it to all the views

        //Alternate Method
        \View::composer('*', function($view){
            $view->with('channels',\App\Channel::all());
        });
        //\view()->share('channels', \App\Channel::all());
    }
}
