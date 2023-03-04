<?php

declare(strict_types=1);

namespace FullstackChallenge\Shared\Cache;

interface CacheProviderInterface
{
    public function remember(string $key, callable $callback, int $minutes = 5);

    public function forget(?string $key = null): bool;
}
