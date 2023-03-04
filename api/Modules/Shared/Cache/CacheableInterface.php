<?php

namespace FullstackChallenge\Shared\Cache;

interface CacheableInterface
{
    public function getCacheProvider(): CacheProviderInterface;
}
