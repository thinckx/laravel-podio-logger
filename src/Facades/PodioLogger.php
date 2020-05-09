<?php

namespace ThomasInckx\PodioLogger\Facades;

use Illuminate\Support\Facades\Facade;

class PodioLogger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'podio-logger';
    }
}