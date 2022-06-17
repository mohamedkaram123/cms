<?php

namespace App\Providers\Facades;

use App\Api\Classes\Auth;
use Illuminate\Support\ServiceProvider;

class AuthFacadeProvider extends ServiceProvider
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
        $this->app->bind('AuthFacade', function () {
            return new Auth;
        });
    }
}
