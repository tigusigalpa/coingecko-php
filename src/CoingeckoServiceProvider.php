<?php

namespace Tigusigalpa\Coingecko;

use Illuminate\Support\ServiceProvider;

class CoingeckoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/coingecko.php',
            'coingecko'
        );

        $this->app->singleton('coingecko', function ($app) {
            $config = $app['config']['coingecko'];
            
            return new Coingecko(
                $config['api_key'] ?? null,
                $config['is_pro'] ?? false
            );
        });

        $this->app->alias('coingecko', Coingecko::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/coingecko.php' => config_path('coingecko.php'),
            ], 'coingecko-config');
        }
    }

    public function provides(): array
    {
        return ['coingecko', Coingecko::class];
    }
}
