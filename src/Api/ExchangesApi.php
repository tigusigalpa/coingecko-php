<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class ExchangesApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(?int $perPage = null, ?int $page = null): array
    {
        $params = [];
        
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->client->get('/exchanges', $params);
    }

    public function listIdMap(): array
    {
        return $this->client->get('/exchanges/list');
    }

    public function exchange(string $id): array
    {
        return $this->client->get("/exchanges/{$id}");
    }

    public function tickers(
        string $id,
        ?array $coinIds = null,
        bool $includeExchangeLogo = false,
        ?int $page = null,
        ?string $depth = null,
        ?string $order = null
    ): array {
        $params = [];
        
        if ($coinIds !== null) {
            $params['coin_ids'] = implode(',', $coinIds);
        }
        if ($includeExchangeLogo) {
            $params['include_exchange_logo'] = 'true';
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($depth !== null) {
            $params['depth'] = $depth;
        }
        if ($order !== null) {
            $params['order'] = $order;
        }

        return $this->client->get("/exchanges/{$id}/tickers", $params);
    }

    public function volumeChart(string $id, int $days): array
    {
        $params = ['days' => $days];

        return $this->client->get("/exchanges/{$id}/volume_chart", $params);
    }

    public function volumeChartRange(string $id, int $from, int $to): array
    {
        $params = [
            'from' => $from,
            'to' => $to,
        ];

        return $this->client->get("/exchanges/{$id}/volume_chart/range", $params);
    }
}
