<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class AssetPlatformsApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(?string $filter = null): array
    {
        $params = [];
        
        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->client->get('/asset_platforms', $params);
    }

    public function tokenLists(string $assetPlatformId, ?int $page = null): array
    {
        $params = [];
        
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->client->get("/token_lists/{$assetPlatformId}/all.json", $params);
    }
}
