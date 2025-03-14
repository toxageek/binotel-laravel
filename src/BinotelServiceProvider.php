<?php

namespace Toxageek\BinotelLaravel;

use Illuminate\Support\ServiceProvider;

class BinotelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BinotelClient::class, fn () => new BinotelClient);

        $this->app->alias(BinotelClient::class, 'Binotel');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/binotel.php' => config_path('binotel.php'),
        ], 'config');
    }
}
