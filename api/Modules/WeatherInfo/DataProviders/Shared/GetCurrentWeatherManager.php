<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared;

use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetCurrentWeatherApiRequestInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;

final readonly class GetCurrentWeatherManager
{
    public function __construct(private GetCurrentWeatherApiRequestInterface $request)
    {
    }

    public function __invoke(float $lat, float $lon): GetCurrentWeatherApiResponseInterface
    {
        return $this->request->send($lat, $lon);
    }
}
