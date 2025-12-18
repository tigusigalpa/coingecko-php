<?php

namespace Tigusigalpa\Coingecko;

use Tigusigalpa\Coingecko\Api\CoinsApi;
use Tigusigalpa\Coingecko\Api\ContractApi;
use Tigusigalpa\Coingecko\Api\PingApi;
use Tigusigalpa\Coingecko\Api\SimpleApi;

class Coingecko
{
    protected CoingeckoClient $client;
    protected SimpleApi $simple;
    protected CoinsApi $coins;
    protected ContractApi $contract;
    protected PingApi $ping;

    public function __construct(?string $apiKey = null, bool $isPro = false)
    {
        $this->client = new CoingeckoClient($apiKey, $isPro);
        $this->simple = new SimpleApi($this->client);
        $this->coins = new CoinsApi($this->client);
        $this->contract = new ContractApi($this->client);
        $this->ping = new PingApi($this->client);
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
}
