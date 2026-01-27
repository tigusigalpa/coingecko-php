<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class ExchangeRatesApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function rates(): array
    {
        return $this->client->get('/exchange_rates');
    }
}
