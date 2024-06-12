<?php

namespace App\Providers;

use App\Services\CurrencyExchange\Factories\CurrencyExchangeFactory;
use Illuminate\Support\ServiceProvider;

class CurrencyExchangeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('currency-exchange', new CurrencyExchangeFactory());
    }
}
