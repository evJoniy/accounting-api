<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyExchange extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'currency-exchange';
    }
}
