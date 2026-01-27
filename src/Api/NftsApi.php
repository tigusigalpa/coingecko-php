<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class NftsApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(?string $order = null, ?string $assetPlatformId = null, ?int $perPage = null, ?int $page = null): array
    {
        $params = [];
        
        if ($order !== null) {
            $params['order'] = $order;
        }
        if ($assetPlatformId !== null) {
            $params['asset_platform_id'] = $assetPlatformId;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->client->get('/nfts/list', $params);
    }

    public function collection(string $id): array
    {
        return $this->client->get("/nfts/{$id}");
    }

    public function collectionByContract(string $assetPlatformId, string $contractAddress): array
    {
        return $this->client->get("/nfts/{$assetPlatformId}/contract/{$contractAddress}");
    }

    public function markets(?string $assetPlatformId = null, ?string $order = null, ?int $perPage = null, ?int $page = null): array
    {
        $params = [];
        
        if ($assetPlatformId !== null) {
            $params['asset_platform_id'] = $assetPlatformId;
        }
        if ($order !== null) {
            $params['order'] = $order;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->client->get('/nfts/markets', $params);
    }

    public function marketChart(string $id, int $days): array
    {
        $params = ['days' => $days];

        return $this->client->get("/nfts/{$id}/market_chart", $params);
    }

    public function marketChartByContract(string $assetPlatformId, string $contractAddress, int $days): array
    {
        $params = ['days' => $days];

        return $this->client->get("/nfts/{$assetPlatformId}/contract/{$contractAddress}/market_chart", $params);
    }

    public function tickers(string $id): array
    {
        return $this->client->get("/nfts/{$id}/tickers");
    }
}
