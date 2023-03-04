<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Requests;

use Exception;
use FullstackChallenge\Shared\Cache\CacheableInterface;
use FullstackChallenge\Shared\Cache\CacheProviderInterface;
use FullstackChallenge\Shared\Cache\CanBuildCacheKeyFromLatLonInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetCurrentWeatherApiRequestInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;

final readonly class GetCachedCurrentWeatherApiRequest implements GetCurrentWeatherApiRequestInterface, CacheableInterface
{
    public function __construct(
        private GetCurrentWeatherApiRequest $request,
        private CacheProviderInterface $cacheProvider,
        private CanBuildCacheKeyFromLatLonInterface $cacheKeyBuilder,
        private int $cacheTime = 60
    ) {
    }

    public function getCacheProvider(): CacheProviderInterface
    {
        return $this->cacheProvider;
    }

    /**
     * @throws Exception
     */
    public function send(
        float $lat,
        float $lon
    ): GetCurrentWeatherApiResponseInterface {
        $cacheKey = $this->cacheKeyBuilder->build($lat, $lon);

        return $this->getCacheProvider()->remember(
            $cacheKey,
            fn () => $this->request->send($lat, $lon),
            $this->cacheTime
        );
    }
}
