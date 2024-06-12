<?php

namespace App\Services;

use App\Facades\CurrencyExchange;

class CurrencyConversionService
{
    /**
     * @param float $amount
     * @param string $currency
     * @return float
     */
    public function convert(float $amount, string $currency): float
    {
        $rate = CurrencyExchange::make()->getRate($currency);
        return $amount * $rate;
    }
}
