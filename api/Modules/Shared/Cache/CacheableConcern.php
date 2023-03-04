<?php

namespace FullstackChallenge\Shared\Cache;

trait CacheableConcern
{
    protected CacheProviderInterface $cacheProvider;

    public function setCacheProvider(CacheProviderInterface $cacheProvider): void
    {
        $this->cacheProvider = $cacheProvider;
    }
}
