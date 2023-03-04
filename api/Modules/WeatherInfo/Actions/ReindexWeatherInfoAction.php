<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\Actions;

use Closure;
use FullstackChallenge\Shared\Cache\CacheProviderInterface;
use FullstackChallenge\Shared\Cache\CanBuildCacheKeyFromLatLonInterface;
use FullstackChallenge\Shared\Utils\ActionableInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\GetCurrentWeatherManager;
use FullstackChallenge\WeatherInfo\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Throwable;

final readonly class ReindexWeatherInfoAction implements ActionableInterface
{
    /**
     * @throws BindingResolutionException
     */
    public function handle($content, Closure $next)
    {
        $users = User::all();

        $users->each(function (User $user) {
            dispatch(
                static function () use ($user) {
                    try {
                        $cacheProvider = app()->make(CacheProviderInterface::class);
                        $cacheKeyBuilder = app()->make(CanBuildCacheKeyFromLatLonInterface::class);
                        $manager = app()->make(GetCurrentWeatherManager::class);

                        $userLat = (float) $user->latitude;
                        $userLon = (float) $user->longitude;

                        $cacheKey = $cacheKeyBuilder->build($userLat, $userLon);

                        $cacheProvider->forget($cacheKey);

                        ($manager)($userLat, $userLon);
                    } catch (Throwable $e) {
                        var_dump($e->getMessage());
                    }
                }
            );
        });

        return $next($content);
    }
}
