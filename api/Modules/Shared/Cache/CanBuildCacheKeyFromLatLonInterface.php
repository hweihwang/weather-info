<?php

namespace FullstackChallenge\Shared\Cache;

interface CanBuildCacheKeyFromLatLonInterface
{
    public function build(float $lat, float $lon): string;
}
