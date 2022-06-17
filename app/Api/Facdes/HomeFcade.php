<?php

namespace App\Api\Facdes;

use Illuminate\Support\Facades\Facade;

class HomeFcade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'HomeFacade';
    }
}
