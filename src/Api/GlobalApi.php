<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class GlobalApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function crypto(): array
    {
        return $this->client->get('/global');
    }

    public function defi(): array
    {
        return $this->client->get('/global/decentralized_finance_defi');
    }

    public function marketCapChart(int $days, ?string $vsCurrency = null): array
    {
        $params = ['days' => $days];
        
        if ($vsCurrency !== null) {
            $params['vs_currency'] = $vsCurrency;
        }

        return $this->client->get('/global/market_cap_chart', $params);
    }
}
