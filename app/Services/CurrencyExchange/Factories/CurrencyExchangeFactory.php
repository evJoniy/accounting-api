<?php

namespace App\Services\CurrencyExchange\Factories;

use App\Services\CurrencyExchange\Interfaces\CurrencyExchangeDriverInterface;
use Illuminate\Support\Facades\Config;

class CurrencyExchangeFactory
{
    /**
     * @param string|null $driver
     * @return CurrencyExchangeDriverInterface
     * @throws \Exception
     */
    public function make(string $driver = null): CurrencyExchangeDriverInterface
    {
        $driver = $driver ?: Config::get('currency_exchange.default');
        $config = Config::get("currency_exchange.drivers.{$driver}");

        if (!$config || !class_exists($config['class'])) {
            throw new \Exception("Unsupported driver [{$driver}]");
        }

        if ($driver === 'average') {
            $dependencies = array_map(function ($dependency) {
                return $this->make($dependency);
            }, $config['dependencies']);

            return new $config['class']($dependencies);
        }

        return new $config['class'];
    }
}
