<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\Actions;

use Closure;
use FullstackChallenge\Shared\Utils\ActionableInterface;
use FullstackChallenge\WeatherInfo\Models\User;

final readonly class GetAllUsersAction implements ActionableInterface
{
    public function handle($content, Closure $next)
    {
        return $next(User::all());
    }
}
