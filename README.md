# CoinGecko PHP/Laravel API Client

<div align="center">

![CoinGecko PHP SDK](https://github.com/user-attachments/assets/bab9bea7-a93c-445f-8db3-862576b96977)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tigusigalpa/coingecko-php.svg?style=flat-square)](https://packagist.org/packages/tigusigalpa/coingecko-php)
[![Total Downloads](https://img.shields.io/packagist/dt/tigusigalpa/coingecko-php.svg?style=flat-square)](https://packagist.org/packages/tigusigalpa/coingecko-php)
[![License](https://img.shields.io/packagist/l/tigusigalpa/coingecko-php.svg?style=flat-square)](https://packagist.org/packages/tigusigalpa/coingecko-php)

A comprehensive, modern PHP/Laravel package for seamless integration with
the [CoinGecko API](https://www.coingecko.com/en/api). Get real-time cryptocurrency prices, market data, historical
charts, and more with an elegant, developer-friendly interface.

[Features](#features) • [Installation](#installation) • [Quick Start](#quick-start) • [Documentation](#documentation) • [Examples](#examples)

</div>

---

## 🚀 Features

- ✅ **Complete API Coverage** - All CoinGecko API endpoints implemented
- 🔐 **Pro API Support** - Full support for CoinGecko Pro API with authentication
- 🎯 **Laravel Integration** - Service provider, facade, and configuration out of the box
- 💎 **Modern PHP** - Built with PHP 8.0+ features and best practices
- 🛡️ **Type Safety** - Fully typed parameters and return values
- 📦 **Zero Configuration** - Works immediately with sensible defaults
- 🔄 **Flexible** - Use as standalone PHP library or Laravel package
- 🎨 **Clean API** - Intuitive, chainable methods for better developer experience
- ⚡ **Performance** - Efficient HTTP client with connection pooling
- 📚 **Well Documented** - Comprehensive examples and API reference

## 📋 Requirements

- PHP 8.0 or higher
- Laravel 9.x, 10.x, or 11.x (for Laravel integration)
- Guzzle HTTP client 7.x

## 📦 Installation

Install the package via Composer:

```bash
composer require tigusigalpa/coingecko-php
```

### Laravel Setup

The package will automatically register its service provider. Publish the configuration file:

```bash
php artisan vendor:publish --tag=coingecko-config
```

Add your CoinGecko API credentials to your `.env` file:

```env
COINGECKO_API_KEY=your-api-key-here
COINGECKO_IS_PRO=false
```

> **Note:** API key is optional for free tier. Set `COINGECKO_IS_PRO=true` if you have a Pro API subscription.

## 🎯 Quick Start

### Standalone PHP Usage

```php
use Tigusigalpa\Coingecko\Coingecko;

// Initialize client (no API key needed for free tier)
$coingecko = new Coingecko();

// Get Bitcoin price in USD
$price = $coingecko->simple()->price('bitcoin', 'usd');
echo "Bitcoin: $" . $price['bitcoin']['usd'];

// With Pro API
$coingecko = new Coingecko('your-api-key', true);
```

### Laravel Usage

```php
use Tigusigalpa\Coingecko\Facades\Coingecko;

// Using Facade
$price = Coingecko::simple()->price('bitcoin', 'usd');

// Using Dependency Injection
use Tigusigalpa\Coingecko\Coingecko;

class CryptoController extends Controller
{
    public function __construct(private Coingecko $coingecko)
    {
    }

    public function index()
    {
        $markets = $this->coingecko->coins()->markets('usd', perPage: 10);
        return view('crypto.index', compact('markets'));
    }
}
```

## 📖 Documentation

### API Endpoints

The package is organized into logical API groups:

- **[Simple API](#simple-api)** - Quick price lookups and supported currencies
- **[Coins API](#coins-api)** - Comprehensive coin data, markets, and historical charts
- **[Contract API](#contract-api)** - Token data by contract address
- **[Asset Platforms API](#asset-platforms-api)** - Asset platforms and token lists
- **[Categories API](#categories-api)** - Coin categories with market data
- **[Exchanges API](#exchanges-api)** - Exchange data, tickers, and volume charts
- **[Derivatives API](#derivatives-api)** - Derivatives tickers and exchanges
- **[Entities API](#entities-api)** - Crypto treasury holdings and transactions
- **[NFTs API](#nfts-api)** - NFT collections and market data
- **[Exchange Rates API](#exchange-rates-api)** - BTC-to-currency exchange rates
- **[Search API](#search-api)** - Search queries and trending data
- **[Global API](#global-api)** - Global crypto and DeFi market data
- **[WebSocket API](#websocket-api)** - Real-time WebSocket subscriptions
- **[Ping API](#ping-api)** - Server status and API usage

---

### Simple API

Get cryptocurrency prices and basic market data quickly.

#### Get Coin Prices

```php
// Single coin, single currency
$price = $coingecko->simple()->price('bitcoin', 'usd');
// Returns: ['bitcoin' => ['usd' => 45000]]

// Multiple coins, multiple currencies
$prices = $coingecko->simple()->price(
    ids: ['bitcoin', 'ethereum', 'cardano'],
    vsCurrencies: ['usd', 'eur', 'gbp'],
    includeMarketCap: true,
    include24hrVol: true,
    include24hrChange: true
);

// Example response:
// [
//     'bitcoin' => [
//         'usd' => 45000,
//         'eur' => 42000,
//         'usd_market_cap' => 850000000000,
//         'usd_24h_vol' => 35000000000,
//         'usd_24h_change' => 2.5
//     ],
//     ...
// ]
```

#### Get Token Prices by Contract Address

```php
// Get price for a token on Ethereum
$tokenPrice = $coingecko->simple()->tokenPrice(
    assetPlatform: 'ethereum',
    contractAddresses: '0x1f9840a85d5af5bf1d1762f925bdaddc4201f984', // UNI token
    vsCurrencies: 'usd',
    includeMarketCap: true,
    include24hrVol: true
);
```

#### Get Supported Currencies

```php
$currencies = $coingecko->simple()->supportedVsCurrencies();
// Returns: ['usd', 'eur', 'gbp', 'jpy', ...]
```

---

### Coins API

Access detailed coin information, market data, and historical charts.

#### List All Coins

```php
// Get list of all coins with IDs
$coinsList = $coingecko->coins()->list();

// Include platform information
$coinsWithPlatforms = $coingecko->coins()->list(includePlatform: true);
```

#### Top Gainers & Losers

```php
$topMovers = $coingecko->coins()->topGainersLosers(
    vsCurrency: 'usd',
    duration: '24h',
    topCoins: 100
);

// Returns top gainers and losers with percentage changes
```

#### Recently Added Coins

```php
$newCoins = $coingecko->coins()->recentlyAdded();
```

#### Coins Market Data

```php
// Get top 100 coins by market cap
$markets = $coingecko->coins()->markets(
    vsCurrency: 'usd',
    order: 'market_cap_desc',
    perPage: 100,
    page: 1,
    sparkline: true,
    priceChangePercentage: '1h,24h,7d'
);

// Filter by specific coins
$specificCoins = $coingecko->coins()->markets(
    vsCurrency: 'usd',
    ids: ['bitcoin', 'ethereum', 'cardano']
);

// Filter by category
$defiCoins = $coingecko->coins()->markets(
    vsCurrency: 'usd',
    category: 'decentralized-finance-defi',
    perPage: 50
);
```

#### Detailed Coin Data

```php
// Get comprehensive data for a specific coin
$bitcoin = $coingecko->coins()->coin(
    id: 'bitcoin',
    localization: true,
    tickers: true,
    marketData: true,
    communityData: true,
    developerData: true,
    sparkline: true
);

// Access various data points:
// $bitcoin['market_data']['current_price']['usd']
// $bitcoin['market_data']['market_cap']['usd']
// $bitcoin['market_data']['total_volume']['usd']
// $bitcoin['community_data']['twitter_followers']
// $bitcoin['developer_data']['stars']
```

#### Coin Tickers

```php
// Get all trading pairs for a coin
$tickers = $coingecko->coins()->tickers(
    id: 'bitcoin',
    exchangeIds: ['binance', 'coinbase'],
    page: 1,
    order: 'volume_desc'
);
```

#### Historical Data

```php
// Get coin data at a specific date
$historicalData = $coingecko->coins()->history(
    id: 'bitcoin',
    date: '30-12-2023', // DD-MM-YYYY format
    localization: false
);
```

#### Market Chart Data

```php
// Get price, market cap, and volume chart data
$chartData = $coingecko->coins()->marketChart(
    id: 'bitcoin',
    vsCurrency: 'usd',
    days: 30, // 1, 7, 14, 30, 90, 180, 365, 'max'
    interval: 'daily' // optional: 'daily' or 'hourly'
);

// Returns:
// [
//     'prices' => [[timestamp, price], ...],
//     'market_caps' => [[timestamp, market_cap], ...],
//     'total_volumes' => [[timestamp, volume], ...]
// ]

// Get chart data for specific time range
$rangeData = $coingecko->coins()->marketChartRange(
    id: 'ethereum',
    vsCurrency: 'usd',
    from: 1609459200, // Unix timestamp
    to: 1640995200,   // Unix timestamp
    precision: '2'
);
```

#### OHLC Chart Data

```php
// Get candlestick (OHLC) data
$ohlc = $coingecko->coins()->ohlc(
    id: 'bitcoin',
    vsCurrency: 'usd',
    days: 7 // 1, 7, 14, 30, 90, 180, 365
);

// Returns: [[timestamp, open, high, low, close], ...]
```

#### Supply Charts

```php
// Circulating supply chart
$circulatingSupply = $coingecko->coins()->circulatingSupplyChart(
    id: 'bitcoin',
    days: 30,
    interval: 'daily'
);

// Circulating supply for specific time range
$circulatingRange = $coingecko->coins()->circulatingSupplyChartRange(
    id: 'bitcoin',
    from: 1609459200,
    to: 1640995200
);

// Total supply chart
$totalSupply = $coingecko->coins()->totalSupplyChart(
    id: 'ethereum',
    days: 90
);

// Total supply for specific time range
$totalRange = $coingecko->coins()->totalSupplyChartRange(
    id: 'ethereum',
    from: 1609459200,
    to: 1640995200
);
```

---

### Contract API

Get token data using contract addresses on various blockchain platforms.

#### Get Token Data by Contract Address

```php
// Get comprehensive token data
$tokenData = $coingecko->contract()->coin(
    assetPlatform: 'ethereum',
    contractAddress: '0x1f9840a85d5af5bf1d1762f925bdaddc4201f984' // UNI token
);

// Supported platforms: ethereum, binance-smart-chain, polygon-pos, 
// avalanche, arbitrum-one, optimistic-ethereum, etc.
```

#### Token Market Chart by Contract

```php
// Get price chart for a token
$tokenChart = $coingecko->contract()->marketChart(
    assetPlatform: 'ethereum',
    contractAddress: '0x1f9840a85d5af5bf1d1762f925bdaddc4201f984',
    vsCurrency: 'usd',
    days: 30
);

// Get chart data for specific time range
$tokenRangeChart = $coingecko->contract()->marketChartRange(
    assetPlatform: 'ethereum',
    contractAddress: '0x1f9840a85d5af5bf1d1762f925bdaddc4201f984',
    vsCurrency: 'usd',
    from: 1609459200,
    to: 1640995200
);
```

---

### Asset Platforms API

Get information about blockchain platforms and their tokens.

#### Get Asset Platforms List

```php
// Get all asset platforms
$platforms = $coingecko->assetPlatforms()->list();

// Filter platforms
$filtered = $coingecko->assetPlatforms()->list(filter: 'nft');
```

#### Get Token Lists by Platform

```php
// Get all tokens on a specific platform
$tokens = $coingecko->assetPlatforms()->tokenLists(
    assetPlatformId: 'ethereum',
    page: 1
);
```

---

### Categories API

Access cryptocurrency categories and their market data.

#### Get Categories List (ID Map)

```php
// Get list of all coin categories
$categories = $coingecko->categories()->list();
```

#### Get Categories with Market Data

```php
// Get categories with market data
$categoriesData = $coingecko->categories()->listWithMarketData(
    order: 'market_cap_desc'
);

// Available order options: market_cap_desc, market_cap_asc, name_desc, name_asc, 
// market_cap_change_24h_desc, market_cap_change_24h_asc
```

---

### Exchanges API

Access exchange data, tickers, and volume information.

#### Get Exchanges List with Data

```php
// Get all exchanges with data
$exchanges = $coingecko->exchanges()->list(
    perPage: 100,
    page: 1
);
```

#### Get Exchanges List (ID Map)

```php
// Get simple list of exchange IDs
$exchangeIds = $coingecko->exchanges()->listIdMap();
```

#### Get Exchange Data by ID

```php
// Get detailed data for a specific exchange
$binance = $coingecko->exchanges()->exchange('binance');
```

#### Get Exchange Tickers

```php
// Get all tickers for an exchange
$tickers = $coingecko->exchanges()->tickers(
    id: 'binance',
    coinIds: ['bitcoin', 'ethereum'],
    includeExchangeLogo: true,
    page: 1,
    depth: 'true',
    order: 'volume_desc'
);
```

#### Get Exchange Volume Chart

```php
// Get volume chart for an exchange
$volumeChart = $coingecko->exchanges()->volumeChart(
    id: 'binance',
    days: 30
);

// Get volume chart for specific time range
$volumeRange = $coingecko->exchanges()->volumeChartRange(
    id: 'binance',
    from: 1609459200,
    to: 1640995200
);
```

---

### Derivatives API

Access derivatives market data and exchanges.

#### Get Derivatives Tickers

```php
// Get all derivatives tickers
$derivativesTickers = $coingecko->derivatives()->tickers(
    includeTickers: 'unexpired'
);
```

#### Get Derivatives Exchanges

```php
// Get all derivatives exchanges
$derivativesExchanges = $coingecko->derivatives()->exchanges(
    order: 'open_interest_btc_desc',
    perPage: 100,
    page: 1
);
```

#### Get Derivatives Exchange by ID

```php
// Get specific derivatives exchange data
$exchange = $coingecko->derivatives()->exchange(
    id: 'binance_futures',
    includeTickers: 'all'
);
```

#### Get Derivatives Exchanges List (ID Map)

```php
// Get simple list of derivatives exchange IDs
$exchangeIds = $coingecko->derivatives()->exchangesList();
```

---

### Entities API

Access crypto treasury holdings and transaction history.

#### Get Entities List (ID Map)

```php
// Get list of all entities
$entities = $coingecko->entities()->list();
```

#### Get Crypto Treasury Holdings by Coin ID

```php
// Get companies holding Bitcoin
$bitcoinHolders = $coingecko->entities()->treasuryByCoinId('bitcoin');

// Get companies holding Ethereum
$ethereumHolders = $coingecko->entities()->treasuryByCoinId('ethereum');
```

#### Get Crypto Treasury Holdings by Entity ID

```php
// Get treasury holdings for a specific entity
$treasury = $coingecko->entities()->treasuryByEntityId(
    entityId: 'microstrategy',
    coinId: 'bitcoin'
);
```

#### Get Treasury Historical Chart

```php
// Get historical treasury chart data
$chart = $coingecko->entities()->treasuryChart(
    entityId: 'microstrategy',
    coinId: 'bitcoin',
    days: 365
);
```

#### Get Treasury Transaction History

```php
// Get transaction history for an entity
$transactions = $coingecko->entities()->transactionHistory(
    entityId: 'microstrategy',
    coinId: 'bitcoin',
    page: 1,
    perPage: 100
);
```

---

### NFTs API

Access NFT collections and market data.

#### Get NFTs List (ID Map)

```php
// Get list of all NFT collections
$nfts = $coingecko->nfts()->list(
    order: 'h24_volume_native_desc',
    assetPlatformId: 'ethereum',
    perPage: 100,
    page: 1
);
```

#### Get NFT Collection Data by ID

```php
// Get detailed NFT collection data
$collection = $coingecko->nfts()->collection('cryptopunks');
```

#### Get NFT Collection by Contract Address

```php
// Get NFT data by contract address
$nft = $coingecko->nfts()->collectionByContract(
    assetPlatformId: 'ethereum',
    contractAddress: '0xb47e3cd837ddf8e4c57f05d70ab865de6e193bbb'
);
```

#### Get NFTs List with Market Data

```php
// Get NFT collections with market data
$nftMarkets = $coingecko->nfts()->markets(
    assetPlatformId: 'ethereum',
    order: 'h24_volume_native_desc',
    perPage: 100,
    page: 1
);
```

#### Get NFT Collection Market Chart

```php
// Get market chart for NFT collection
$chart = $coingecko->nfts()->marketChart(
    id: 'cryptopunks',
    days: 30
);

// Get market chart by contract address
$chartByContract = $coingecko->nfts()->marketChartByContract(
    assetPlatformId: 'ethereum',
    contractAddress: '0xb47e3cd837ddf8e4c57f05d70ab865de6e193bbb',
    days: 30
);
```

#### Get NFT Collection Tickers

```php
// Get tickers for NFT collection
$tickers = $coingecko->nfts()->tickers('cryptopunks');
```

---

### Exchange Rates API

Get BTC-to-currency exchange rates.

#### Get BTC Exchange Rates

```php
// Get Bitcoin exchange rates for all currencies
$rates = $coingecko->exchangeRates()->rates();

// Returns rates for BTC to USD, EUR, and many other currencies
```

---

### Search API

Search for coins, exchanges, and categories, and get trending data.

#### Search Queries

```php
// Search for coins, exchanges, categories, and NFTs
$results = $coingecko->search()->search('bitcoin');

// Returns:
// [
//     'coins' => [...],
//     'exchanges' => [...],
//     'categories' => [...],
//     'nfts' => [...]
// ]
```

#### Get Trending Search List

```php
// Get trending searches
$trending = $coingecko->search()->trending();

// Returns trending coins, NFTs, and categories
```

---

### Global API

Access global cryptocurrency and DeFi market data.

#### Get Crypto Global Market Data

```php
// Get global crypto market data
$globalData = $coingecko->global()->crypto();

// Returns total market cap, volume, market cap percentage, etc.
```

#### Get Global DeFi Market Data

```php
// Get global DeFi market data
$defiData = $coingecko->global()->defi();

// Returns DeFi market cap, volume, and other metrics
```

#### Get Global Market Cap Chart

```php
// Get global market cap chart
$marketCapChart = $coingecko->global()->marketCapChart(
    days: 30,
    vsCurrency: 'usd'
);
```

---

### WebSocket API

Real-time WebSocket subscriptions for live data (Beta).

#### Get WebSocket URL

```php
// Get WebSocket connection URL
$wsUrl = $coingecko->webSocket()->getWebSocketUrl();
// Returns: wss://ws-pro.coingecko.com/v1
```

#### Create Simple Price Subscription

```php
// Create subscription message for simple price updates
$subscription = $coingecko->webSocket()->createSimplePriceSubscription(
    coinIds: ['bitcoin', 'ethereum'],
    vsCurrencies: ['usd', 'eur']
);

// Send this JSON message through your WebSocket connection
```

#### Create Onchain Token Price Subscription

```php
// Subscribe to onchain token prices
$subscription = $coingecko->webSocket()->createOnchainSimpleTokenPriceSubscription(
    network: 'eth',
    addresses: ['0x1f9840a85d5af5bf1d1762f925bdaddc4201f984'],
    vsCurrencies: ['usd']
);
```

#### Create Onchain Trade Subscription

```php
// Subscribe to onchain trades
$subscription = $coingecko->webSocket()->createOnchainTradeSubscription(
    network: 'eth',
    poolAddress: '0x...'
);
```

#### Create Onchain OHLCV Subscription

```php
// Subscribe to onchain OHLCV data
$subscription = $coingecko->webSocket()->createOnchainOhlcvSubscription(
    network: 'eth',
    poolAddress: '0x...',
    timeframe: '1m' // 1m, 5m, 15m, 1h, 4h, 1d
);
```

#### Unsubscribe and Ping

```php
// Unsubscribe from a channel
$unsubscribe = $coingecko->webSocket()->createUnsubscribeMessage('cg_simple_price');

// Create ping message to keep connection alive
$ping = $coingecko->webSocket()->createPingMessage();
```

---

### Ping API

Check API server status and monitor your API usage.

#### Check Server Status

```php
$status = $coingecko->ping()->ping();
// Returns: ['gecko_says' => '(V3) To the Moon!']
```

#### Check API Usage (Pro API only)

```php
$usage = $coingecko->ping()->apiUsage();
// Returns information about your API key usage and rate limits
```

---

## 💡 Examples

### Real-World Use Cases

#### Portfolio Tracker

```php
use Tigusigalpa\Coingecko\Facades\Coingecko;

class PortfolioService
{
    public function getPortfolioValue(array $holdings): float
    {
        $coinIds = array_keys($holdings);
        $prices = Coingecko::simple()->price($coinIds, 'usd');
        
        $totalValue = 0;
        foreach ($holdings as $coinId => $amount) {
            $totalValue += $prices[$coinId]['usd'] * $amount;
        }
        
        return $totalValue;
    }
}

// Usage
$portfolio = [
    'bitcoin' => 0.5,
    'ethereum' => 10,
    'cardano' => 1000
];

$service = new PortfolioService();
$value = $service->getPortfolioValue($portfolio);
echo "Portfolio Value: $" . number_format($value, 2);
```

#### Price Alert System

```php
use Tigusigalpa\Coingecko\Coingecko;

class PriceAlertChecker
{
    public function __construct(private Coingecko $coingecko)
    {
    }

    public function checkAlerts(array $alerts): array
    {
        $coinIds = array_unique(array_column($alerts, 'coin_id'));
        $prices = $this->coingecko->simple()->price(
            ids: $coinIds,
            vsCurrencies: 'usd',
            include24hrChange: true
        );
        
        $triggered = [];
        foreach ($alerts as $alert) {
            $currentPrice = $prices[$alert['coin_id']]['usd'];
            
            if ($alert['type'] === 'above' && $currentPrice >= $alert['target_price']) {
                $triggered[] = $alert;
            } elseif ($alert['type'] === 'below' && $currentPrice <= $alert['target_price']) {
                $triggered[] = $alert;
            }
        }
        
        return $triggered;
    }
}
```

#### Market Analysis Dashboard

```php
use Tigusigalpa\Coingecko\Facades\Coingecko;

class MarketAnalyzer
{
    public function getDashboardData(): array
    {
        // Get top 10 coins by market cap
        $topCoins = Coingecko::coins()->markets(
            vsCurrency: 'usd',
            order: 'market_cap_desc',
            perPage: 10,
            sparkline: true,
            priceChangePercentage: '1h,24h,7d,30d'
        );
        
        // Get top gainers and losers
        $movers = Coingecko::coins()->topGainersLosers('usd', '24h', 100);
        
        // Get recently added coins
        $newCoins = Coingecko::coins()->recentlyAdded();
        
        return [
            'top_coins' => $topCoins,
            'gainers' => array_slice($movers['top_gainers'] ?? [], 0, 5),
            'losers' => array_slice($movers['top_losers'] ?? [], 0, 5),
            'new_listings' => array_slice($newCoins, 0, 5)
        ];
    }
}
```

#### Historical Price Comparison

```php
use Tigusigalpa\Coingecko\Coingecko;

class PriceComparison
{
    public function __construct(private Coingecko $coingecko)
    {
    }

    public function compareCoins(array $coinIds, int $days = 30): array
    {
        $comparison = [];
        
        foreach ($coinIds as $coinId) {
            $chartData = $this->coingecko->coins()->marketChart(
                id: $coinId,
                vsCurrency: 'usd',
                days: $days
            );
            
            $prices = array_column($chartData['prices'], 1);
            $startPrice = reset($prices);
            $endPrice = end($prices);
            $change = (($endPrice - $startPrice) / $startPrice) * 100;
            
            $comparison[$coinId] = [
                'start_price' => $startPrice,
                'end_price' => $endPrice,
                'change_percent' => round($change, 2),
                'chart_data' => $chartData['prices']
            ];
        }
        
        return $comparison;
    }
}

// Usage
$comparison = new PriceComparison(new Coingecko());
$results = $comparison->compareCoins(['bitcoin', 'ethereum', 'cardano'], 90);
```

#### DeFi Token Tracker

```php
use Tigusigalpa\Coingecko\Facades\Coingecko;

class DeFiTracker
{
    public function trackToken(string $platform, string $contractAddress): array
    {
        // Get token data
        $tokenData = Coingecko::contract()->coin($platform, $contractAddress);
        
        // Get 7-day price chart
        $priceChart = Coingecko::contract()->marketChart(
            assetPlatform: $platform,
            contractAddress: $contractAddress,
            vsCurrency: 'usd',
            days: 7
        );
        
        return [
            'name' => $tokenData['name'],
            'symbol' => $tokenData['symbol'],
            'current_price' => $tokenData['market_data']['current_price']['usd'],
            'market_cap' => $tokenData['market_data']['market_cap']['usd'],
            'total_volume' => $tokenData['market_data']['total_volume']['usd'],
            'price_change_24h' => $tokenData['market_data']['price_change_percentage_24h'],
            'chart' => $priceChart
        ];
    }
}

// Usage - Track Uniswap (UNI) token
$tracker = new DeFiTracker();
$uniData = $tracker->trackToken('ethereum', '0x1f9840a85d5af5bf1d1762f925bdaddc4201f984');
```

---

## 🔧 Advanced Configuration

### Custom HTTP Client Options

```php
use Tigusigalpa\Coingecko\CoingeckoClient;
use GuzzleHttp\Client;

// Create custom Guzzle client with specific options
$httpClient = new Client([
    'timeout' => 60,
    'connect_timeout' => 10,
    'verify' => true,
    'proxy' => 'http://proxy.example.com:8080'
]);

// Note: You can extend CoingeckoClient to use custom HTTP client
```

### Error Handling

```php
use Tigusigalpa\Coingecko\Facades\Coingecko;
use Tigusigalpa\Coingecko\Exceptions\CoingeckoException;

try {
    $price = Coingecko::simple()->price('bitcoin', 'usd');
} catch (CoingeckoException $e) {
    // Handle API errors
    Log::error('CoinGecko API Error: ' . $e->getMessage());
    
    // You can also check the status code
    $statusCode = $e->getCode();
    
    if ($statusCode === 429) {
        // Rate limit exceeded
        return response()->json(['error' => 'Rate limit exceeded'], 429);
    }
}
```

### Rate Limiting

CoinGecko API has rate limits:

- **Free API**: 10-50 calls/minute
- **Pro API**: Higher limits based on your plan

The package doesn't implement automatic rate limiting, so you should implement your own caching strategy:

```php
use Illuminate\Support\Facades\Cache;
use Tigusigalpa\Coingecko\Facades\Coingecko;

class CachedCoinGeckoService
{
    public function getPrice(string $coinId, string $currency): array
    {
        $cacheKey = "coingecko_price_{$coinId}_{$currency}";
        
        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($coinId, $currency) {
            return Coingecko::simple()->price($coinId, $currency);
        });
    }
}
```

---

## 🧪 Testing

```bash
composer test
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 🔒 Security

If you discover any security-related issues, please email sovletig@gmail.com instead of using the issue tracker.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## 🙏 Credits

- [Igor Sazonov](https://github.com/tigusigalpa)
- [CoinGecko](https://www.coingecko.com) for providing the API
- All [contributors](https://github.com/tigusigalpa/coingecko-php/contributors)

## 🔗 Links

- **Package
  **: [https://packagist.org/packages/tigusigalpa/coingecko-php](https://packagist.org/packages/tigusigalpa/coingecko-php)
- **Repository**: [https://github.com/tigusigalpa/coingecko-php](https://github.com/tigusigalpa/coingecko-php)
- **CoinGecko API Documentation**: [https://docs.coingecko.com](https://docs.coingecko.com)
- **CoinGecko Website**: [https://www.coingecko.com](https://www.coingecko.com)

---

<div align="center">

**[⬆ back to top](#coingecko-phplaravel-api-client)**

</div>
