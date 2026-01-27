<?php

namespace Tigusigalpa\Coingecko\Api;

use Tigusigalpa\Coingecko\CoingeckoClient;

class WebSocketApi
{
    protected CoingeckoClient $client;
    protected ?string $apiKey;

    public function __construct(CoingeckoClient $client, ?string $apiKey = null)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getWebSocketUrl(): string
    {
        return 'wss://ws-pro.coingecko.com/v1';
    }

    public function createSimplePriceSubscription(array $coinIds, array $vsCurrencies): array
    {
        return [
            'type' => 'subscribe',
            'channel' => 'cg_simple_price',
            'coin_ids' => $coinIds,
            'vs_currencies' => $vsCurrencies,
        ];
    }

    public function createOnchainSimpleTokenPriceSubscription(
        string $network,
        array $addresses,
        array $vsCurrencies
    ): array {
        return [
            'type' => 'subscribe',
            'channel' => 'onchain_simple_token_price',
            'network' => $network,
            'addresses' => $addresses,
            'vs_currencies' => $vsCurrencies,
        ];
    }

    public function createOnchainTradeSubscription(string $network, string $poolAddress): array
    {
        return [
            'type' => 'subscribe',
            'channel' => 'onchain_trade',
            'network' => $network,
            'pool_address' => $poolAddress,
        ];
    }

    public function createOnchainOhlcvSubscription(
        string $network,
        string $poolAddress,
        string $timeframe
    ): array {
        return [
            'type' => 'subscribe',
            'channel' => 'onchain_ohlcv',
            'network' => $network,
            'pool_address' => $poolAddress,
            'timeframe' => $timeframe,
        ];
    }

    public function createUnsubscribeMessage(string $channel): array
    {
        return [
            'type' => 'unsubscribe',
            'channel' => $channel,
        ];
    }

    public function createPingMessage(): array
    {
        return [
            'type' => 'ping',
        ];
    }
}
