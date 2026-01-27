<?php

namespace Tigusigalpa\Coingecko;

use Tigusigalpa\Coingecko\Api\AssetPlatformsApi;
use Tigusigalpa\Coingecko\Api\CategoriesApi;
use Tigusigalpa\Coingecko\Api\CoinsApi;
use Tigusigalpa\Coingecko\Api\ContractApi;
use Tigusigalpa\Coingecko\Api\DerivativesApi;
use Tigusigalpa\Coingecko\Api\EntitiesApi;
use Tigusigalpa\Coingecko\Api\ExchangeRatesApi;
use Tigusigalpa\Coingecko\Api\ExchangesApi;
use Tigusigalpa\Coingecko\Api\GlobalApi;
use Tigusigalpa\Coingecko\Api\NftsApi;
use Tigusigalpa\Coingecko\Api\PingApi;
use Tigusigalpa\Coingecko\Api\SearchApi;
use Tigusigalpa\Coingecko\Api\SimpleApi;
use Tigusigalpa\Coingecko\Api\WebSocketApi;

class Coingecko
{
    protected CoingeckoClient $client;
    protected SimpleApi $simple;
    protected CoinsApi $coins;
    protected ContractApi $contract;
    protected PingApi $ping;
    protected AssetPlatformsApi $assetPlatforms;
    protected CategoriesApi $categories;
    protected ExchangesApi $exchanges;
    protected DerivativesApi $derivatives;
    protected EntitiesApi $entities;
    protected NftsApi $nfts;
    protected ExchangeRatesApi $exchangeRates;
    protected SearchApi $search;
    protected GlobalApi $global;
    protected WebSocketApi $webSocket;

    public function __construct(?string $apiKey = null, bool $isPro = false)
    {
        $this->client = new CoingeckoClient($apiKey, $isPro);
        $this->simple = new SimpleApi($this->client);
        $this->coins = new CoinsApi($this->client);
        $this->contract = new ContractApi($this->client);
        $this->ping = new PingApi($this->client);
        $this->assetPlatforms = new AssetPlatformsApi($this->client);
        $this->categories = new CategoriesApi($this->client);
        $this->exchanges = new ExchangesApi($this->client);
        $this->derivatives = new DerivativesApi($this->client);
        $this->entities = new EntitiesApi($this->client);
        $this->nfts = new NftsApi($this->client);
        $this->exchangeRates = new ExchangeRatesApi($this->client);
        $this->search = new SearchApi($this->client);
        $this->global = new GlobalApi($this->client);
        $this->webSocket = new WebSocketApi($this->client, $apiKey);
    }

    public function simple(): SimpleApi
    {
        return $this->simple;
    }

    public function coins(): CoinsApi
    {
        return $this->coins;
    }

    public function contract(): ContractApi
    {
        return $this->contract;
    }

    public function ping(): PingApi
    {
        return $this->ping;
    }

    public function assetPlatforms(): AssetPlatformsApi
    {
        return $this->assetPlatforms;
    }

    public function categories(): CategoriesApi
    {
        return $this->categories;
    }

    public function exchanges(): ExchangesApi
    {
        return $this->exchanges;
    }

    public function derivatives(): DerivativesApi
    {
        return $this->derivatives;
    }

    public function entities(): EntitiesApi
    {
        return $this->entities;
    }

    public function nfts(): NftsApi
    {
        return $this->nfts;
    }

    public function exchangeRates(): ExchangeRatesApi
    {
        return $this->exchangeRates;
    }

    public function search(): SearchApi
    {
        return $this->search;
    }

    public function global(): GlobalApi
    {
        return $this->global;
    }

    public function webSocket(): WebSocketApi
    {
        return $this->webSocket;
    }
}
