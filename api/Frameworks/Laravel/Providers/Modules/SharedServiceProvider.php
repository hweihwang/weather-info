<?php

declare(strict_types=1);

namespace Frameworks\Laravel\Providers\Modules;

use Exception;
use FullstackChallenge\Shared\Cache\CacheProviderInterface;
use FullstackChallenge\Shared\Cache\ChainCacheProvider;
use FullstackChallenge\Shared\Cache\NullCacheProvider;
use FullstackChallenge\Shared\Cache\RedisCacheProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class SharedServiceProvider extends BaseServiceProvider
{
    /**
     * @throws Exception
     */
    public function register(): void
    {
        $this->app->singleton(RedisCacheProvider::class, fn () => new RedisCacheProvider(Cache::store('redis')));

        $this->app->singleton(ChainCacheProvider::class, fn () => new ChainCacheProvider([
            $this->app->make(RedisCacheProvider::class),
            $this->app->make(NullCacheProvider::class),
        ]));

        $this->app->singleton(CacheProviderInterface::class, ChainCacheProvider::class);
    }
}
