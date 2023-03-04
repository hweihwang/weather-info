<?php

declare(strict_types=1);

namespace FullstackChallenge\Shared\Cache;

use Throwable;

final readonly class ChainCacheProvider implements CacheProviderInterface
{
    public function __construct(private iterable $providers)
    {
    }

    public function remember(string $key, callable $callback, int $minutes = 5)
    {
        foreach ($this->providers as $provider) {
            try {
                if (! $provider instanceof CacheProviderInterface) {
                    continue;
                }

                $results = $provider->remember($key, $callback, $minutes);

                if (null === $results) {
                    continue;
                }

                return $results;
            } catch (Throwable $e) {
                report($e);

                continue;
            }
        }

        return $callback();
    }

    public function forget(?string $key = null): bool
    {
        foreach ($this->providers as $provider) {
            try {
                if (! $provider instanceof CacheProviderInterface) {
                    continue;
                }

                return $provider->forget($key);
            } catch (Throwable $e) {
                report($e);

                continue;
            }
        }

        return true;
    }
}
