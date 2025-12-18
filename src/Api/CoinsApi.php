<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class CoinsApi
{
    protected CoingeckoClient $client;

    public function __construct(CoingeckoClient $client)
    {
        $this->client = $client;
    }

    public function list(bool $includePlatform = false): array
    {
        $params = [];
        if ($includePlatform) {
            $params['include_platform'] = 'true';
        }

        return $this->client->get('/coins/list', $params);
    }

    public function topGainersLosers(string $vsCurrency = 'usd', ?string $duration = null, ?int $topCoins = null): array
    {
        $params = ['vs_currency' => $vsCurrency];
        
        if ($duration !== null) {
            $params['duration'] = $duration;
        }
        if ($topCoins !== null) {
            $params['top_coins'] = $topCoins;
        }

        return $this->client->get('/coins/top_gainers_losers', $params);
    }

    public function recentlyAdded(): array
    {
        return $this->client->get('/coins/list/new');
    }

    public function markets(
        string $vsCurrency = 'usd',
        ?array $ids = null,
        ?string $category = null,
        ?string $order = null,
        ?int $perPage = null,
        ?int $page = null,
        bool $sparkline = false,
        ?string $priceChangePercentage = null,
        ?string $locale = null,
        ?string $precision = null
    ): array {
        $params = ['vs_currency' => $vsCurrency];

        if ($ids !== null) {
            $params['ids'] = implode(',', $ids);
        }
        if ($category !== null) {
            $params['category'] = $category;
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
        if ($sparkline) {
            $params['sparkline'] = 'true';
        }
        if ($priceChangePercentage !== null) {
            $params['price_change_percentage'] = $priceChangePercentage;
        }
        if ($locale !== null) {
            $params['locale'] = $locale;
        }
        if ($precision !== null) {
            $params['precision'] = $precision;
        }

        return $this->client->get('/coins/markets', $params);
    }

    public function coin(
        string $id,
        bool $localization = true,
        bool $tickers = true,
        bool $marketData = true,
        bool $communityData = true,
        bool $developerData = true,
        bool $sparkline = false
    ): array {
        $params = [
            'localization' => $localization ? 'true' : 'false',
            'tickers' => $tickers ? 'true' : 'false',
            'market_data' => $marketData ? 'true' : 'false',
            'community_data' => $communityData ? 'true' : 'false',
            'developer_data' => $developerData ? 'true' : 'false',
            'sparkline' => $sparkline ? 'true' : 'false',
        ];

        return $this->client->get("/coins/{$id}", $params);
    }

    public function tickers(
        string $id,
        ?array $exchangeIds = null,
        bool $includeExchangeLogo = false,
        ?int $page = null,
        ?string $order = null,
        ?string $depth = null
    ): array {
        $params = [];

        if ($exchangeIds !== null) {
            $params['exchange_ids'] = implode(',', $exchangeIds);
        }
        if ($includeExchangeLogo) {
            $params['include_exchange_logo'] = 'true';
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($order !== null) {
            $params['order'] = $order;
        }
        if ($depth !== null) {
            $params['depth'] = $depth;
        }

        return $this->client->get("/coins/{$id}/tickers", $params);
    }

    public function history(string $id, string $date, bool $localization = false): array
    {
        $params = [
            'date' => $date,
            'localization' => $localization ? 'true' : 'false',
        ];

        return $this->client->get("/coins/{$id}/history", $params);
    }

    public function marketChart(
        string $id,
        string $vsCurrency,
        int|string $days,
        ?string $interval = null,
        ?string $precision = null
    ): array {
        $params = [
            'vs_currency' => $vsCurrency,
            'days' => $days,
        ];

        if ($interval !== null) {
            $params['interval'] = $interval;
        }
        if ($precision !== null) {
            $params['precision'] = $precision;
        }

        return $this->client->get("/coins/{$id}/market_chart", $params);
    }

    public function marketChartRange(
        string $id,
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

        return $this->client->get("/coins/{$id}/market_chart/range", $params);
    }

    public function ohlc(
        string $id,
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

        return $this->client->get("/coins/{$id}/ohlc", $params);
    }

    public function circulatingSupplyChart(
        string $id,
        int|string $days,
        ?string $interval = null
    ): array {
        $params = ['days' => $days];

        if ($interval !== null) {
            $params['interval'] = $interval;
        }

        return $this->client->get("/coins/{$id}/circulating_supply_chart", $params);
    }

    public function circulatingSupplyChartRange(
        string $id,
        int $from,
        int $to
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
        ];

        return $this->client->get("/coins/{$id}/circulating_supply_chart/range", $params);
    }

    public function totalSupplyChart(
        string $id,
        int|string $days,
        ?string $interval = null
    ): array {
        $params = ['days' => $days];

        if ($interval !== null) {
            $params['interval'] = $interval;
        }

        return $this->client->get("/coins/{$id}/total_supply_chart", $params);
    }

    public function totalSupplyChartRange(
        string $id,
        int $from,
        int $to
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
        ];

        return $this->client->get("/coins/{$id}/total_supply_chart/range", $params);
    }
}
