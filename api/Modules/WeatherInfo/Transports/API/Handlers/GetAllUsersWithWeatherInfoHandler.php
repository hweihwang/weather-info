<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\Transports\API\Handlers;

use FullstackChallenge\WeatherInfo\Actions\GetAllUsersAction;
use FullstackChallenge\WeatherInfo\Actions\ReturnAllUsersWithWeatherInfoAction;
use Illuminate\Pipeline\Pipeline;

final class GetAllUsersWithWeatherInfoHandler
{
    public function __invoke(Pipeline $pipeline): array
    {
        return $pipeline
            ->through([
                GetAllUsersAction::class,
                ReturnAllUsersWithWeatherInfoAction::class,
            ])
            ->thenReturn();
    }
}
