<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class CategoriesApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(): array
    {
        return $this->client->get('/coins/categories/list');
    }

    public function listWithMarketData(?string $order = null): array
    {
        $params = [];
        
        if ($order !== null) {
            $params['order'] = $order;
        }

        return $this->client->get('/coins/categories', $params);
    }
}
