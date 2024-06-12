<?php

namespace App\Services\CurrencyExchange\Interfaces;

interface CurrencyExchangeDriverInterface
{
    /**
     * @param string $currency
     * @return float
     */
    public function getRate(string $currency): float;
}
