<?php

namespace App\Api\Facdes;

use Illuminate\Support\Facades\Facade;

class AuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AuthFacade';
    }
}
