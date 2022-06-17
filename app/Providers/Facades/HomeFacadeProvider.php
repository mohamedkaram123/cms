<?php

namespace App\Providers\Facades;

use App\Api\Classes\Home;
use Illuminate\Support\ServiceProvider;

class HomeFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('HomeFacade', function () {
            return new Home;
        });
    }
}
