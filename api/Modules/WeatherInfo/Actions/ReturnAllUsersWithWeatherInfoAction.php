<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\Actions;

use Closure;
use FullstackChallenge\Shared\Utils\ActionableInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\GetCurrentWeatherManager;
use FullstackChallenge\WeatherInfo\Models\User;
use Illuminate\Database\Eloquent\Collection;

final readonly class ReturnAllUsersWithWeatherInfoAction implements ActionableInterface
{
    public function __construct(private GetCurrentWeatherManager $manager)
    {
    }

    public function handle($content, Closure $next)
    {
        $users = $content;

        /** @var Collection<User> $users */
        $users = $users->map(function (User $user) {
            $userLat = (float) $user->latitude;
            $userLon = (float) $user->longitude;

            return [
                'name' => $user->name,
                'lat' => $userLat,
                'lon' => $userLon,
                'weather' => ($this->manager)($userLat, $userLon)->toArray(),
            ];
        })->all();

        return $next($users);
    }
}
