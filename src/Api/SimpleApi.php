<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class SimpleApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function price(
        string|array $ids,
        string|array $vsCurrencies,
        bool $includeMarketCap = false,
        bool $include24hrVol = false,
        bool $include24hrChange = false,
        bool $includeLastUpdatedAt = false
    ): array {
        $params = [
            'ids' => is_array($ids) ? implode(',', $ids) : $ids,
            'vs_currencies' => is_array($vsCurrencies) ? implode(',', $vsCurrencies) : $vsCurrencies,
        ];

        if ($includeMarketCap) {
            $params['include_market_cap'] = 'true';
        }
        if ($include24hrVol) {
            $params['include_24hr_vol'] = 'true';
        }
        if ($include24hrChange) {
            $params['include_24hr_change'] = 'true';
        }
        if ($includeLastUpdatedAt) {
            $params['include_last_updated_at'] = 'true';
        }

        return $this->client->get('/simple/price', $params);
    }

    public function tokenPrice(
        string $assetPlatform,
        string|array $contractAddresses,
        string|array $vsCurrencies,
        bool $includeMarketCap = false,
        bool $include24hrVol = false,
        bool $include24hrChange = false,
        bool $includeLastUpdatedAt = false
    ): array {
        $params = [
            'contract_addresses' => is_array($contractAddresses) ? implode(',', $contractAddresses) : $contractAddresses,
            'vs_currencies' => is_array($vsCurrencies) ? implode(',', $vsCurrencies) : $vsCurrencies,
        ];

        if ($includeMarketCap) {
            $params['include_market_cap'] = 'true';
        }
        if ($include24hrVol) {
            $params['include_24hr_vol'] = 'true';
        }
        if ($include24hrChange) {
            $params['include_24hr_change'] = 'true';
        }
        if ($includeLastUpdatedAt) {
            $params['include_last_updated_at'] = 'true';
        }

        return $this->client->get("/simple/token_price/{$assetPlatform}", $params);
    }

    public function supportedVsCurrencies(): array
    {
        return $this->client->get('/simple/supported_vs_currencies');
    }
}
