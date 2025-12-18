<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class ContractApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function coin(
        string $assetPlatform,
        string $contractAddress
    ): array {
        return $this->client->get("/coins/{$assetPlatform}/contract/{$contractAddress}");
    }

    public function marketChart(
        string $assetPlatform,
        string $contractAddress,
        string $vsCurrency,
        int|string $days,
        ?string $precision = null
    ): array {
        $params = [
            'vs_currency' => $vsCurrency,
            'days' => $days,
        ];

        if ($precision !== null) {
            $params['precision'] = $precision;
        }

        return $this->client->get("/coins/{$assetPlatform}/contract/{$contractAddress}/market_chart", $params);
    }

    public function marketChartRange(
        string $assetPlatform,
        string $contractAddress,
        string $vsCurrency,
        int $from,
        int $to,
        ?string $precision = null
    ): array {
        $params = [
            'vs_currency' => $vsCurrency,
            'from' => $from,
            'to' => $to,
        ];

        if ($precision !== null) {
            $params['precision'] = $precision;
        }

        return $this->client->get("/coins/{$assetPlatform}/contract/{$contractAddress}/market_chart/range", $params);
    }
}
