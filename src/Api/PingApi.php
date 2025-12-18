<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class PingApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function ping(): array
    {
        return $this->client->get('/ping');
    }

    public function apiUsage(): array
    {
        return $this->client->get('/key');
    }
}
