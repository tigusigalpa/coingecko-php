<?php

namespace Tigusigalpa\Coingecko\Facades;

use Illuminate\Support\Facades\Facade;

class Coingecko extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'coingecko';
    }
}
