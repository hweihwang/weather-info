<?php

declare(strict_types=1);

namespace Frameworks\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    private const PROVIDERS = [
        RouteServiceProvider::class,
        ModuleServiceProvider::class,
    ];

    public function register(): void
    {
        foreach (self::PROVIDERS as $provider) {
            $this->app->register($provider);
        }
    }

    public function boot(): void
    {
    }
}
