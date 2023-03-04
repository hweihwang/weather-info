<?php

declare(strict_types=1);

namespace FullstackChallenge\Shared\Cache;

use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;

final readonly class RedisCacheProvider implements CacheProviderInterface
{
    public function __construct(private Repository $store)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function remember(string $key, callable $callback, int $minutes = 5)
    {
        return $this->store->remember($key, $minutes * 60, function () use ($callback) {
            return $callback();
        });
    }

    public function forget(?string $key = null): bool
    {
        if (null === $key) {
            return $this->store->flush();
        }

        return $this->store->forget($key);
    }
}
