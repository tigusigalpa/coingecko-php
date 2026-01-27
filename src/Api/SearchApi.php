<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class SearchApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function search(string $query): array
    {
        $params = ['query' => $query];

        return $this->client->get('/search', $params);
    }

    public function trending(): array
    {
        return $this->client->get('/search/trending');
    }
}
