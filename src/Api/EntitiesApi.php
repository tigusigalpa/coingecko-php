<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class EntitiesApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(): array
    {
        return $this->client->get('/entities/list');
    }

    public function treasuryByCoinId(string $coinId): array
    {
        return $this->client->get("/companies/public_treasury/{$coinId}");
    }

    public function treasuryByEntityId(string $entityId, ?string $coinId = null): array
    {
        $params = [];
        
        if ($coinId !== null) {
            $params['coin_id'] = $coinId;
        }

        return $this->client->get("/public_treasury/{$entityId}", $params);
    }

    public function treasuryChart(string $entityId, ?string $coinId = null, ?int $days = null): array
    {
        $params = [];
        
        if ($coinId !== null) {
            $params['coin_id'] = $coinId;
        }
        if ($days !== null) {
            $params['days'] = $days;
        }

        return $this->client->get("/public_treasury/{$entityId}/chart", $params);
    }

    public function transactionHistory(
        string $entityId,
        ?string $coinId = null,
        ?int $page = null,
        ?int $perPage = null
    ): array {
        $params = [];
        
        if ($coinId !== null) {
            $params['coin_id'] = $coinId;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->client->get("/public_treasury/{$entityId}/transaction_history", $params);
    }
}
