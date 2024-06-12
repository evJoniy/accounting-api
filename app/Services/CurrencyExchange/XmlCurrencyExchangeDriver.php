<?php

namespace App\Services\CurrencyExchange;

use App\Services\CurrencyExchange\Interfaces\CurrencyExchangeDriverInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class XmlCurrencyExchangeDriver implements CurrencyExchangeDriverInterface
{
    /** @inheritdoc */
    public function getRate(string $currency): float
    {
        return Cache::remember("currency-rate-xml-{$currency}", 300, function () use ($currency) {
            $content = Storage::get('currency-rates.xml');
            $xml = simplexml_load_string($content);
            return (float) $xml->xpath("//rate[@currency='{$currency}']")[0];
        });
    }
}
