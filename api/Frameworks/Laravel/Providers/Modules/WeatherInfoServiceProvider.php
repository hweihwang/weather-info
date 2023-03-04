<?php

declare(strict_types=1);

namespace Frameworks\Laravel\Providers\Modules;

use Exception;
use FullstackChallenge\Shared\Cache\CacheProviderInterface;
use FullstackChallenge\Shared\Cache\CanBuildCacheKeyFromLatLonInterface;
use FullstackChallenge\Shared\Cache\LatLonCacheKeyBuilder;
use FullstackChallenge\WeatherInfo\DataProviders\OpenWeatherApi\Requests\GetCachedOpenCurrentWeatherApiRequest;
use FullstackChallenge\WeatherInfo\DataProviders\OpenWeatherApi\Requests\GetOpenCurrentWeatherApiRequest;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\GetCurrentWeatherManager;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetChainCurrentWeatherApiRequest;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetCurrentWeatherApiRequestInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetNullCurrentWeatherApiRequest;
use FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Requests\GetCachedCurrentWeatherApiRequest;
use FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Requests\GetCurrentWeatherApiRequest;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class WeatherInfoServiceProvider extends BaseServiceProvider
{
    /**
     * @throws Exception
     */
    public function register(): void
    {
        $this->app->singleton(CanBuildCacheKeyFromLatLonInterface::class, LatLonCacheKeyBuilder::class);

        $this->app->singleton(
            GetCurrentWeatherApiRequest::class,
            fn () => new GetCurrentWeatherApiRequest(
                config('fullstackChallenge.weatherApi.apiUrl'),
                config('fullstackChallenge.weatherApi.apiKey')
            )
        );

        $this->app->singleton(
            GetCachedCurrentWeatherApiRequest::class,
            fn () => new GetCachedCurrentWeatherApiRequest(
                $this->app->make(GetCurrentWeatherApiRequest::class),
                $this->app->make(CacheProviderInterface::class),
                $this->app->make(CanBuildCacheKeyFromLatLonInterface::class),
                config('fullstackChallenge.cache.ttl')
            )
        );

        $this->app->singleton(
            GetOpenCurrentWeatherApiRequest::class,
            fn () => new GetOpenCurrentWeatherApiRequest(
                config('fullstackChallenge.openWeatherApi.apiUrl'),
                config('fullstackChallenge.openWeatherApi.apiKey')
            )
        );

        $this->app->singleton(
            GetCachedOpenCurrentWeatherApiRequest::class,
            fn () => new GetCachedOpenCurrentWeatherApiRequest(
                $this->app->make(GetOpenCurrentWeatherApiRequest::class),
                $this->app->make(CacheProviderInterface::class),
                $this->app->make(CanBuildCacheKeyFromLatLonInterface::class),
                config('fullstackChallenge.cache.ttl')
            )
        );

        $this->app->singleton(
            GetChainCurrentWeatherApiRequest::class,
            fn () => new GetChainCurrentWeatherApiRequest(
                [
                    $this->app->make(GetCachedCurrentWeatherApiRequest::class),
                    $this->app->make(GetCachedOpenCurrentWeatherApiRequest::class),
                    $this->app->make(GetNullCurrentWeatherApiRequest::class),
                ]
            )
        );

        $this->app->singleton(
            GetCurrentWeatherApiRequestInterface::class,
            GetChainCurrentWeatherApiRequest::class
        );

        $this->app->singleton(
            GetCurrentWeatherManager::class,
            fn () => new GetCurrentWeatherManager($this->app->make(GetCurrentWeatherApiRequestInterface::class))
        );
    }
}
