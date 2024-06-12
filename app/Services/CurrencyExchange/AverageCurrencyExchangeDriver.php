<?php

namespace App\Services\CurrencyExchange;

use App\Services\CurrencyExchange\Interfaces\CurrencyExchangeDriverInterface;

class AverageCurrencyExchangeDriver implements CurrencyExchangeDriverInterface
{
    public function __construct(
        protected array $drivers
    ) {
    }

    /** @inheritdoc */
    public function getRate(string $currency): float
    {
        $total = 0;
        $count = 0;

        foreach ($this->drivers as $driver) {
            $total += $driver->getRate($currency);
            $count++;
        }

        return $total / $count;
    }
}
