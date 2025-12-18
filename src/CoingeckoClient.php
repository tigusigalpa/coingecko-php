<?php

namespace Tigusigalpa\Coingecko;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Tigusigalpa\Coingecko\Exceptions\CoingeckoException;

class CoingeckoClient
{
    protected Client $client;
    protected ?string $apiKey;
    protected string $baseUrl;
    protected bool $isPro;

    public function __construct(?string $apiKey = null, bool $isPro = false)
    {
        $this->apiKey = $apiKey;
        $this->isPro = $isPro;
        $this->baseUrl = $isPro 
            ? 'https://pro-api.coingecko.com/api/v3'
            : 'https://api.coingecko.com/api/v3';

        $headers = [
            'Accept' => 'application/json',
        ];

        if ($this->apiKey) {
            $headers['x-cg-pro-api-key'] = $this->apiKey;
        }

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => $headers,
            'timeout' => 30,
        ]);
    }

    public function request(string $method, string $endpoint, array $params = []): array
    {
        try {
            $options = [];
            
            if (!empty($params)) {
                if (strtoupper($method) === 'GET') {
                    $options['query'] = $params;
                } else {
                    $options['json'] = $params;
                }
            }

            $response = $this->client->request($method, $endpoint, $options);
            $body = (string) $response->getBody();
            
            return json_decode($body, true) ?? [];
        } catch (GuzzleException $e) {
            throw new CoingeckoException(
                'CoinGecko API request failed: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    public function get(string $endpoint, array $params = []): array
    {
        return $this->request('GET', $endpoint, $params);
    }

    public function post(string $endpoint, array $params = []): array
    {
        return $this->request('POST', $endpoint, $params);
    }
}
