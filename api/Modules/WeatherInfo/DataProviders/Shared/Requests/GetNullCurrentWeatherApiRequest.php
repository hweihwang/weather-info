<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests;

use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetNullCurrentWeatherApiResponse;

final readonly class GetNullCurrentWeatherApiRequest implements GetCurrentWeatherApiRequestInterface
{
    public function send(float $lat, float $lon): GetCurrentWeatherApiResponseInterface
    {
        return GetNullCurrentWeatherApiResponse::fromArray([]);
    }
}
