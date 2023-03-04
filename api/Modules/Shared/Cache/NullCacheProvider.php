<?php

declare(strict_types=1);

namespace FullstackChallenge\Shared\Cache;

final readonly class NullCacheProvider implements CacheProviderInterface
{
    public function remember(string $key, callable $callback, int $minutes = 5)
    {
        return $callback();
    }

    public function forget(?string $key = null): bool
    {
        return true;
    }
}
