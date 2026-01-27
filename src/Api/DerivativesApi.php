<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class DerivativesApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function tickers(?string $includeTickers = null): array
    {
        $params = [];
        
        if ($includeTickers !== null) {
            $params['include_tickers'] = $includeTickers;
        }

        return $this->client->get('/derivatives', $params);
    }

    public function exchanges(?string $order = null, ?int $perPage = null, ?int $page = null): array
    {
        $params = [];
        
        if ($order !== null) {
            $params['order'] = $order;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->client->get('/derivatives/exchanges', $params);
    }

    public function exchange(string $id, ?string $includeTickers = null): array
    {
        $params = [];
        
        if ($includeTickers !== null) {
            $params['include_tickers'] = $includeTickers;
        }

        return $this->client->get("/derivatives/exchanges/{$id}", $params);
    }

    public function exchangesList(): array
    {
        return $this->client->get('/derivatives/exchanges/list');
    }
}
