<?php

declare(strict_types=1);

namespace FullstackChallenge\Shared\Utils;

use Closure;

interface CanBePipedInterface
{
    public function handle($content, Closure $next);
}
