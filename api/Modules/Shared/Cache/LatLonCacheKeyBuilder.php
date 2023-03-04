<?php

namespace FullstackChallenge\Shared\Cache;

final readonly class LatLonCacheKeyBuilder implements CanBuildCacheKeyFromLatLonInterface
{
    public function build(float $lat, float $lon): string
    {
        return sprintf('%s_%s', $lat, $lon);
    }
}
